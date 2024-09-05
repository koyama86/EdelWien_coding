<!-- 

//SQL文 降順にデータを8つ取得するsql文
$sql = "SELECT * FROM テーブル名 ORDER BY id DEC LIMIT 8 ";


//お試し
$hairetu = $sql;
<div class="info flex">
    foreac$hairetu as $result ){
        <div class="info_content" >
            <img src="$encode($result['p)ath']" >
        </div>
    }
</div>

-->

<?php
require_once "db_connect.php";

// chatテーブルから全件表示,取得したid以降のものを表示する
$sql = "SELECT * FROM テーブル名 WHERE post_flg = 'true' ORDER BY id DESC LIMIT 8 ";

$stm = $pdo->prepare($sql);
$stm->execute();
$contents = array_map('htmlspecialchars', $stm->fetchAll(PDO::FETCH_ASSOC));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents('php://input');
    $contents = json_decode($data, true);
    file_put_contents('data.json', json_encode($contents));
    echo json_encode(['status' => 'success']);
    exit;
}

// $stm = $pdo->prepare($sql);

// // idを取得する
// // $stm->bindValue(":id",$_GET["id"],PDO::PARAM_INT);

// $stm->execute();

// $result = $stm->fetchAll(PDO::FETCH_ASSOC);

// $php_content1 = $encode($result[0]);

// $php_content2 = $encode($result[1]);

// $php_content3 = $encode($result[2]);

// $php_content4 = $encode($result[3]);

// $php_content5 = $encode($result[4]);

// $php_content6 = $encode($result[5]);

// $php_content7 = $encode($result[6]);

// $php_content8 = $encode($result[7]);

// // このPHPスクリプトが現在のページに埋め込まれていると仮定
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // JSONデータを受け取る
//     $data = file_get_contents('php://input');

//     // データをデコードして配列に変換
//     $contents = json_decode($data, true);

//     // データを処理（例: データベースに保存するなど）
//     // ここでは、データをファイルに保存する例を示します
//     // file_put_contents('data.json', json_encode($contents));

//     // 応答を返す
//     // echo json_encode(['status' => 'success']);

    

//     exit;
// }


// function $str)
// {
//     return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- reset css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css" />
    <!-- css link -->
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- css読み込む -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/indexslide.css">
    <title>Document</title>
</head>

<body>
    <nav>

    </nav>

    <div class="flex">
        <img class="carousel_font" src="../img/top/carousel_font.png" alt="">
        <img class="Pink_border" src="../img/top/Pink_border.png" alt="">
        <img class="small_font" src="../img/top/holiday.png" alt="">
        <div class="carousel">
            <img class="findimg_one" src="../img/top/find.png" alt="">
        </div>
    </div>
    <main>
        <!-- お知らせ -->
        <div class="Infomation">
            <div class="info_heading flex">
                <img src="../img/top/info_heading_border.png" alt="">
                <h1>お知らせ</h1>
                <img src="../img/top/info_heading_border.png" alt="">
            </div>
            <div class="info flex">
                <div class="info_content x_content">
                    <img class="img1" src="<?php echo $contents[0]["img"] ?>" alt="">
                    <p class="small_info"><?php echo $contents[0]["heading"] ?></p>
                    <p class="small_content"><?php echo $contents[0]["content"]?></p>
                    <p class="date"><?php echo $contents[0]["date"] ?></p>
                </div>
                <div class="info_content">
                    <img class="img2" src="<?php echo $contents[1]["img"] ?>" alt="">
                    <p class="small_info"><?php echo $contents[1]["heading"] ?></p>
                    <p class="small_content"><?php echo $contents[1]["content"] ?></p>
                    <p class="date"><?php echo $contents[1]["date"] ?></p>
                </div>
                <div class="info_content">
                    <img class="img3" src="<?php echo $contents[2]["img"] ?>" alt="">
                    <p class="small_event"><?php echo $contents[2]["heading"] ?></p>
                    <p class="small_content"><?php echo $contents[2]["content"] ?></p>
                    <p class="date"><?php echo $contents[2]["date"] ?></p>
                </div>
                <div class="info_content">
                    <img class="img4" src="<?php echo $contents[3]["img"] ?>" alt="">
                    <p class="small_info"><?php echo $contents[3]["heading"] ?></p>
                    <p class="small_content"><?php echo $contents[3]["content"] ?></p>
                    <p class="date"><?php echo $contents[3]["date"] ?></p>
                </div>
                <!-- <div class="info_content">
                    <img src="../img/find/find1.png" alt="">
                    <p class="small_event">イベント</p>
                    <p class="small_content">内容が入りますここにこの要素のpタグはすべてphpが使用されます</p>
                    <p class="date">xxxx/xx/xx</p>
                </div>
                <div class="info_content">
                    <img src="../img/find/find1.png" alt="">
                    <p class="small_info">お知らせ</p>
                    <p class="small_content">内容が入りますここにこの要素のpタグはすべてphpが使用されます</p>
                    <p class="date">xxxx/xx/xx</p>
                </div>
                <div class="info_content">
                    <img src="../img/find/find1.png" alt="">
                    <p class="small_info">お知らせ</p>
                    <p class="small_content">内容が入りますここにこの要素のpタグはすべてphpが使用されます</p>
                    <p class="date">xxxx/xx/xx</p>
                </div>
                <div class="info_content">
                    <img src="../img/find/find1.png" alt="">
                    <p class="small_info">お知らせ</p>
                    <p class="small_content">内容が入りますここにこの要素のpタグはすべてphpが使用されます</p>
                    <p class="date">xxxx/xx/xx</p>
                </div> -->
            </div>
            <img id="button" class="button" src="../img/find/button.png" alt="">
            <a href="" class="">一覧はこちら></a>
        </div>




    </main>


    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        
        let js_contents = <?php echo json_encode($contents); ?>;
        let index = 0;

        document.getElementById('button').addEventListener("click", function() {
            index = (index + 1) % js_contents.length;

            // 更新処理
            console.log(js_contents[index]);

            // サーバーへのPOSTリクエスト
            fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ index: index })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });

        // PHPからのデータをオブジェクトに格納
        // let js_contents = {
        //     1: <?php echo json_encode($php_content1); ?>,
        //     2: <?php echo json_encode($php_content2); ?>,
        //     3: <?php echo json_encode($php_content3); ?>,
        //     4: <?php echo json_encode($php_content4); ?>,
        //     5: <?php echo json_encode($php_content5); ?>,
        //     6: <?php echo json_encode($php_content6); ?>,
        //     7: <?php echo json_encode($php_content7); ?>,
        //     8: <?php echo json_encode($php_content8); ?>
        // };

        // // 初期化
        // let set = 0;
        // let number = 0;
        // let count = 0;

        // // ボタン要素を取得（idは適宜変更してください）
        // const button = document.getElementById('button');

        // button.addEventListener("click", function() {
        //     set += 1;
        //     count = set;
        //     number = 0;

        //     // コンテンツを一時的に格納する配列
        //     let tempContents = {};

        //     // コンテンツのシフト処理
        //     for(let i = 0; i < 8; i++) {
        //         if(number === 9) {
        //             set = 1;
        //             number = set;
        //         }
                
        //         // js_contents から動的に値を取得して tempContents に設定
        //         tempContents[number] = js_contents[count];
        //         count += 1;
        //         number += 1;
        //     }

        //     // 更新後の内容を js_contents に戻す
        //     for(let i = 1; i <= 8; i++) {
        //         js_contents[i] = tempContents[i] || js_contents[i];
        //     }

        //     // 結果を表示（例）
        //     console.log(js_contents);

        //     // データをPHPに送信
        //     fetcwindow.location.href, {
        //         method: 'POST',
        //         headers: {
        //             'Content-Type': 'application/json'
        //         },
        //         body: JSON.stringify(js_contents)
        //     })
        //     .then(response => response.json())
        //     .then(data => {
        //         console.log('Success:', data);
        //     })
        //     .catc(error) => {
        //         console.error('Error:', error);
        //     });
        // });
            
        // let img1 = document.querySelector(".img1")

        // let js_content1 = <?php echo $php_content1 ?>;
        // let js_content2 = <?php echo $php_content2 ?>;
        // let js_content3 = <?php echo $php_content3 ?>;
        // let js_content4 = <?php echo $php_content4 ?>;
        // let js_content5 = <?php echo $php_content5 ?>;
        // let js_content6 = <?php echo $php_content6 ?>;
        // let js_content7 = <?php echo $php_content7 ?>;
        // let js_content8 = <?php echo $php_content8 ?>;
        // let js_content0 = js_content1;

        // // 回数を数えて回す
        // let set = 0;
        // let number = 0;
        // let count = 0;
        // button.addEventListener("click", {

        //     set = set + 1;
        //     count = set;
        //     number = 0;
        //     for(let i = 0; i< 8; i++) {
        //         if(number === 9  ){
        //            set = 1;
        //            number = set;
        //         }
        //         eval(js_content + number) = eval(js_content + count);
        //         count += 1;
        //         number += 1;
                

        //     }
        // })

    </script>
</body>

</html>