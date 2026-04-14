import fs from 'node:fs';
import fsp from 'node:fs/promises';
import path from 'node:path';
import process from 'node:process';
import archiver from 'archiver';

const cwd = process.cwd();
const themeSlug = path.basename(cwd);

const OUT_DIR = path.join(cwd, 'release');
const STAGE_ROOT = path.join(cwd, '.dist-tmp');
const STAGE_DIR = path.join(STAGE_ROOT, themeSlug);
const META_PATH = path.join(STAGE_DIR, 'release-meta.json');

function normalizePosix(p) {
  return p.split(path.sep).join('/');
}

async function rmDir(dirPath) {
  await fsp.rm(dirPath, { recursive: true, force: true });
}

async function ensureDir(dirPath) {
  await fsp.mkdir(dirPath, { recursive: true });
}

async function copyFile(srcAbs, destAbs) {
  await ensureDir(path.dirname(destAbs));
  await fsp.copyFile(srcAbs, destAbs);
}

async function copyDir(srcAbs, destAbs) {
  const entries = await fsp.readdir(srcAbs, { withFileTypes: true });
  await ensureDir(destAbs);
  await Promise.all(
    entries.map(async (ent) => {
      const from = path.join(srcAbs, ent.name);
      const to = path.join(destAbs, ent.name);
      if (ent.isDirectory()) return copyDir(from, to);
      if (ent.isFile()) return copyFile(from, to);
    }),
  );
}

async function listRootPhpFiles() {
  const entries = await fsp.readdir(cwd, { withFileTypes: true });
  return entries
    .filter((e) => e.isFile() && e.name.endsWith('.php'))
    .map((e) => e.name)
    .sort();
}

async function readThemeVersionFromStyleCss() {
  const stylePath = path.join(cwd, 'style.css');
  if (!fs.existsSync(stylePath)) return null;
  const raw = await fsp.readFile(stylePath, 'utf8');
  // Read only header-ish area; WP reads from the comment header block.
  const head = raw.split(/\r?\n/).slice(0, 60).join('\n');
  const m = head.match(/^\s*Version:\s*([^\r\n]+)\s*$/im);
  return m?.[1]?.trim() || null;
}

async function stageFiles() {
  await rmDir(STAGE_DIR);
  await ensureDir(STAGE_DIR);

  const rootFiles = ['style.css', 'theme.json', 'README.txt', 'LICENSE'];
  const phpFiles = await listRootPhpFiles();

  const includeDirs = ['dist', 'acf-wp-wysiwyg'];

  for (const fileRel of [...rootFiles, ...phpFiles]) {
    const srcAbs = path.join(cwd, fileRel);
    if (!fs.existsSync(srcAbs)) continue;
    const destAbs = path.join(STAGE_DIR, fileRel);
    await copyFile(srcAbs, destAbs);
  }

  for (const dirRel of includeDirs) {
    const srcAbs = path.join(cwd, dirRel);
    if (!fs.existsSync(srcAbs)) continue;
    const destAbs = path.join(STAGE_DIR, dirRel);
    await copyDir(srcAbs, destAbs);
  }
}

async function writeReleaseMeta({ version }) {
  const meta = {
    plugin: themeSlug,
    version,
    builtAt: new Date().toISOString(),
    node: process.version,
  };
  await ensureDir(path.dirname(META_PATH));
  await fsp.writeFile(META_PATH, JSON.stringify(meta, null, 2) + '\n', 'utf8');
}

async function makeZip({ version }) {
  await ensureDir(OUT_DIR);
  const zipPath = path.join(OUT_DIR, `${themeSlug}-${version}.zip`);

  await new Promise((resolve, reject) => {
    const output = fs.createWriteStream(zipPath);
    const archive = archiver('zip', { zlib: { level: 9 } });

    output.on('close', resolve);
    output.on('error', reject);
    archive.on('warning', (err) => {
      console.warn(err);
    });
    archive.on('error', reject);

    archive.pipe(output);
    archive.directory(STAGE_DIR, themeSlug);
    archive.finalize();
  });

  return zipPath;
}

async function main() {
  const version = (await readThemeVersionFromStyleCss()) || '0.0.0';

  console.log(`[dist-zip] stage: ${normalizePosix(path.relative(cwd, STAGE_DIR))}`);
  await stageFiles();
  await writeReleaseMeta({ version });

  const zipPath = await makeZip({ version });
  console.log(`[dist-zip] zip:   ${normalizePosix(path.relative(cwd, zipPath))}`);
}

await main();
