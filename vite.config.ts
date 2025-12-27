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

export default defineConfig({
  logLevel: (process.env.VITE_LOG_LEVEL as any) || 'warn',

  define: {
    'process.env': {},
    'process.env.NODE_ENV': JSON.stringify(process.env.NODE_ENV || 'development'),
  },

  build: {
    outDir: 'dist',
    emptyOutDir: false,

    rollupOptions: {
      /**
       * エントリーポイント: JS（CSSはJSからインポート）
       * IIFE形式で複数のエントリーポイントを使う場合の制約を回避するため、
       * CSSエントリーポイントを削除し、JSエントリーポイントからCSSをインポート
       */
      input: {
        index: resolve(__dirname, 'src/scripts/index.ts'),
      },

      /**
       * WordPress コア JS と jQuery は外部化
       */
      external: (id) => {
        if (id.startsWith('@wordpress/')) return true;
        if (id === 'jquery') return true;
        return false;
      },

      output: {
        /**
         * WordPress enqueue 前提の単一 IIFE
         * 単一のエントリーポイント（JS）からCSSもインポートされるため、
         * inlineDynamicImports を true に設定してコード分割を無効化
         */
        format: 'iife',
        inlineDynamicImports: true,
        name: 'ThemeBundle',

        /**
         * 外部モジュールのグローバル変数マッピング
         */
        globals: (id) => {
          if (id.startsWith('@wordpress/')) {
            const mod = id.split('/').pop();
            if (id === '@wordpress/interactivity') return 'wp.interactivity';
            if (id === '@wordpress/i18n') return 'wp.i18n';
            return `wp.${mod}`;
          }
          if (id === 'jquery') return 'jQuery';
          return id;
        },

        entryFileNames: 'js/index.js',
        chunkFileNames: 'js/[name]-[hash].js',

        assetFileNames: (asset) => {
          if (asset.name?.endsWith('.css')) {
            // JS からインポートされた CSS を style.css として出力
            return 'css/style.css';
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
     * サードパーティ製ライブラリを dist へコピー
     */
    viteStaticCopy({
      targets: [
        {
          src: 'src/thirdparties/scripts/*',
          dest: 'js',
        },
        {
          src: 'src/thirdparties/styles/*',
          dest: 'css',
        },
        {
          src: 'src/images/**/*.*',
          dest: 'assets',
        },
      ],
    }),
  ],

  css: {
    postcss: {
      plugins: [
        autoprefixer({
          overrideBrowserslist: [
            'last 2 versions',
            '> 1%',
            'not dead',
            'not ie 11',
          ],
        }),
      ],
    },
  },

  resolve: {
    alias: {
      '@': resolve(__dirname, 'src'),
    },
  },
});
