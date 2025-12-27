=== KIS 2026 Base ===
Contributors: stein2nd
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 1.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Tags: block-theme, full-site-editing, translation-ready, custom-colors, custom-menu, editor-style, featured-images, threaded-comments

== 説明 ==

KIS 2026 Base は、KIS 用 WordPress テーマのベースです。Vite を使用したモダンなビルド環境を採用し、TypeScript と SCSS による開発を行います。

== 主な特徴 ==

* ブロック・テーマ形式に対応
* Vite を使用した高速なビルド環境
* TypeScript による型安全な開発
* SCSS による保守性の高いスタイルシート開発
* Autoprefixer による自動ベンダー・プレフィックス生成
* ESLint、Stylelint、Prettier によるコード品質管理

== インストール方法 ==

1. WordPress 管理画面にログインします
2. 「外観」→「テーマ」→「新規追加」をクリックします
3. 「テーマのアップロード」をクリックします
4. テーマの ZIP ファイルを選択して「今すぐインストール」をクリックします
5. インストール後、「有効化」をクリックしてテーマを有効化します

== 開発者向け情報 ==

本テーマは開発環境として Node.js と npm が必要です。

== セットアップ ==

1. リポジトリをクローンまたはダウンロードします
2. 依存関係をインストールします: `npm install`
3. ビルドを実行します: `npm run build`

== ビルドコマンド ==

* `npm run build`: 本番モードでビルドします
* `npm run build:dev`: 開発モードでビルドします
* `npm run lint`: コードをリントします
* `npm run lint:fix`: リントエラーを自動修正します
* `npm run format`: コードをフォーマットします

詳細な開発情報については、`docs/SPEC.md` を参照してください。

== 技術スタック ==

* TypeScript
* SCSS
* Vite
* Rollup
* PostCSS / Autoprefixer
* ESLint
* Stylelint
* Prettier

== 変更履歴 ==

= 1.0 =
* 初回リリース

== クレジット ==

本テーマは以下の技術を使用しています:

* [Vite](https://vitejs.dev/) - ビルドツール
* [TypeScript](https://www.typescriptlang.org/) - プログラミング言語
* [Sass](https://sass-lang.com/) - CSS プリプロセッサ
* [ESLint](https://eslint.org/) - JavaScript/TypeScript リンター
* [Stylelint](https://stylelint.io/) - CSS/SCSS リンター
* [Prettier](https://prettier.io/) - コード・フォーマッター

== ライセンス ==

このテーマは GPL-3.0-or-later ライセンスの下で提供されています。

== 作者 ==

Koutarou ISHIKAWA

== サポート ==

問題や質問がある場合は、[GitHub Issues](https://github.com/stein2nd/kis2026_base/issues) で報告してください。
