<?php
    require_once "db_connect.php";

    // chatテーブルから全件表示,取得したid以降のものを表示する
    $sql = "SELECT * FROM テーブル名 ORDER BY id DEC LIMIT 8 ";

    $stm = $pdo->prepare($sql);

    // idを取得する
    $stm->bindValue(":id",$_GET["id"],PDO::PARAM_INT);

    $stm->execute();

    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    $encode = $result;

    // var_dump($result);

    // DBから取得した構造化したデータをjson化する(jsが理解できる形に変換)
    // echo json_encode($result);
?>