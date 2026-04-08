# KIS2026 テーマ向け「細分化仕様」提案 (`docs_mod`)

[stein2nd/wp-plugin-spec](https://github.com/stein2nd/wp-plugin-spec.git) で採用したドキュメント分割方針を、**プロジェクト類型が「プラグイン」ではなく「テーマ」** である前提で踏襲するための案です。  
本ファイルは **正式な `docs/` 配下の仕様ではなく**、採用前の設計メモ (提案) として `docs_mod` に置きます。

---

## 1. 方針 (プラグイン仕様との対応関係)

* **意図**: 全体の入口・索引・用語
   * **プラグイン側 (参考)**: `docs/WP_PLUGIN_SPEC.md`
   * **テーマ側 (本リポジトリへの提案名)**: `docs/WP_THEME_SPEC.md`
* **意図**: 存在理由・背景・スコープ
   * **プラグイン側 (参考)**: `docs/PLUGIN_SPEC_OVERVIEW_TEMPLATE.md`
   * **テーマ側 (本リポジトリへの提案名)**: `docs/THEME_SPEC_OVERVIEW_TEMPLATE.md`
* **意図**: コード構造と責務
   * **プラグイン側 (参考)**: `docs/PLUGIN_SPEC_ARCHITECTURE_TEMPLATE.md`
   * **テーマ側 (本リポジトリへの提案名)**: `docs/THEME_SPEC_ARCHITECTURE_TEMPLATE.md`
* **意図**: UI・API・データを小〜中規模向けに1本化
   * **プラグイン側 (参考)**: `docs/PLUGIN_SPEC_UI_API_DATA_TEMPLATE.md`
   * **テーマ側 (本リポジトリへの提案名)**: `docs/THEME_SPEC_TEMPLATES_UI_INTEGRATION_DATA_TEMPLATE.md`
   * **意図**: 上記3領域の分割版 (大規模・厳密に分けたい場合)
      * **プラグイン側 (参考)**: `PLUGIN_SPEC_UI_AND_FLOWS` / `API_AND_INTEGRATION` / `DATA_DICTIONARY`
      * **テーマ側 (本リポジトリへの提案名)**: 下記 3 ファイル (任意)
* **意図**: 国際化・アクセシビリティ
   * **プラグイン側 (参考)**: `docs/PLUGIN_SPEC_I18N_AND_A11Y_TEMPLATE.md`
   * **テーマ側 (本リポジトリへの提案名)**: `docs/THEME_SPEC_I18N_AND_A11Y_TEMPLATE.md`
* **意図**: AI 伴走開発ルール
   * **プラグイン側 (参考)**: `docs/PLUGIN_SPEC_AI_COLLAB_TEMPLATE.md`
   * **テーマ側 (本リポジトリへの提案名)**: `docs/THEME_SPEC_AI_COLLAB_TEMPLATE.md`
* **意図**: CI/CD 共通仕様 (組織横断)
   * **プラグイン側 (参考)**: `docs/COMMON_SPEC_CICD.md`
   * **テーマ側 (本リポジトリへの提案名)**: **そのまま参照** (テーマ用に言い換えた版を、組織リポジトリ側で整備する想定)
* **意図**: CI/CD 追記のアイデア置き場
   * **プラグイン側 (参考)**: `docs_mod/PLUGIN_SPEC_TEST_AND_CICD_TEMPLATE.md`
   * **テーマ側 (本リポジトリへの提案名)**: `docs_mod/THEME_SPEC_TEST_AND_CICD_TEMPLATE.md` (本フォルダに新設)

命名は **`PLUGIN_` → `THEME_`**、`WP_PLUGIN_SPEC` → **`WP_THEME_SPEC`** とし、wp-plugin-spec 利用者がパスを置換するだけで辿れるようにします。

---

## 2. テーマ開発で「プラグイン仕様からアレンジが必要」な点

テーマでは、次のような emphasis の差があります。各テンプレートの「必須セクション」をここに合わせて定義すると、運用が揃います。

1. **管理画面 UI**
   プラグインの「設定画面、一覧、メタボックス」中心ではなく、テーマは **サイトエディター / ブロックエディター / (レガシーなら) カスタマイザー** が主戦場になりやすい。
   オプション用の独自管理画面がある場合のみ、プラグインの UI 記述に近づける。

2. **REST / 外部連携**
   テーマ単体では **独自 REST ルートを持たない** ことが多い。
   代わりに **ブロック・エディター用のデータ取得、`block.json`、エディター・スクリプトの依存関係、フロントでのサードパーティ読み込み** を「連携」として書く。

3. **データ・ストレージ**
   カスタム DB テーブルより **`theme.json`、スタイル・バリエーション、`templates/` / `parts/` / `patterns/`、テーマモッド、カスタムフィールド (プラグイン依存ならその境界)** を辞書化する。

4. **ビルドパイプライン**
   本リポジトリのように、**Vite、エントリー単一化、外部化 (`@wordpress/*` / jQuery)** は、プラグイン以上にテーマ文脈で重要。
   `THEME_SPEC_ARCHITECTURE` または専用小節で固定化する価値が高い。

5. **クラシック ↔ ブロック移行**
   KIS2026 の `docs/SPEC.md` にある通り、**ハイブリッド期のテンプレート階層 (PHP テンプレートと FSE 資産の共存)** を Overview / Architecture に明示すると、プラグイン仕様には無い固有の価値になる。

---

## 3. `docs/` に置くことを想定した、ファイル一覧と役割

### 3.1. `docs/WP_THEME_SPEC.md` (必須・索引)

* 本テーマの仕様ドキュメントの **唯一の入口** (README からはここを指す)。
* 下位テンプレートへのリンク、**「テーマとプラグインの責務分界」** (何をテーマに書かないか)、用語 (FSE、テンプレートパート、パターンなど)。
* 組織共通の `COMMON_SPEC_CICD.md` への参照 (テーマ用に追記された節があれば、そのアンカー)。

### 3.2. `docs/THEME_SPEC_OVERVIEW_TEMPLATE.md`

* プロジェクトの存在理由、対象サイト、移行戦略 (クラシック → ブロック)。
* 非目標 (やらないこと)、ステークホルダー、リリース単位の見え方。
* 現行 `docs/SPEC.md` の **§1 テーマ概要・背景・今後の展開** が主な移行元。

### 3.3. `docs/THEME_SPEC_ARCHITECTURE_TEMPLATE.md`

* ディレクトリ構成、`functions.php` の責務、PHP テンプレートとブロックテーマ資産の関係。
* `src/` (TS / SCSS)、`dist/`、エンキュー方針、Vite の制約 (単一エントリ、IIFE 等)。
* Lint / フォーマット設定の「なぜその形式か」は、ここまたはビルド専用小節に集約可能。
* 現行 `docs/SPEC.md` の **§2 プロジェクト構成、§3 技術スタック、§4 スタイル設計、§5 のうち、アーキテクチャに関わる節** が移行元。

### 3.4. `docs/THEME_SPEC_TEMPLATES_UI_INTEGRATION_DATA_TEMPLATE.md` (小〜中規模向け・1ファイル版)

プラグイン側の `PLUGIN_SPEC_UI_API_DATA_TEMPLATE.md` に相当。
**テーマ向けに中身の見出しを差し替えた、統合テンプレート** として使う。

想定セクション例：

* **テンプレートと画面遷移**:
   アーカイブ / 単一 / 固定ページ、404、検索、(あれば) カスタム投稿タイプテンプレート。
   サイトマップ上の「画面」一覧。
* **エディター・サイト編集体験**:
   どのコンテンツをブロックで持ち、どこをテンプレート固定にするか。
   パターンの役割。
* **連携**:
   外部スクリプト、地図、分析、フォームプラグインとのスタイル境界、`register_block_type` / `block.json` の有無。
* **データ辞書**:
   `theme.json` の主要キー、カラーパレット、タイポグラフィー、レイアウト制約、テーマモッドやオプションの一覧 (キー、型、デフォルト値、永続先)。

### 3.5. 分割版 (大規模化したときの任意テンプレート)

* **ファイル名**: `docs/THEME_SPEC_TEMPLATES_AND_FLOWS_TEMPLATE.md`
   * **主な内容**: PHP / HTML テンプレート、`templates/`・`parts/`、ユーザー導線、ナビ、パンくず
* **ファイル名**: `docs/THEME_SPEC_INTEGRATION_TEMPLATE.md`
   * **主な内容**: フック、`enqueue`、ブロック登録、エディター用スクリプト、外部 API、CDN
* **ファイル名**: `docs/THEME_SPEC_DATA_DICTIONARY_TEMPLATE.md`
   * **主な内容**: `theme.json`、カスタムロゴ、メニュー位置、オプション、翻訳ドメインとファイル

### 3.6. `docs/THEME_SPEC_I18N_AND_A11Y_TEMPLATE.md`

* `load_theme_textdomain`、`languages/`、`style.css` の Text Domain。
* エスケープ方針、RTL、見出し階層、キーボード操作、フォーム・モーダル等 (テーマが担う範囲)。

### 3.7. `docs/THEME_SPEC_AI_COLLAB_TEMPLATE.md`

* wp-plugin-spec の同名テンプレートと同型。
**テーマ用語 (テンプレートパート、`theme.json` 変更時の注意)** に差し替え。

---

## 4. `docs_mod` に置く補助ファイル (提案)

組織側の `COMMON_SPEC_CICD.md` が WordPress プラグイン寄りのままの間、**テーマリポジトリ側で「追記したい論点だけ」を溜める** 用途です。

### 4.1. `docs_mod/THEME_SPEC_TEST_AND_CICD_TEMPLATE.md` (新設推奨)

プラグイン側の `docs_mod/PLUGIN_SPEC_TEST_AND_CICD_TEMPLATE.md` と対になるファイル。
例：

* `npm run build` / `lint` を CI でどう回すか (Node バージョン、キャッシュ)。
* テーマ zip 化の有無、配布チャネル (自社サイトのみ / 配布なし)。
* WordPress バージョン行列、e2e (Playwright 等) をやるか、静的解析のみか。
* `dist/` をコミットするか、デプロイ先でビルドするか (チーム方針)。

`COMMON_SPEC_CICD.md` がテーマ用に更新されたら、本ファイルの内容を共通側へ吸い上げる想定。

---

## 5. 現行 `docs/SPEC.md` からの移行マッピング (作業メモ)

| 現行 `SPEC.md` | 主な行き先 (提案) |
|----------------|-------------------|
| §1 テーマ概要 | `THEME_SPEC_OVERVIEW` |
| §2 プロジェクト構成 | `THEME_SPEC_ARCHITECTURE` |
| §3 技術スタック・ビルド | `THEME_SPEC_ARCHITECTURE` (＋統合テンプレートの「連携・ビルド」小節) |
| §4 スタイル設計 | `THEME_SPEC_ARCHITECTURE` または統合テンプレートの「データ・デザイントークン」 |
| §5 実装修正履歴 | **別ファイル推奨**: `docs/CHANGELOG.md` または `docs/HISTORY.md` に移し、SPEC 本体は現状に縮約 (wp-plugin-spec と同様、履歴は仕様から切り離す運用がしやすい) |
| §6 Backlog | `docs/BACKLOG.md` または Overview の末尾 (チーム運用に合わせて選択) |

移行後もしばらくは **`docs/SPEC.md` を `WP_THEME_SPEC.md` へリダイレクト用に残す** (中身1行で新索引へ誘導) と、既存リンクの破壊を防げます。

---

## 6. 採用時の最小ステップ (推奨順)

1. `docs/WP_THEME_SPEC.md` を追加し、現行 `SPEC.md` へのリンクを README から差し替え (または併記)。
2. `THEME_SPEC_OVERVIEW` と `THEME_SPEC_ARCHITECTURE` から実体を切り出し (内容は既存 `SPEC.md` のコピー調整で可)。
3. 小〜中規模のままなら統合テンプレート `THEME_SPEC_TEMPLATES_UI_INTEGRATION_DATA_TEMPLATE.md` のみ整備し、分割版は空テンプレートまたは未作成のままにする。
4. `docs_mod/THEME_SPEC_TEST_AND_CICD_TEMPLATE.md` に CI 方針の箇条書きを蓄積。
5. 組織の `COMMON_SPEC_CICD.md` がテーマ対応したら、重複を削減。

---

## 7. 本提案のスコープ外 (意図的に含めていないもの)

* wp-plugin-spec リポジトリ内の実ファイルのコピー (ライセンス・メンテナンスの都合は組織側で決定)。
* `COMMON_SPEC_CICD.md` 本体の編集 (未完了のうちは本 `docs_mod` のテンプレートのみ先行)。

以上が、**KIS2026 テーマ用の細分化仕様**として `docs_mod` に置く提案の全体像です。
