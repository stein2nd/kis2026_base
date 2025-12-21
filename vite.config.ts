import { defineConfig } from 'vite';
import { resolve } from 'path';
import { rmSync } from 'fs';
import { viteStaticCopy } from 'vite-plugin-static-copy';
import autoprefixer from 'autoprefixer';

/**
 * dist を初期化
 */
if (process.env.FLUSH_DIST === 'true') {
  rmSync('dist', { recursive: true, force: true });
}

/**
 * build target 判定
 * npm run build:editor / build:frontend
 */
const getBuildTarget = () => {
  const script = process.env.npm_lifecycle_event;
  if (script?.includes('editor')) return 'editor';
  if (script?.includes('frontend')) return 'frontend';
  return 'frontend';
};

const target = getBuildTarget();

/**
 * テーマ用ビルド設定（React 非依存）
 */
const configMap = {
  editor: {
    entry: resolve(__dirname, 'src/editor/index.ts'),
    jsName: 'editor.js',
    cssName: 'editor.css',
  },
  frontend: {
    entry: resolve(__dirname, 'src/frontend/index.ts'),
    jsName: 'frontend.js',
    cssName: 'style.css',
  }
};

const buildConfig = configMap[target];

export default defineConfig({
  logLevel: (process.env.VITE_LOG_LEVEL as any) || 'warn',

  define: {
    'process.env': {},
    'process.env.NODE_ENV': JSON.stringify(process.env.NODE_ENV || 'development'),
  },

  build: {
    outDir: 'dist',
    emptyOutDir: false,

    /**
     * WordPress enqueue 前提の単一 IIFE
     */
    lib: {
      entry: buildConfig.entry,
      formats: ['iife'],
      name: 'ThemeBundle',
    },

    rollupOptions: {
      /**
       * WordPress コア JS はすべて外部化
       * （Interactivity API 含む）
       */
      external: (id) => {
        if (id.startsWith('@wordpress/')) return true;
        return false;
      },

      output: {
        /**
         * @wordpress/* → wp.*
         */
        globals: (id) => {
          if (id.startsWith('@wordpress/')) {
            const mod = id.split('/').pop();
            if (id === '@wordpress/interactivity') return 'wp.interactivity';
            if (id === '@wordpress/i18n') return 'wp.i18n';
            return `wp.${mod}`;
          }
          return id;
        },

        entryFileNames: `js/${buildConfig.jsName}`,
        chunkFileNames: 'js/[name]-[hash].js',

        assetFileNames: (asset) => {
          if (asset.name?.endsWith('.css')) {
            return `css/${buildConfig.cssName}`;
          }
          return 'assets/[name][extname]';
        },
      },

      onwarn(warning, warn) {
        if (
          warning.code === 'UNUSED_EXTERNAL_IMPORT' ||
          warning.code === 'MODULE_LEVEL_DIRECTIVE'
        ) {
          return;
        }
        warn(warning);
      },
    },

    minify: process.env.NODE_ENV === 'production',
    sourcemap: process.env.NODE_ENV !== 'production',
    cssCodeSplit: false,
    reportCompressedSize: false,
  },

  plugins: [
    /**
     * テーマ資産を dist へコピー
     */
    viteStaticCopy({
      targets: [
        {
          src: 'assets/blocks/**/block.json',
          dest: 'blocks'
        },
        {
          src: 'patterns/**/*.php',
          dest: 'patterns'
        }
      ]
    })
  ],

  css: {
    postcss: {
      plugins: [
        autoprefixer({
          overrideBrowserslist: [
            'last 2 versions',
            '> 1%',
            'not dead',
            'not ie 11'
          ]
        })
      ]
    }
  },

  resolve: {
    alias: {
      '@': resolve(__dirname, 'src'),
    }
  }
});
