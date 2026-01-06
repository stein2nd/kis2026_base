# 個別仕様 for KIS2026

## はじめに

以下は「KIS 向けブロックテーマ (2026)」に関する個別仕様です。

## 1. テーマ概要

本テーマは、既存の「クラシック・テーマ」を段階的に「ブロック・テーマ」に移行させるためのプロジェクトです。Vite を使用したモダンなビルド環境を採用し、TypeScript と SCSS による開発を行います。

### 1.1. プロジェクトの背景

既存の「クラシック・テーマ」をリバース・エンジニアリングし、メンテナンス性を向上させるために以下の対応を行いました：

* **JavaScript コードの TypeScript 化**: メンテナンス容易にするため、JavaScript コードを TypeScript ソースに変換し、`src/` 配下に格納しました。
* **CSS コードの Dart SASS 化**: メンテナンス容易にするため、CSS コードを Dart SASS ソースに変換し、`src/` 配下に格納しました。

### 1.2. メディアクエリーの統一

メディアクエリー式が無定見だったため、以下の方針に統一しました：

* **幅狭画面**: `max-width: 640px` 以下の画面を幅狭画面として扱います。
* **幅広画面**: `max-width: 640px` を超える画面を幅広画面として扱います。

### 1.3. 画像アセットの管理

テーマ配下に散らばっていた画像ファイルを整理し、以下の対応を行いました：

* **メディア・ライブラリへの移行**: 『Bulk Media Register』プラグインを使用して、基本的にメディア・ライブラリに収容するように変更しました。
* **SVG 画像の対応**: 『Bulk Media Register』では SVG 画像をメディア・ライブラリに登録できないため、後日 PNG 画像に変換することを検討しています。
  * **補足**: 『SVG Support』プラグインを使用すれば、メディア・ライブラリに SVG ファイルを収容できる可能性がありますが、『Bulk Media Register』でのファイル生成日を利用した一括登録に対応できるかどうかは、現時点では未確認です。実際の動作確認が必要です。

### 1.4. 今後の展開

今後は、以下の方針でブロック・テーマへの移行を進めます：

* **『Create Block Theme』の活用**: 『Create Block Theme』プラグインを使用して、「Twenty Twenty-Five」ベースのブロック・テーマ `kis2026` を作成します。
* **カスタム投稿タイプの追加**: 作成したブロック・テーマに、複数のカスタム投稿タイプを追加していく予定です。

## 2. プロジェクト構成

### 2.1. フォルダー構成・ファイル構成

本テーマのフォルダー構成は以下の通りです。

```
kis2026_base/
├── `README.md`
├── `README.txt`
├── `LICENSE`
├── `package.json`  # プロジェクト設定
├── node_modules/  # 依存関係 (npm)
├── `vite.config.ts`  # Vite ビルド設定
├── `tsconfig.json`  # TypeScript 設定
├── `eslint.config.ts`  # ESLint 設定 (TypeScript 形式)
├── `.stylelintrc.json`  # Stylelint 設定 (JSON 形式)
├── `style.css`  # WordPress テーマスタイルシート
├┬─ docs/  # ドキュメント
│└── SPEC.md  # 本仕様書
├── languages/  # 翻訳ファイル
├── index.php
├── functions.php
├── header.php
├── footer.php
├── 404.php
├── content-page.php
├── page.php
├── page-none-title.php
├── page-news.php
├── page-recruit-form.php
├── single.php
├── single-case.php
├── single-event.php
├── archive.php
├── archive-case.php
├── archive-event.php
├── category.php
├── part-news.php
├┬─ src/  # ソースコード
│├┬─ frontend/  # フロントエンド用スクリプト
││└── index.ts
│├┬─ editor/  # エディター用スクリプト
││└── index.ts
│├┬─ scripts/  # メインスクリプト
││└── index.ts  # エントリー・ポイント
│├── types/  # TypeScript 型定義
│├┬─ styles/  # SCSS スタイルシート
││├── style.scss  # メイン・スタイルシート
││├── editor.scss  # エディター用スタイル
││└── _*.scss  # パーシャル・ファイル
│├┬─ thirdparties/  # サードパーティ・ライブラリ
││├── scripts/  # 外部 JS ライブラリ
││└── styles/  # 外部 CSS ライブラリ
│└┬─ images/  # 画像アセット
│　├── button/  # ボタン画像
│　├── content/  # コンテンツ画像
│　└── icon/  # アイコン画像
└┬─ dist/  # ビルド出力ディレクトリ
　├┬─ css/
　│├── style.css  # 生成された CSS ファイル
　│└── slick.css  # サードパーティ・ライブラリ
　└┬─ js/
　　├── index.js  # 生成された JavaScript ファイル
　　├── flexibility.js  # サードパーティ・ライブラリ
　　└── slick.min.js  # サードパーティ・ライブラリ
```

### 2.2. 主要ディレクトリ、主要ファイル

* **`src/`**: 開発用のソースコードを格納します。ビルド時に `dist/` に出力されます。
* **`src/scripts/`**: メインの JavaScript/TypeScript ファイルを格納します。`index.ts` がエントリー・ポイントです。
* **`src/styles/`**: SCSS スタイルシートを格納します。`style.scss` がメイン・スタイルシートで、各種パーシャル・ファイル (`_*.scss`) をインポートします。
* **`src/images/`**: テーマで使用する画像アセットを格納します。
* **`src/thirdparties/`**: サードパーティ・ライブラリ (flexibility.js、slick など) を格納します。ビルド時に `dist/` にコピーされます。
* **`dist/`**: ビルド出力先ディレクトリです。WordPress テーマから読み込まれるファイルが生成されます。
* **`docs/`**: ドキュメントとサンプル設定ファイルを格納します。

## 3. 技術スタック・開発環境

### 3.1. フロントエンド技術スタック

本テーマでは以下の技術スタックを使用します。

* **TypeScript**: 型安全性を確保するための JavaScript のスーパーセット
* **SCSS**: CSS の拡張言語
* **Vite**: モダンなビルドツール
* **Rollup**: Vite が使用するバンドラー
* **PostCSS / Autoprefixer**: CSS の後処理
* **ESLint**: JavaScript/TypeScript のリンター
* **Stylelint**: CSS/SCSS のリンター
* **Prettier**: コード・フォーマッター

### 3.2. ビルド要件

本テーマは Vite を使用してビルドを行います。WordPress のエンキュー前提で IIFE 形式のバンドルを生成するため、以下の制約と対応を実装しています。

#### エントリー・ポイント構成

* **単一エントリー・ポイント**: `src/scripts/index.ts` を唯一のエントリー・ポイントとして使用します。
* **CSS のインポート**: CSS は JS エントリー・ポイントから `import '../styles/style.scss';` としてインポートします。
* **理由**: Rollup (Vite が使用) では、IIFE 形式で複数のエントリー・ポイントを使用する場合、コード分割がサポートされません。この制約を回避するため、CSS エントリー・ポイントを削除し、JS エントリー・ポイントから CSS をインポートする構成に変更しています。

#### ビルド出力

* **JavaScript**: `dist/js/index.js` - IIFE 形式の単一バンドルです。
* **CSS**: `dist/css/style.css` - JS からインポートされた SCSS から自動抽出されます。
* **コード分割**: `inlineDynamicImports: true` により無効化され、単一バンドルを保証します。

#### 外部依存モジュール

以下のモジュールは外部化され、WordPress コアまたはグローバル変数から読み込まれます：

* `@wordpress/*` - WordPress コア JS (`wp.*` グローバル変数にマッピングされます)
* `jquery` - WordPress コア同梱 jQuery (`jQuery` グローバル変数にマッピングされます)

### 3.3. 依存関係モジュールのバージョン選択理由

#### 3.3.1. Rollup モジュール

本テーマでは `package.json` の `overrides` フィールドで Rollup のバージョンを `^4.55.1` に固定しています。これは、Vite 7.3.0 が使用する Rollup のバージョンと互換性を確保するためです。

#### 3.3.2. WordPress パッケージ群

WordPress コア JS パッケージ (`@wordpress/*`) は外部化されており、WordPress コアから提供されるグローバル変数 (`wp.*`) を使用します。これにより、テーマのバンドルサイズを削減し、WordPress コアとの互換性を保証します。

### 3.4. `package.json` の `scripts`

本テーマで使用可能な npm スクリプトは、以下の通りです。

* **`npm run build`**: 本番モードでビルドします (ミニファイ有効、ソースマップ無効)
* **`npm run build:dev`**: 開発モードでビルドします (ソースマップ有効、ミニファイ無効)
* **`npm run lint`**: JavaScript/TypeScript と CSS/SCSS の両方をリントします
* **`npm run lint:js`**: JavaScript/TypeScript のみをリントします
* **`npm run lint:css`**: CSS/SCSS のみをリントします
* **`npm run lint:fix`**: リントエラーを自動修正します
* **`npm run lint:js:fix`**: JavaScript/TypeScript のリントエラーを自動修正します
* **`npm run lint:css:fix`**: CSS/SCSS のリントエラーを自動修正します
* **`npm run format`**: Prettier でコードをフォーマットします
* **`npm run format:check`**: フォーマットの整合性をチェックします

## 4. スタイル設計

### 4.1. ベンダー・プレフィックスの管理

本テーマでは、ベンダー・プレフィックスの管理を Autoprefixer に一元化しています。

* **Autoprefixer による自動生成**: ビルド時に Autoprefixer が、設定されたブラウザ・サポート要件に基づいて、必要なベンダー・プレフィックスを自動生成します。
* **手動ベンダー・プレフィックスの禁止**: ソースコード内にベンダー・プレフィックス (`-webkit-`, `-moz-`, `-ms-`, `-o-`) を手動で記述することは禁止します。
* **設定**: `vite.config.ts` の `overrideBrowserslist` で対象ブラウザを指定します（デフォルト: `last 2 versions`, `> 1%`, `not dead`, `not ie 11`）。

### 4.2. SCSS パーシャル・ファイルのインポート

SCSS のパーシャル・ファイル（`_` で始まるファイル）をインポートする際は、アンダースコアを含めずにインポートします。

* **正しい例**: `@use 'base_pc';`
* **誤った例**: `@use '_base_pc';`

SASS が自動的にアンダースコアで始まるファイルを探します。

### 4.3. Lint ルールの設定

#### 4.3.1. ESLint 設定

* **ファイル形式**: `eslint.config.ts` (TypeScript 形式)
* **理由**: ESLint 9.x の Flat Config では TypeScript 形式の設定ファイルをサポートしており、`vite.config.ts` と同様に TypeScript で記述することで型安全性と一貫性を確保できます。TypeScript 設定ファイルを実行するために `tsx` パッケージを使用します。

#### 4.3.2. Stylelint 設定

* **ファイル形式**: `.stylelintrc.json` (JSON 形式)
* **理由**: JSON 形式にすることで、ESLint の `no-undef` 警告を回避できます。

**無効化されているルール**:

* `max-nesting-depth`: ネストの深さを制限しない (`null`)
* `selector-max-compound-selectors`: 複合セレクターの最大数を制限しない (`null`)
* `selector-max-type`: タイプ・セレクターの最大数を制限しない (`null`)

これらのルールは、既存のコードベースとの互換性を保つために無効化されています。

## 5. 実装修正履歴

### 5.1. ESLint 設定を TypeScript 形式に変更

#### 5.1.1. ESLint 設定ファイルの変更

* **ESLint 設定ファイル**: `eslint.config.mjs` → `eslint.config.ts` に変更
  * TypeScript 形式に変更することで、`vite.config.ts` と同様に型安全性と一貫性を確保
  * ESLint 9.x の Flat Config では TypeScript 形式の設定ファイルをサポート
  * TypeScript 設定ファイルを実行するために `tsx` パッケージを追加
  * `tsconfig.json` の `include` に `eslint.config.ts` を追加

#### 5.1.2. 型定義の対応

* **型エラーの解決**: `@typescript-eslint/eslint-plugin` の型定義が Flat Config と完全に互換性がないため、型アサーション (`as any`) を使用
* **非推奨型の削除**: `Linter.FlatConfig[]` 型アノテーションを削除し、型推論に任せることで非推奨警告を回避

### 5.2. Lint 設定とベンダー・プレフィックス管理の改善

#### 5.2.1. 設定ファイルの変更

* **Stylelint 設定ファイル**: `stylelint.config.js` → `.stylelintrc.json` に変更
  * JSON 形式にすることで、ESLint の `no-undef` 警告を回避
  * 注: ESLint 設定ファイルの変更（`eslint.config.mjs` → `eslint.config.ts`）については 5.1節を参照

#### 5.2.2. Stylelint ルールの調整

以下のルールを無効化 (`null` に設定) しました：

* `max-nesting-depth`: ネストの深さ制限を無効化
* `selector-max-compound-selectors`: 複合セレクターの最大数制限を無効化
* `selector-max-type`: タイプ・セレクターの最大数制限を無効化

これらは既存のコードベースとの互換性を保つための変更です。

#### 5.2.3. ベンダー・プレフィックスの一元管理

* **Autoprefixer による自動生成**: ビルド時に Autoprefixer が必要なベンダー・プレフィックスを自動生成するように変更
* **手動ベンダー・プレフィックスの除去**: `src/styles/` 配下のすべての `.scss` ファイルから、手動で記述されていたベンダー・プレフィックスを除去
* **除去対象**: `-webkit-`, `-moz-`, `-ms-`, `-o-` の各プロパティ、古い Flexbox の display 値 (`-ms-flexbox`, `-webkit-flex` など)

#### 5.2.4. 非標準プロパティの除去

* **`-js-display` プロパティの除去**: JavaScript ライブラリ (Flexibility.js) 用の非標準プロパティを除去
  * 注: Flexibility.js ライブラリ自体は `src/thirdparties/scripts/` に残しています。

#### 5.2.5. SCSS インポート構文の修正

* **パーシャル・ファイルのインポート**: `style.scss` 内の `@use` 文で、アンダースコアを含めない形式に修正
  * 変更前: `@use '_base_pc';`
  * 変更後: `@use 'base_pc';`

### 5.3. ビルド設定の最適化

#### 5.3.1. ビルド前の dist ディレクトリのクリア機能

* **環境変数による自動クリア**: `FLUSH_DIST=true` 環境変数を設定することで、ビルド前に `dist` ディレクトリを自動的にクリアする機能を追加
  * `package.json` の `build` と `build:dev` スクリプトに `FLUSH_DIST=true` を設定
  * `vite.config.ts` で `process.env.FLUSH_DIST === 'true'` の場合に `rmSync('dist', { recursive: true, force: true })` を実行
  * これにより、古いビルド成果物の残存を防止

#### 5.3.2. ビルド出力設定の最適化

* **`emptyOutDir: false`**: Vite の `emptyOutDir` を `false` に設定し、`FLUSH_DIST` 環境変数による手動クリアと組み合わせて使用
* **`cssCodeSplit: false`**: CSS のコード分割を無効化し、単一の CSS ファイル (`dist/css/style.css`) を生成
* **`reportCompressedSize: false`**: 圧縮サイズのレポートを無効化し、ビルド時間を短縮

#### 5.3.3. サードパーティ・ライブラリとアセットのコピー設定

* **`vite-plugin-static-copy` の導入**: ビルド時にサードパーティ・ライブラリと画像アセットを `dist` ディレクトリにコピーする設定を追加
  * `src/thirdparties/scripts/*` → `dist/js/`
  * `src/thirdparties/styles/*` → `dist/css/`
  * `src/images/**/*.*` → `dist/assets/`

#### 5.3.4. ビルド警告の抑制

* **Rollup 警告の抑制**: `rollupOptions.onwarn` で以下の警告を抑制
  * `UNUSED_EXTERNAL_IMPORT`: 外部化されたモジュールの未使用インポート警告
  * `MODULE_LEVEL_DIRECTIVE`: モジュール・レベルのディレクティブ警告

### 5.4. 依存関係の更新と固定

#### 5.4.1. 主要な依存関係のバージョン

* **Vite**: `^7.3.0` - モダンなビルドツール
* **TypeScript**: `^5.9.3` - 型安全性を確保
* **Rollup**: `^4.54.0` - `overrides` で固定 (Vite v7.3.0との互換性確保)
* **ESLint**: `^9.39.2` - Flat Config 形式に対応
* **Stylelint**: `^16.26.1` - SCSS のリント
* **Sass**: `^1.97.1` - SCSS のコンパイル
* **Autoprefixer**: `^10.4.23` - ベンダー・プレフィックスの自動生成
* **Prettier**: `^3.7.4` - コード・フォーマッター

#### 5.4.2. TypeScript 関連パッケージ

* **`@typescript-eslint/eslint-plugin`**: `^8.51.0`
* **`@typescript-eslint/parser`**: `^8.51.0`
* **`@types/node`**: `^25.0.3`
* **`@types/jquery`**: `^3.5.33`

#### 5.4.3. その他の開発依存関係

* **`tsx`**: `^4.21.0` - TypeScript 設定ファイルの実行に使用
* **`jiti`**: `^2.6.1` - 設定ファイルの動的読み込み
* **`globals`**: `^16.5.0` - グローバル変数の定義
* **`vite-plugin-static-copy`**: `^3.1.4` - 静的ファイルのコピー

### 5.5. TypeScript 設定の最適化

#### 5.5.1. コンパイラ・オプションの設定

* **厳格モードの有効化**: `strict: true` により、型安全性を最大限に確保
* **未使用変数・パラメータの検出**: `noUnusedLocals: true`, `noUnusedParameters: true` を有効化
* **モジュール解決**: `moduleResolution: "bundler"` を設定し、Vite との互換性を確保
* **ターゲット**: `target: "ES2020"` を設定

#### 5.5.2. パス・エイリアスの設定

* **パス・エイリアスの追加**: `tsconfig.json` に以下のパス・エイリアスを設定
  * `@/*` → `src/*`
  * `@scripts/*` → `src/scripts/*`
  * `@styles/*` → `src/styles/*`
  * `@types/*` → `src/types/*`

#### 5.5.3. 型定義の設定

* **型定義の追加**: `types` フィールドに `node` と `jquery` を追加
* **include の設定**: `vite.config.ts` と `eslint.config.ts` を TypeScript のコンパイル対象に含める

### 5.6. ビルド構成の改善

#### 5.6.1. 単一エントリー・ポイント構成

* **エントリー・ポイント**: `src/scripts/index.ts` を唯一のエントリー・ポイントとして使用
* **CSS のインポート**: CSS は JS エントリー・ポイントから `import '../styles/style.scss';` としてインポート
* **理由**: Rollup (Vite が使用) では、IIFE 形式で複数のエントリー・ポイントを使用する場合、コード分割がサポートされないため

#### 5.6.2. 外部モジュールの外部化

* **WordPress コア JS**: `@wordpress/*` パッケージを外部化し、`wp.*` グローバル変数にマッピング
* **jQuery**: `jquery` を外部化し、`jQuery` グローバル変数にマッピング
* **効果**: バンドル・サイズの削減と WordPress コアとの互換性確保

#### 5.6.3. ビルド出力形式

* **IIFE 形式**: WordPress のエンキュー前提で IIFE 形式のバンドルを生成
* **コード分割の無効化**: `inlineDynamicImports: true` により、単一バンドルを保証
* **出力ファイル名**: 
  * JavaScript: `dist/js/index.js`
  * CSS: `dist/css/style.css`

### 5.7. ESLint ルールの調整

#### 5.7.1. TypeScript ルール

* **`@typescript-eslint/no-unused-vars`**: 未使用変数をエラーとして検出 (`argsIgnorePattern: '^_'` でアンダースコアで始まる引数は除外)
* **`@typescript-eslint/no-explicit-any`**: `any` 型の使用を警告
* **`@typescript-eslint/no-non-null-assertion`**: 非 null アサーション (`!`) の使用を警告

#### 5.7.2. 一般ルール

* **`no-unused-vars`**: TypeScript 版を使用するため無効化
* **`no-console`**: WordPress 開発のため無効化
* **`prefer-const`**: `const` の使用を強制
* **`no-var`**: `var` の使用を禁止
* **`object-shorthand`**: オブジェクトの短縮構文を強制
* **`prefer-template`**: テンプレート・リテラルの使用を強制

### 5.8. フロントエンド実装の完成

#### 5.8.1. TypeScript 化されたフロントエンド・スクリプト

* **`src/scripts/index.ts`**: 既存の JavaScript コードを TypeScript に変換し、フロントエンド用のスクリプトを実装
  * DOMContentLoaded イベント・ハンドラーの実装
  * UA 判定機能 (タブレット・モバイル判定)
  * 電話番号リンクの制御 (PC でのクリック無効化)
  * viewport の動的設定 (幅広画面での固定幅設定)
  * PC/モバイル判定機能
  * チェックボックスの視覚的フィードバック機能
  * アンカーリンクのスムーズ・スクロール機能
  * ナビゲーション・メニューの開閉機能 (タッチ・イベント対応)
  * アコーディオンの開閉機能
  * PC でのナビゲーション・メニューのホバー機能

#### 5.8.2. SCSS 化されたスタイルシート

* **`src/styles/style.scss`**: 既存の CSS コードを SCSS に変換し、パーシャル・ファイルをインポートするメイン・スタイルシートを実装
  * `@use` 構文を使用したパーシャル・ファイルのインポート
  * アンダースコアを含めないインポート形式 (`@use 'base_pc';`)
  * 各種ページタイプ別のスタイルシート (`_case.scss`, `_corporate.scss`, `_event.scss` など)
  * メディアクエリー別のスタイルシート (`_base_sp.scss`, `_base_pc_maxWidth_640px.scss` など)
  * プラグイン上書き用スタイルシート (`_plugins_overwritten.scss`)

#### 5.8.3. 実装の完成状況

以下の実装が完了しています：

* **ビルド設定**: `vite.config.ts` による完全なビルド設定
* **TypeScript 設定**: `tsconfig.json` による型安全性の確保
* **ESLint 設定**: `eslint.config.ts` によるコード品質管理
* **Stylelint 設定**: `.stylelintrc.json` によるスタイルシートの品質管理
* **フロントエンド・スクリプト**: `src/scripts/index.ts` による TypeScript 化された実装
* **スタイルシート**: `src/styles/style.scss` による SCSS 化された実装
* **依存関係**: `package.json` による最新バージョンの依存関係管理

## 6. Backlog

### 6.1. 短期での改善予定 (1-2週間)

(今後、短期での改善予定を追加予定)

### 6.2. 中期での改善予定 (1-2ヵ月)

(今後、中期での改善予定を追加予定)

### 6.3. 長期での改善予定 (3-6ヵ月)

#### 検討事項

2025-12-21 時点で、[flexibility](https://github.com/jonathantneal/flexibility) の利用意義は、下記の条件が全て YES の場合のみに限定されます。

* IE11 を今なお業務要件としてサポートしなければならない。
* ブロック・テーマではなく ハイブリッド・テーマである。
* CSS Grid を使わず、Flexbox のみで構成。
* JS 実行コストを許容できる。

2025-12-21 時点で、[slick](https://github.com/kenwheeler/slick/) の利用意義は、下記の条件が全て YES の場合のみに限定されます。

* 既存資産の強い制約がある。
* ブロック・テーマではなく ハイブリッド・テーマである。
* UI 要件がブロックで代替できない (Swiper / Splide / CSS Scroll Snap、および Interactivity API では満たせない)。
* jQuery をテーマに含めることが許容される。

2025-12-21 時点で、[jQuery](https://github.com/jquery/jquery) の利用意義は、下記の条件が全て YES の場合のみに限定されます。

* 既存資産の強い制約がある。
* ブロック・テーマではなく ハイブリッド・テーマである。
* 対象 UI が「表示専用」である。
* パフォーマンス要件が厳しくない。
* WordPress コア同梱 jQuery のみを使う。
