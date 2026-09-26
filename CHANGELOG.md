# `KIS 2026 Hybrid` - CHANGELOG

## unreleased

## 1.0.5 - 2026-09-26

### Fixed

* `package-lock.json` の `version` が `package.json` (1.0.4) と不一致だったため同期

### Changed

* `package.json` Version を v1.0.5に更新
* 開発用 npm モジュールを更新 (Vite v8.3、Dart Sass v1.105、ESLint、TypeScript ESLint、`@s2j/docs-linter` 等)
* README のバッジを更新 (SCSS v1.105、Vite v8.3)

## 1.0.4 - 2026-09-05

### Changed

* テーマ名を `KIS 2026 Hybrid` に変更 (`style.css`)
* `package.json` Version を1.0.4に更新
* `theme.json` に FSE 向け設定を追加 (layout、spacing、typography 等)
* リンクスタイルを `color: navy; text-decoration: underline` に統一 (`:visited` は未指定)
* 個別クラス (`.setColorLink` 等) のリンク色指定を整理し、グローバルスタイルに統一
* 本文フォントを `Noto Sans JP` に統一 (`Noto Sans Japanese`、Oswald を廃止)
* `.en` の Oswald 指定および `functions.php` の Google Fonts 読み込みを削除
* `style.css` のフォント上書きワークアラウンドを削除
* ナビ・フッター・ボタン・カード型リンク等は下線なしの例外指定を維持

### Added

* `docs/SPEC.md` に §1.5依存プラグイン (エコシステム) 索引節を追加 (`kis-wordpress` 仕様へのリンク)

## 1.0.3 - 2026-07-26

### Added

* `.npmrc` の追加 (`legacy-peer-deps`、`@s2j/docs-linter` の GitHub 依存向け `allow-git` 設定)

### Changed

* 開発用 npm モジュールを最新版に更新 (TypeScript v7.0、Vite v8.1等)
* README のバッジを更新 (TypeScript v7.0、SCSS v1.101、Vite v8.1)
* `package.json` と `style.css` の Version を同期 (`version:sync`、`prebuild`、配布 zip 生成時)

## 1.0.2 - 2026-06-12

### Fixed

* `tools/dist/make-dist-zip.mjs` の `archiver` v8対応 (`ZipArchive` への移行、`npm run dist:zip`、CI `dist-zip` の失敗を解消)

## 1.0.1 - 2026-06-12

### Added

* Docs Linter の導入 (`npm run lint:docs`、`.textlintrc.json`、CI ワークフロー `docs-lint.yml`)
* `@s2j/docs-linter` への移行 (Git submodule `tools/docs-linter` を廃止)
* `.stylelintignore` の追加
* 配布 zip 生成 (`dist:zip`、`dist:zip:ci`、`tools/dist/make-dist-zip.mjs`、CI ワークフロー `dist-zip.yml`)
* `CHANGELOG.md` の追加

### Changed

* `style.css` のテーマヘッダー情報を拡充 (Description、Tags、Theme URI、License、Author、Requires 等)
* `_base_pc.scss`、`_event.scss`、`_product_forwarderpro.scss` のスタイル調整
* ドキュメントの textlint 指摘事項を修正 (`README.md`、`docs/SPEC.md`、`docs_mod/*.md`)
* 開発用 npm モジュールを最新版に更新
* README の WordPress バッジを v6.9+ に更新
* VS Code の textlint 設定を調整 (`lint:docs` の対象に `CHANGELOG.md` を追加)
