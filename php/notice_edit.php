<?php
require_once 'db_connect.php';

var_dump($_FILES);

// エラー文を格納する連想配列
$error = [
    'released' => '',
    'post_type' => '',
    'title' => '',
    'detail' => '',
    'detail_cnt' => '',
];

// post_typeを取得する
$sql_post_type = 'SELECT * FROM post_type';
$stm = $pdo->prepare($sql_post_type);
$stm->execute();
$post_type_list = $stm->fetchAll(PDO::FETCH_ASSOC);

// detail_typeを取得する
$sql_detail_type = 'SELECT * FROM detail_type';
$stm = $pdo->prepare($sql_detail_type);
$stm->execute();
$detail_type_list = $stm->fetchAll(PDO::FETCH_ASSOC);

// detail_cdからdetail_typeを参照して返す関数
function getDetailType($detail_type_list, $detail_cd)
{
    foreach ($detail_type_list as $detail_type) {
        if ($detail_cd === $detail_type['detail_cd']) {
            return $detail_type;
        }
    }
}

// タグチェックの連想配列
$post_type_check = [];
foreach ($post_type_list as $type) {
    $post_type_check[$type['post_type']] = '';
}

// detail_typeチェックの連想配列
$detail_type_check = [];
foreach ($detail_type_list as $type) {
    $detail_type_check[$type['detail_type']] = '';
}

// ページ遷移してきたとき
if (isset($_GET['id'])) {
    // パラメータを受け取る
    $post_id = $_GET['id'];

    // postテーブルからデータを取得する
    $sql_post_select = 'SELECT * FROM post WHERE post_id = :post_id';
    $stm = $pdo->prepare($sql_post_select);
    $stm->bindValue(':post_id', $post_id, PDO::PARAM_INT);
    $stm->execute();
    $post = $stm->fetch(PDO::FETCH_ASSOC);

    // post_typeテーブルからデータを取得する
    $sql_post_type_select = 'SELECT post_type FROM post_type WHERE post_cd = :post_cd';
    $stm = $pdo->prepare($sql_post_type_select);
    $stm->bindValue(':post_cd', $post['post_cd']);
    $stm->execute();
    $post_type = $stm->fetch(PDO::FETCH_ASSOC);

    // detailテーブルからデータを取得する
    $sql_detail_select = 'SELECT * FROM detail WHERE post_id = :post_id ORDER BY detail_no';
    $stm = $pdo->prepare($sql_detail_select);
    $stm->bindValue(':post_id', $post_id, PDO::PARAM_INT);
    $stm->execute();
    $detail_list = $stm->fetchAll(PDO::FETCH_ASSOC);
}

// フォーム送信後の処理
if (isset($_POST['unreleased']) || isset($_POST['released'])) {
    // エラーフラグ(１つでもエラーがあれば、登録処理を行わない)
    $error_flg = 0;

    // 公開フラグ (0: unreleased, 1: released)
    if (isset($_POST['unreleased'])) {
        $post_flg = 0;
    } else if (isset($_POST['released'])) {
        $post_flg = 1;
    } else {
        $error['released'] = '公開設定が未設定です';
        $error_flg = 1;
    }

    // タイトル
    if (isset($_POST['title'])) {
        if (!empty($_POST['title'])) {
            $title = $_POST['title'];
        } else {
            $error['title'] = 'タイトルが未入力です';
            $error_flg = 1;
        }
    } else {
        $error['title'] = 'タイトルが送られていません';
        $error_flg = 1;
    }

    // 記事のタグ(post_type)
    if (isset($_POST['post_type'])) {
        if (isset($post_type_list[$_POST['post_type']])) {
            $post_type = $post_type_list[$_POST['post_type']];
        } else {
            $error['post_type'] = '記事のタグの値が不正です';
            $error_flg = 1;
        }
    } else {
        $error['post_type'] = '記事のタグが設定されていません';
        $error_flg = 1;
    }

    // 詳細の要素数(detail_cnt)
    if (isset($_POST['detail_cnt'])) {
        $send_detail_cnt = $_POST['detail_cnt'];
    } else {
        $error['detail_cnt'] = 'detail_cntが送られていません';
        $error_flg = 1;
    }

    // 現在日付取得
    $date = date('Y-m-d');

    /* 詳細部分のデータ取得 */

    // detail_cntの回数分だけ繰り返す
    for ($i = 0; $i < $send_detail_cnt; $i++) {
        if (isset($_POST['subtitle' . strval($i)])) {
            if (!empty($_POST['subtitle' . strval($i)])) {
                $detail_type[$cnt] = $detail_type_list['subtitle'];
                $detail[$cnt] = $_POST['subtitle' . strval($i)];
                $cnt++;
            }
        } else if (isset($_POST['text' . strval($i)])) {
            if (!empty($_POST['text' . strval($i)])) {
                $detail_type[$cnt] = $detail_type_list['text'];
                $detail[$cnt] = $_POST['text' . strval($i)];
                $cnt++;
            }
        } else if (isset($_FILES['image' . strval($i)])) {
            if (!empty($_FILES['image' . strval($i)])) {
                $detail_type[$cnt] = $detail_type_list['image'];

                $img_name = $_FILES['image' . strval($i)]['name'];
                $img_path = 'images/' . $img_name;
                $result = move_uploaded_file($_FILES['image' . strval($i)]['tmp_name'], $img_path);

                $detail[$cnt] = $img_path;
                $cnt++;
            }
        }
    }

    /* データベース登録処理($error_flg = 0のときのみ) */
    if ($error_flg === 0) {
        // postテーブル登録処理
        $sql_post = 'UPDATE post SET title = :title, post_cd = :post_cd, detail_cnt = :detail_cnt, edit_date = :edit_date, post_flg = :post_flg WHERE post_id = :post_id';
        $stm = $pdo->prepare($sql_post);
        $stm->bindValue(':title', $title, PDO::PARAM_STR);
        $stm->bindValue(':post_cd', $post_type, PDO::PARAM_INT);
        $stm->bindValue(':detail_cnt', $cnt, PDO::PARAM_INT);
        $stm->bindParam(':edit_date', $date, PDO::PARAM_STR);
        $stm->bindValue(':post_flg', $post_flg, PDO::PARAM_INT);
        $stm->execute();

        // detailの削除(リセット)
        $sql_detail_delete = 'DELETE detail WHERE post_id = :post_id';
        $stm = $pdo->prepare($sql_detail_delete);
        $stm->bindValue(':post_id', $post_id, PDO::PARAM_INT);

        // detailの追加
        $detail_sql = 'INSERT INTO detail (post_id, detail_no, detail_cd, detail_text) VALUES (:post_id, :detail_no, :detail_cd, :detail_text)';
        for ($i = 0; $i < $cnt; $i++) {
            $stm = $pdo->prepare($detail_sql);
            $stm->bindValue(':post_id', $post_id, PDO::PARAM_INT);
            $stm->bindValue(':detail_no', $i, PDO::PARAM_INT);
            $stm->bindValue(':detail_cd', $detail_type[$i]);
            $stm->bindValue(':detail_text', $detail[$i]);
            $stm->execute();
        }
    }
}

// 表示するデータ
if (isset($post_type)) {
    $post_type_check[$post_type['post_type']] = 'selected';
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="notice_edit.php" method="post" enctype="multipart/form-data">
        <!-- タイトル -->
        <label>タイトル</label>
        <input type="text" name="title" value="<?php echo $post['title']; ?>"><br>

        <!-- 記事のタグ -->
        <label>タグ</label>
        <select name="post_type">
            <option value="notice" <?php echo $post_type_check['notice']; ?>>お知らせ</option>
            <option value="event" <?php echo $post_type_check['event']; ?>>イベント</option>
        </select><br>

        <!-- detail -->
        
        <?php
        var_dump($detail_list);
        $cnt = 0;
        foreach ($detail_list as $detail) {
            // detail_typeを取得する
            $detail_type = getDetailType($detail_type_list, $detail['detail_cd']);
            // detail_typeチェックの連想配列
            $detail_type_check = [];
            foreach ($detail_type_list as $type) {
                $detail_type_check[$type['detail_type']] = '';
            }
            $detail_type_check[$detail_type['detail_type']] = 'selected';
        
        ?>
        <div id="Box<?php echo `{$cnt}`; ?>">
            <select onchange="selectContent(<?php echo $cnt; ?>)">
            <option disabled selected>形式を選択してください</option>
                <option value="subtitle" <?php echo $detail_type_check['subtitle']; ?>>サブタイトル</option>
                <option value="text" <?php echo $detail_type_check['text']; ?>>テキスト</option>
                <option value="image" <?php echo $detail_type_check['image']; ?>>画像</option>
            </select>
            <input
            name="<?php echo $detail_type['detail_type'].$cnt; ?>"
            type="<?php echo $detail_type['input_type']; ?>"
            value="<?php echo $detail['detail_text']; ?>"
            <?php if($detail_type['input_type'] === 'file') echo `accept="image/*"`; ?>>
            <button type="button" onclick="deleteContent(<?php echo $cnt ?>)">削除</button>
        </div>
        <?php
        $cnt++;
        }
        ?>

        <!-- detail_cnt -->
        <input type="hidden" id="detail_cnt" name="detail_cnt" value="<?php echo $post['detail_cnt']; ?>">

        <!-- button -->
        <input type="submit" value="未公開" name="unreleased">
        <input type="submit" value="公開" name="released">
    </form>
</body>

</html>