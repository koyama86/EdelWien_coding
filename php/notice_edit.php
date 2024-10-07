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