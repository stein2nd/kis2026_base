import js from '@eslint/js';
import typescript from '@typescript-eslint/eslint-plugin';
import typescriptParser from '@typescript-eslint/parser';
import globals from 'globals';

const config = [
  js.configs.recommended,
  {
    files: ['src/scripts/**/*.ts'],
    languageOptions: {
      parser: typescriptParser,
      parserOptions: {
        ecmaVersion: 'latest',
        sourceType: 'module',
      },
      globals: {
        ...globals.browser,
        jQuery: 'readonly',
        wp: 'readonly',
      },
    },
    plugins: {
      // @typescript-eslint/eslint-plugin の型定義が Flat Config と完全に互換性がないため、型アサーションを使用
      '@typescript-eslint': typescript as any,
    },
    rules: {
      // TypeScript rules
      '@typescript-eslint/no-unused-vars': ['error', { argsIgnorePattern: '^_' }],
      '@typescript-eslint/no-explicit-any': 'warn',
      '@typescript-eslint/explicit-function-return-type': 'off',
      '@typescript-eslint/explicit-module-boundary-types': 'off',
      '@typescript-eslint/no-non-null-assertion': 'warn',

      // General rules
      'no-unused-vars': 'off', // Use TypeScript version instead
      'no-console': 'off', // Allow console for WordPress development
      'no-debugger': 'error',
      'prefer-const': 'error',
      'no-var': 'error',
      'object-shorthand': 'error',
      'prefer-template': 'error',
    },
  },
  {
    ignores: [
      'node_modules/**',
      'dist/**',
      '*.min.js',
      'vendor/**',
      'build/**',
      'coverage/**',
      '.nyc_output/**',
    ],
  },
];

export default config;
