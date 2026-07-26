import fs from 'node:fs/promises';
import path from 'node:path';
import process from 'node:process';
import { fileURLToPath } from 'node:url';

const VERSION_LINE_RE = /^(\s*Version:\s*)([^\r\n]+)(\s*)$/im;

export async function readPackageVersion(cwd = process.cwd()) {
  const packagePath = path.join(cwd, 'package.json');
  const pkg = JSON.parse(await fs.readFile(packagePath, 'utf8'));
  const version = pkg.version?.trim();
  if (!version) {
    throw new Error('package.json に version がありません');
  }
  return version;
}

export async function readStyleCssVersion(cwd = process.cwd()) {
  const stylePath = path.join(cwd, 'style.css');
  const raw = await fs.readFile(stylePath, 'utf8');
  const head = raw.split(/\r?\n/).slice(0, 60).join('\n');
  const match = head.match(VERSION_LINE_RE);
  return match?.[2]?.trim() || null;
}

export async function syncThemeVersionFromPackage(cwd = process.cwd()) {
  const version = await readPackageVersion(cwd);
  const stylePath = path.join(cwd, 'style.css');
  const raw = await fs.readFile(stylePath, 'utf8');
  if (!VERSION_LINE_RE.test(raw.split(/\r?\n/).slice(0, 60).join('\n'))) {
    throw new Error('style.css のヘッダーに Version: 行が見つかりません');
  }

  const cssVersion = await readStyleCssVersion(cwd);
  if (cssVersion === version) {
    return { version, changed: false };
  }

  const updated = raw.replace(VERSION_LINE_RE, `$1${version}$3`);
  await fs.writeFile(stylePath, updated, 'utf8');
  return { version, changed: true };
}

async function main() {
  const check = process.argv.includes('--check');
  const packageVersion = await readPackageVersion();
  const cssVersion = await readStyleCssVersion();

  if (check) {
    if (cssVersion !== packageVersion) {
      console.error(
        `[version:check] mismatch: package.json=${packageVersion}, style.css=${cssVersion ?? '(missing)'}`,
      );
      process.exitCode = 1;
      return;
    }
    console.log(`[version:check] ok (${packageVersion})`);
    return;
  }

  const { version, changed } = await syncThemeVersionFromPackage();
  if (changed) {
    console.log(`[version:sync] style.css Version -> ${version}`);
  }
}

const isMain =
  process.argv[1] &&
  fileURLToPath(import.meta.url) === path.resolve(process.argv[1]);

if (isMain) {
  await main();
}
