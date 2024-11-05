<?php
require_once 'db_connect.php';

$cnt = 0;

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

$post_type_number_list = array();
foreach ($post_type_list as $item) {
    $post_type_number_list[$item['post_type']] = $item['post_cd'];
}

// detail_typeを取得する
$sql_detail_type = 'SELECT * FROM detail_type';
$stm = $pdo->prepare($sql_detail_type);
$stm->execute();
$detail_type_list = $stm->fetchAll(PDO::FETCH_ASSOC);

$detail_type_number_list = [];
foreach ($detail_type_list as $item) {
    $detail_type_number_list[$item['detail_type']] = $item['detail_cd'];
}

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

// 画像の格納フォルダパス
$imagePath = 'images/';

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

    // thumbnailテーブルからサムネイルを取得する
    $sql_thumbnail_select = 'SELECT thumbnail_url FROM thumbnail WHERE post_id = :post_id';
    $stm = $pdo->prepare($sql_thumbnail_select);
    $stm->bindValue(':post_id', $post_id, PDO::PARAM_INT);
    $stm->execute();
    $thumbnail = $stm->fetch(PDO::FETCH_ASSOC);

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

    // detailをひとつづつ配列に格納する
    $detail_array = [];
    $detail_num = 0;
    foreach ($detail_list as $detail) {
        $detail_array[$detail_num] = $detail;
        $detail_num++;
    }
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

    // echo 'post_flg'.$error_flg;

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

    // echo 'title'.$error_flg;

    // サムネイル
    $thumbnail_flg;
    if (isset($_POST['thumbnail_change_flg'])) {
        // 変更があるかチェックする
        $thumbnail_flg = $_POST['thumbnail_change_flg'];
        if ($thumbnail_flg === 1) {
            if (isset($_FILES['thumbnail'])) {
                if (!empty($_FILES['thumbnail'])) {
                    // フォルダ内に同じ名前の画像ファイルがないかチェックする
                    $imagesFolder = scandir($imagePath);
                    $thumbnail_name = $_FILES['thumbnail']['name'];

                    if ($imagesFolder !== false) {
                        if (in_array($thumbnail_name, $imagesFolder)) {
                            $thumbnail_flg = 0;
                        } else {
                            $thumbnail_path = 'images/' . $thumbnail_name;
                            $thumbnail_result = move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnail_path);
                        }
                    }
                } else {
                    $error['thumbnail'] = '画像が送られていません';
                    $error_flg = 1;
                }
            } else {
                $error['thumbnail'] = '画像が送られていません';
                $error_flg = 1;
            }
        }
    }

    echo $thumbnail_flg;

    // 記事のタグ(post_type)
    if (isset($_POST['post_type'])) {
        if (isset($post_type_number_list[$_POST['post_type']])) {
            $post_cd = $post_type_number_list[$_POST['post_type']];
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

    // echo 'detail_cnt' . $error_flg;

    // 現在日付取得
    $date = date('Y-m-d');

    /* 詳細部分のデータ取得 */

    // detail_cntの回数分だけ繰り返す
    for ($i = 0; $i < $send_detail_cnt; $i++) {
        // 見出し
        if (isset($_POST['subtitle' . strval($i)])) {
            if (!empty($_POST['subtitle' . strval($i)])) {
                $detail_type[$cnt] = $detail_type_number_list['subtitle'];
                $detail[$cnt] = $_POST['subtitle' . strval($i)];
                $cnt++;
            }
            // テキスト
        } else if (isset($_POST['text' . strval($i)])) {
            if (!empty($_POST['text' . strval($i)])) {
                $detail_type[$cnt] = $detail_type_number_list['text'];
                $detail[$cnt] = $_POST['text' . strval($i)];
                $cnt++;
            }
            // 新しく画像が登録される場合
        } else if (isset($_FILES['image' . strval($i)])) {
            if (!empty($_FILES['image' . strval($i)])) {
                $detail_type[$cnt] = $detail_type_number_list['image'];

                $img_name = $_FILES['image' . strval($i)]['name'];
                $img_path = 'images/' . $img_name;
                $result = move_uploaded_file($_FILES['image' . strval($i)]['tmp_name'], $img_path);

                $detail[$cnt] = $img_name;
                $cnt++;
            }
            // 既存の画像の場合
        } else if (isset($_POST['prevFile' . strval($i)])) {
            if ($_POST['prevFile' . strval($i)] === $detail_array[$i]['detail_text']) {
                $detail_type[$i] = $detail_type_number_list['image'];
                $detail[$i] = $_POST['prevFile' . strval($i)];
                $cnt++;
            }
        }
    }


    /* データベース登録処理($error_flg = 0のときのみ) */
    if ($error_flg === 0) {
        // postテーブル更新処理
        $sql_post = 'UPDATE post SET title = :title, post_cd = :post_cd, detail_cnt = :detail_cnt, edit_date = :edit_date, post_flg = :post_flg WHERE post_id = :post_id';
        $stm = $pdo->prepare($sql_post);
        $stm->bindValue(':title', $title, PDO::PARAM_STR);
        $stm->bindValue(':post_cd', $post_cd, PDO::PARAM_INT);
        $stm->bindValue(':detail_cnt', $cnt, PDO::PARAM_INT);
        $stm->bindParam(':edit_date', $date, PDO::PARAM_STR);
        $stm->bindValue(':post_flg', $post_flg, PDO::PARAM_INT);
        $stm->bindValue(':post_id', $post_id, PDO::PARAM_INT);
        $stm->execute();

        // thumbnailテーブル更新処理
        // 更新の必要有無チェック
        if ($thumbnail_flg === 1) {
            $sql_thumbnail_register = 'UPDATE thumbnail SET thumbnail_url = :thumbnail_url WHERE post_id = :post_id';
            $stm = $pdo->prepare($sql_thumbnail_register);
            $stm->bindValue(':thumbnail_url', $thumbnail_name, PDO::PARAM_STR);
            $stm->bindValue(':post_id', $post_id, PDO::PARAM_INT);
            $stm->execute();
        }

        // detailの削除(リセット)
        $sql_detail_delete = 'DELETE FROM detail WHERE post_id = :post_id';
        $stm = $pdo->prepare($sql_detail_delete);
        $stm->bindValue(':post_id', $post_id, PDO::PARAM_INT);
        $stm->execute();

        // detailの更新処理
        $detail_sql = 'INSERT INTO detail (post_id, detail_no, detail_cd, detail_text) VALUES (:post_id, :detail_no, :detail_cd, :detail_text)';
        for ($i = 0; $i < $cnt; $i++) {
            $stm = $pdo->prepare($detail_sql);
            $stm->bindValue(':post_id', $post_id, PDO::PARAM_INT);
            $stm->bindValue(':detail_no', $i, PDO::PARAM_INT);
            $stm->bindValue(':detail_cd', $detail_type[$i], PDO::PARAM_INT);
            $stm->bindValue(':detail_text', $detail[$i], PDO::PARAM_STR);
            $stm->execute();
        }

        // header('Location: notice_edit.php?id=14');
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
    <style>
        /* テスト時に見やすくしたいだけだからけしていいよ */
        img {
            width: 400px;
            height: 300px;
            object-fit: cover;
        }

        label span {
            text-align: center;
            border: 1px solid #000000;
        }
    </style>
</head>

<body>
    <form action="notice_edit.php?id=<?php echo $post_id; ?>" method="post" enctype="multipart/form-data">
        <!-- タイトル -->
        <label>タイトル</label>
        <input type="text" name="title" value="<?php echo $post['title']; ?>"><br>

        <!-- 続きがここから -->
        <!-- サムネイル -->
        <label>サムネイル</label>
        <img src="<?php echo 'images/' . $thumbnail['thumbnail_url']; ?>" id="thumbnail_preview">
        <input type="file" id="thumbnail" onchange="thumbnailPreview(this)" accept="image/*" name="">
        <input type="number" name="thumbnail_change_flg" value="0" min="0" max="1" id="thumbnail_change_flg">
        <label for="thumbnail"><span>開く</span></label>

        <!-- 記事のタグ -->
        <label>タグ</label>
        <select name="post_type">
            <option value="notice" <?php echo $post_type_check['notice']; ?>>お知らせ</option>
            <option value="event" <?php echo $post_type_check['event']; ?>>イベント</option>
        </select><br>

        <!-- detail -->

        <?php
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
            <div id="<?php echo "Box" . strval($cnt); ?>" class="box">
                <!-- 追加要素選択 -->
                <select onchange="selectContent(<?php echo $cnt; ?>)">
                    <option disabled selected>形式を選択してください</option>
                    <option value="subtitle" <?php echo $detail_type_check['subtitle']; ?>>サブタイトル</option>
                    <option value="text" <?php echo $detail_type_check['text']; ?>>テキスト</option>
                    <option value="image" <?php echo $detail_type_check['image']; ?>>画像</option>
                </select>

                <!-- 画像の場合 -->
                <?php if ($detail_type['input_type'] === 'file') { ?>
                    <img src="<?php echo 'images/' . $detail['detail_text']; ?>">
                    <input type="file" accept="image/*" hidden name="<?php echo "file" . strval($cnt); ?>" id="<?php echo "file" . strval($cnt); ?>" class="input" onchange="changeFile(this, <?php echo $cnt; ?>)">
                    <label for="<?php echo "file" . $cnt; ?>"><span>開く</span></label>
                    <input type="hidden" value="<?php echo $detail['detail_text']; ?>" name="<?php echo "prevFile" . strval($cnt); ?>" id="<?php echo "prevFile" . strval($cnt); ?>">
                    <!-- 見出しまたはテキストの場合 -->
                <?php } else { ?>
                    <input
                        name="<?php echo $detail_type['detail_type'] . strval($cnt); ?>"
                        type="<?php echo $detail_type['input_type']; ?>"
                        value="<?php echo $detail['detail_text']; ?>"
                        class="input">
                <?php } ?>
                <!-- 削除ボタン -->
                <button type="button" onclick="deleteContent(<?php echo $cnt ?>)">削除</button>
            </div>
        <?php
            $cnt++;
        }
        ?>

        <div id="<?php echo "Box" . strval($cnt); ?>" class="box">
            <!-- 追加要素選択 -->
            <select onchange="selectContent(<?php echo $cnt; ?>)">
                <option disabled selected>形式を選択してください</option>
                <option value="subtitle">サブタイトル</option>
                <option value="text">テキスト</option>
                <option value="image">画像</option>
            </select>
        </div>

        <!-- detail_cnt -->
        <input type="hidden" id="detail_cnt" name="detail_cnt" value="<?php echo $post['detail_cnt']; ?>">

        <!-- button -->
        <input type="submit" value="未公開" name="unreleased">
        <input type="submit" value="公開" name="released">
    </form>

    <script src="js/notice_edit.js" defer></script>
</body>

</html>