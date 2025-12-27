# KIS 2026 Base

[![License: GPL v3](https://img.shields.io/badge/License-GPL%20v3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0.en.html)
[![WordPress](https://img.shields.io/badge/WordPress-6.3-blue.svg)](https://wordpress.org/)
[![TypeScript](https://img.shields.io/badge/TypeScript-5.9-blue.svg)](https://www.typescriptlang.org/)
[![Dart SASS](https://img.shields.io/badge/SCSS-1.97-blue.svg)](https://sass-lang.com/dart-sass/)
[![Vite](https://img.shields.io/badge/vite-7.3-blue.svg)](https://vite.dev)

KIS 用 WordPress テーマのベースです。Vite を使用したモダンなビルド環境を採用し、TypeScript と SCSS による開発を行います。

## 概要

本テーマは、WordPress ブロック・テーマとして開発されています。モダンな開発環境とベスト・プラクティスを採用し、保守性と拡張性を重視した設計となっています。

詳細な仕様については、[`docs/SPEC.md`](docs/SPEC.md) を参照してください。

## 主な特徴

- **ブロック・テーマ**: WordPress の最新のブロック・テーマ形式に対応
- **モダンなビルド環境**: Vite を使用した高速なビルドと開発体験
- **TypeScript**: 型安全性を確保した JavaScript 開発
- **SCSS**: 保守性の高いスタイルシート開発
- **自動ベンダー・プレフィックス**: Autoprefixer による自動生成
- **コード品質**: ESLint、Stylelint、Prettier による品質管理

## 技術スタック

- **TypeScript**: 型安全性を確保するための JavaScript のスーパーセット
- **SCSS**: CSS の拡張言語
- **Vite**: モダンなビルドツール
- **Rollup**: Vite が使用するバンドラー
- **PostCSS / Autoprefixer**: CSS の後処理
- **ESLint**: JavaScript/TypeScript のリンター
- **Stylelint**: CSS/SCSS のリンター
- **Prettier**: コード・フォーマッター

## セットアップ

### 必要な環境

- Node.js (推奨バージョン: 18.x 以上)
- npm または yarn
- WordPress 6.0 以上

### インストール

1. リポジトリをクローンまたはダウンロードします：

```zsh
git clone https://github.com/stein2nd/kis2026_base.git
cd kis2026_base
```

2. 依存関係をインストールします：

```zsh
npm install
```

3. ビルドを実行します：

```zsh
npm run build
```

## 開発

### ビルドコマンド

- **`npm run build`**: 本番モードでビルドします (ミニファイ有効、ソースマップ無効)
- **`npm run build:dev`**: 開発モードでビルドします (ソースマップ有効、ミニファイ無効)

### リント・フォーマット

- **`npm run lint`**: JavaScript/TypeScript と CSS/SCSS の両方をリントします
- **`npm run lint:js`**: JavaScript/TypeScript のみをリントします
- **`npm run lint:css`**: CSS/SCSS のみをリントします
- **`npm run lint:fix`**: リントエラーを自動修正します
- **`npm run lint:js:fix`**: JavaScript/TypeScript のリントエラーを自動修正します
- **`npm run lint:css:fix`**: CSS/SCSS のリントエラーを自動修正します
- **`npm run format`**: Prettier でコードをフォーマットします
- **`npm run format:check`**: フォーマットの整合性をチェックします

## プロジェクト構成

```
kis2026_base/
├── package.json  # プロジェクト設定
├── docs/  # ドキュメント
├┬─ src/  # ソースコード
│├─ scripts/  # TypeScript スクリプト
│├─ styles/  # SCSS スタイルシート
│├─ images/  # 画像アセット
│└─ thirdparties/  # サードパーティ・ライブラリ
└┬─ dist/  # ビルド出力ディレクトリ
　├─ css/
　└─ js/
```

詳細な構成については、[`docs/SPEC.md`](docs/SPEC.md) の「2. プロジェクト構成」を参照してください。

## ビルドの仕組み

本テーマは Vite を使用してビルドを行います。WordPress のエンキュー前提で IIFE 形式のバンドルを生成するため、以下の制約と対応を実装しています。

- **単一エントリー・ポイント**: `src/scripts/index.ts` を唯一のエントリー・ポイントとして使用
- **CSS のインポート**: CSS は JS エントリー・ポイントから `import '../styles/style.scss';` としてインポート
- **ビルド出力**: `dist/js/index.js` (JavaScript) と `dist/css/style.css` (CSS) が生成されます

詳細については、[`docs/SPEC.md`](docs/SPEC.md) の「3. 技術スタック・開発環境」を参照してください。

## スタイル設計

### ベンダー・プレフィックスの管理

本テーマでは、ベンダー・プレフィックスの管理を Autoprefixer に一元化しています。

- **Autoprefixer による自動生成**: ビルド時に Autoprefixer が、設定されたブラウザ・サポート要件に基づいて、必要なベンダー・プレフィックスを自動生成します
- **手動ベンダー・プレフィックスの禁止**: ソースコード内にベンダー・プレフィックス (`-webkit-`, `-moz-`, `-ms-`, `-o-`) を手動で記述することは禁止します

### SCSS パーシャル・ファイルのインポート

SCSS のパーシャル・ファイル（`_` で始まるファイル）をインポートする際は、アンダースコアを含めずにインポートします。

- **正しい例**: `@use 'base_pc';`
- **誤った例**: `@use '_base_pc';`

詳細については、[`docs/SPEC.md`](docs/SPEC.md) の「4. スタイル設計」を参照してください。

## ライセンス

このテーマは [GPL-3.0-or-later](LICENSE) ライセンスの下で提供されています。

## 作者

- **Koutarou ISHIKAWA**

## リポジトリ

- **GitHub**: https://github.com/stein2nd/kis2026_base
- **Issues**: https://github.com/stein2nd/kis2026_base/issues

## 参考資料

- [WordPress テーマ開発ハンドブック](https://developer.wordpress.org/themes/)
- [WordPress ブロック・テーマ](https://developer.wordpress.org/themes/block-themes/)
- [Vite 公式ドキュメント](https://vitejs.dev/)
- [TypeScript 公式ドキュメント](https://www.typescriptlang.org/)
- [Sass 公式ドキュメント](https://sass-lang.com/)

## 変更履歴

詳細な変更履歴については、[`docs/SPEC.md`](docs/SPEC.md) の「5. 実装修正履歴」を参照してください。
