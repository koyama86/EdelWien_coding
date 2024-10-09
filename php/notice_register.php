<?php
require_once 'db_connect.php';


$error = [
    'released' => '',
    'post_type' => '',
    'title' => '',
    'detail' => '',
    'detail_cnt' => '',
];

// 記事のタグ
$post_type_list = [
    'notice' => 0,
    'event' => 1,
];

// 詳細部分の形式
$detail_type_list = [
    'subtitle' => 0,
    'text' => 1,
    'image' => 2,
];

// カウント変数(中身のある要素があった時だけ+1する)
$cnt = 0;

// $detail_typeと$detailの2つの配列番号は紐づく
// 要素の形式を保存する配列
$detail_type = [];
// 要素の中身を保存する配列
$detail = [];


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

                $detail[$cnt] = $img_name;
                $cnt++;
            }
        }
    }

    /* データベース登録処理($error_flg = 0のときのみ) */
    if ($error_flg === 0) {
        // postテーブル登録処理
        $sql_post = 'INSERT INTO post (title, post_cd, detail_cnt, post_date, edit_date, post_flg) VALUES (:title, :post_cd, :detail_cnt, :post_date, :edit_date, :post_flg)';
        $stm = $pdo->prepare($sql_post);
        $stm->bindValue(':title', $title, PDO::PARAM_STR);
        $stm->bindValue(':post_cd', $post_type, PDO::PARAM_INT);
        $stm->bindValue(':detail_cnt', $cnt, PDO::PARAM_INT);
        $stm->bindParam(':post_date', $date, PDO::PARAM_STR);
        $stm->bindParam(':edit_date', $date, PDO::PARAM_STR);
        $stm->bindValue(':post_flg', $post_flg, PDO::PARAM_INT);
        $stm->execute();

        // 追加したpostのpost_idを取得する
        $selectId_sql = 'SELECT MAX(post_id) AS max FROM post';
        $stm = $pdo->prepare($selectId_sql);
        $stm->execute();
        $post_id = $stm->fetch(PDO::FETCH_ASSOC)['max'];

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
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .hidden {
            display: none;
        }
    </style>

<body>
    <form action="notice_register.php" method="post" enctype="multipart/form-data">

        <!-- タイトル -->
        <label>タイトル</label>
        <input type="text" name="title"><br>

        <!-- 記事のタグ -->
        <label>タグ</label>
        <select name="post_type">
            <option value="notice">お知らせ</option>
            <option value="event">イベント</option>
        </select><br>

        <!-- detial -->
        <div id="Box0" class="box">
            <select onchange="selectContent(0)">
                <option disabled selected>形式を選択してください</option>
                <option value="subtitle">サブタイトル</option>
                <option value="text">テキスト</option>
                <option value="image">画像</option>
            </select>
        </div>

        <!-- detail_cnt -->
        <input type="hidden" id="detail_cnt" name="detail_cnt" value="0">

        <!-- button -->
        <input type="submit" value="未公開" name="unreleased">
        <input type="submit" value="公開" name="released">
    </form>

    <script src="js/notice_register.js" defer></script>
</body>

</html>