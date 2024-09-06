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
        $select_sql = 'SELECT email FROM admin WHERE email = :email';
        $stm = $pdo->prepare($select_sql);
        $stm->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $stm->execute();
        $email_check = $stm->fetch(PDO::FETCH_ASSOC);

        // $email_checkに空っぽじゃなければエラー

        if (empty($email_check)) {
            $email = $_POST['email'];
            $_SESSION['email'] = $_POST['email'];
        } else {
            $error['email'] = '既に登録されているメールアドレスです';
            $error_flg = 1;
        }
    } else {
        $error['email'] = 'メールアドレスが未入力です';
        $error_flg = 1;
    }
}


if (isset($_POST['password'])) {
    if (!empty($_POST['password'])) {
        if (preg_match('/^[a-zA-Z0-9]{8,}$/u', $_POST['password']) === 1) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $_SESSION['password'] = $_POST['password'];
        } else {
            $error['password'] = '英数字8文字以上で入力してください';
            $error_flg = 1;
        }
    } else {
        $error['password'] = 'パスワードが未入力です';
        $error_flg = 1;
    }
}
// error_flgが0の時のみ登録処理
if ($error_flg === 0 && isset($_POST['email']) && isset($_POST['password'])) {
    $sql_register = 'INSERT INTO admin (email, password) VALUES (:email, :password)';
    $stm = $pdo->prepare($sql_register);
    $stm->bindValue(':email', $email, PDO::PARAM_STR);
    $stm->bindValue(':password', $password, PDO::PARAM_STR);
    $stm->execute();
    
    // セッション破棄
    $_SESSION = [];
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 1800);
    }
    session_destroy();
}

$email_value = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$password_value = isset($_SESSION['password']) ? $_SESSION['password'] : '';

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="admin_register.php" method="post">
        <label>メールアドレス</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email_value, ENT_QUOTES, 'UTF-8'); ?>"><br>
        <p><?php echo $error['email']; ?></p>

        <label>パスワード</label>
        <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($password_value, ENT_QUOTES, 'UTF-8'); ?>"><br>
        <input type="checkbox" id="view">パスワードを表示する<br>
        <p><?php echo $error['password']; ?></p>

        <input type="submit" value="サインアップ">
    </form>

    <script src="js/check_password.js" defer></script>
</body>

</html>