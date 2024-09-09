<?php
// phpからMySQLデータベースサーバーへの接続

// ユーザー名
$user = "root";
// パスワード名
$pass = "";
// データベース名
$database = "edelwein-sport";
// サーバー名
$server = "localhost:3308";

// 接続するための情報を組み立てる(DSN文字列)
$dsn = "mysql:host={$server};dbname={$database};charaset=utf8";

// PDOを使ってMySQLへ接続する
try {
    // PDOクラスのインスタンスを作成してDBに接続する
    $pdo = new PDO($dsn, $user, $pass);

    // プリペアードステートメントのエミュレーションを無効か
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // 例外をスローする
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "データベースに接続しました";

} catch(Exception $e) {
    echo "データベース接続エラー";
    echo $e->getMessage();
}