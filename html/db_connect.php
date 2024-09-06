<?php
// PHPからMySQLデータベースサーバへの接続

// ユーザ名
$user = "root";
// パスワード
$pass = "";
// データベース名
$database = "";
// サーバ名
$server = "localhost:3308";

//接続するための情報を組み立てる（DSN文字列)
$dsn ="mysql:host={$server};dbname={$database};charaset=utf8";

// PDOを使ってmysqlに接続する

try {
    //PDOクラスのインスタンスを作成してDBに接続する
    $pdo = new PDO($dsn, $user, $pass);

    // プリペアドステートメントのエミュレーションを無効化
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // 例外をスローする
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "データベースに接続しました";

} catch (Exception $e) {
    echo "データベース接続エラー";
    echo $e->getMessage();
}