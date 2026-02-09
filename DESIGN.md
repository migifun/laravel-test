# 受付アプリ 設計書

## 概要

来客受付用のWebアプリケーション。
来訪者がフォームに情報を入力し、送信すると呼び出し画面が表示され、一定時間後にフォームへ戻る。

## 技術スタック

| 項目 | 技術 | 理由 |
|------|------|------|
| フレームワーク | Laravel | 学習目的 |
| 言語 | PHP | Laravel の言語 |
| データベース | SQLite | サーバー不要、ファイル1つで完結 |
| Webサーバー | `php artisan serve` | 開発用組み込みサーバー |
| フロントエンド | Blade テンプレート | Laravel 標準のテンプレートエンジン |
| パッケージ管理 | Composer | PHP 標準 |

## 環境構築手順

1. Homebrew で PHP・Composer をインストール
2. `composer create-project laravel/laravel .` でプロジェクト作成
3. `.env` の DB 設定を SQLite に変更
4. マイグレーション実行
5. `php artisan serve` で起動（http://localhost:8000）

## 画面構成

### 1. 受付フォーム画面（トップページ）

- **URL**: `/`
- **機能**: 来訪者が情報を入力して送信する
- **入力項目**:
  - 名前（テキスト入力、必須）
  - 会社名（テキスト入力、必須）
  - 目的（セレクトボックス、必須）
    - 打ち合わせ
    - 面接
    - 納品・受取
    - その他
- **送信先**: `POST /reception`

### 2. 呼出画面

- **URL**: `GET /reception/{id}/calling`
- **機能**: 受付完了を表示し、数秒後にフォームへ自動遷移する
- **表示内容**:
  - 「○○様（△△社）、ただいまお呼び出ししております」
  - 目的の表示
  - 受付時刻の表示
- **自動遷移**: 5秒後にトップページへリダイレクト

## データベース設計

### receptions テーブル

| カラム | 型 | 説明 |
|--------|------|------|
| id | integer (PK) | 自動採番 |
| name | string | 来訪者名 |
| company | string | 会社名 |
| purpose | string | 目的 |
| created_at | timestamp | 受付日時 |
| updated_at | timestamp | 更新日時 |

## ルーティング

| メソッド | URL | 処理 |
|----------|-----|------|
| GET | `/` | フォーム画面を表示 |
| POST | `/reception` | 受付情報を保存し、呼出画面へリダイレクト |
| GET | `/reception/{id}/calling` | 呼出画面を表示 |

## ディレクトリ構成（主要ファイル）

```
app/
  Models/
    Reception.php          # 受付モデル
  Http/
    Controllers/
      ReceptionController.php  # 受付コントローラー
database/
  migrations/
    xxxx_create_receptions_table.php  # マイグレーション
resources/
  views/
    reception/
      form.blade.php       # 受付フォーム画面
      calling.blade.php    # 呼出画面
```

## 画面遷移フロー

```
[受付フォーム画面]
    │
    │ POST /reception（名前・会社名・目的を送信）
    │
    ▼
[データベースに保存]
    │
    │ リダイレクト → GET /reception/{id}/calling
    │
    ▼
[呼出画面]
    │
    │ 5秒後に自動遷移
    │
    ▼
[受付フォーム画面] ← 最初に戻る
```
