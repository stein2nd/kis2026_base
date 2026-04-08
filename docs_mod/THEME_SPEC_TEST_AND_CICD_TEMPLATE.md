# テーマ向けテスト・CI/CD 記述メモ (`docs_mod`)

[stein2nd/wp-plugin-spec](https://github.com/stein2nd/wp-plugin-spec.git) の `docs/COMMON_SPEC_CICD.md` を WordPress テーマ開発向けに展開・追記する際の **論点メモ** です。  
確定仕様は組織共通の `COMMON_SPEC_CICD.md` に集約し、本ファイルは **KIS2026 固有や先行ドラフト** の置き場にしてください。

---

## 1. 継続的インテグレーションで回すコマンド

* Node.js のバージョン (`.nvmrc` / `engines` との整合)
* `npm ci` vs `npm install`
* `npm run build` / `npm run build:dev` のどちらを CI で必須にするか
* `npm run lint` / `format:check` の有無
* 失敗時のアーティファクト (ログ保持の要否)

## 2. ビルド成果物とリポジトリ方針

* `dist/` をコミットするか (デプロイでビルドするか)
* テーマ zip の生成有無、生成物の命名規則
* サードパーティ静的コピー (例: `vite-plugin-static-copy`) の取りこぼし検知

## 3. WordPress 実行環境との結合度

* ユニットテストのみ / WP 環境を立てるか (Docker、wp-env 等)
* 最低サポート WP バージョンと CI マトリクス
* PHP リンター (PHPCS 等) をテーマに導入するか

## 4. E2E・ビジュアルリグレッション (任意)

* 対象 URL・テンプレートの優先順位
* ステージングとの同期方法
* 実行頻度 (PR 毎 / nightly)

## 5. デプロイ

* SFTP / Git 連携 / マネージドホストのパイプライン
* `FLUSH_DIST` 等、環境変数依存のドキュメント化

---

`COMMON_SPEC_CICD.md` にテーマ節が追加されたら、本ファイルから移設済みの項目は削除してよいです。
