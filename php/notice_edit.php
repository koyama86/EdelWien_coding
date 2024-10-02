<?php
require_once 'db_connect.php';

if (isset($_GET['id'])) {
    // パラメータを受け取る
    $post_id = $_GET['id'];

    // postテーブルからデータを取得する
    $sql_post_select = 'SELECT * FROM post WHERE post_id = :post_id';
    $stm = $pdo->prepare($sql_post_select);
    $stm->bindValue(':post_id', $post_id, PDO::PARAM_INT);
    $stm->execute();
    $post = $stm->fetch(PDO::FETCH_ASSOC);

    // detailテーブルからデータを取得する
    $sql_detail_select = 'SELECT * FROM detail WHERE post_id = :post_id ORDER BY detail_no DESC';
    $stm = $pdo->prepare($sql_detail_select);
    $stm->bindValue(':post_id', $post_id, PDO::PARAM_INT);
    $stm->execute();
    $detail_list = $stm->fetchAll(PDO::FETCH_ASSOC);
}
?>