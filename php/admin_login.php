<?php

require_once 'db_connect.php';

session_start();

$error = [
    'email' => '',
    'password' => '',
];

$error_flg = 0;

if (isset($_POST['email'])) {
    if (!empty($_POST['email'])) {
        // データベースから同じemailがあれば抽出する
        $select_sql = 'SELECT * FROM admin WHERE email = :email';
        $stm = $pdo->prepare($select_sql);
        $stm->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $stm->execute();
        $email_check = $stm->fetch(PDO::FETCH_ASSOC);

        // $email_checkに空っぽならエラー

        if (!empty($email_check)) {
            $_SESSION['email'] = $_POST['email'];

            // ここからパスワードチェック
            if (isset($_POST['password'])) {

                // 未入力か確認
                if (!empty($_POST['password'])) {

                    // 正規表現チェック
                    if (preg_match('/^[a-zA-Z0-9]{8,}$/u', $_POST['password']) === 1) {

                        // パスワードの照合
                        if (password_verify($_POST['password'], $email_check['password'])) {
                            // パスワードがあってた場合
                            echo 'matched';
                            // セッション破棄
                            $_SESSION = [];
                            if (isset($_COOKIE[session_name()])) {
                                setcookie(session_name(), '', time() - 1800);
                            }
                            session_destroy();
                            // header()
                        } else {
                            $error['password'] = 'パスワードが違います';
                        }
                    } else {
                        $error['password'] = '英数字8文字以上で入力してください';
                    }
                } else {
                    $error['password'] = 'パスワードが未入力です';
                }
            }
        } else {
            $error['email'] = 'このメールアドレスは登録されていません';
        }
    } else {
        $error['email'] = 'メールアドレスが未入力です';
    }
}

$email_value = isset($_SESSION['email']) ? $_SESSION['email'] : '';

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="admin_login.php" method="post">
        <label>メールアドレス</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email_value, ENT_QUOTES, 'UTF-8'); ?>"><br>
        <p><?php echo $error['email']; ?></p>

        <label>パスワード</label>
        <input type="password" name="password" id="password""><br>
        <input type="checkbox" id="view">パスワードを表示する<br>
        <p><?php echo $error['password']; ?></p>

        <input type="submit" value="ログイン">
    </form>

    <script src="js/check_password.js" defer></script>
</body>

</html>