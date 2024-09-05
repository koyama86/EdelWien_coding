<!-- 

//SQL文 降順にデータを8つ取得するsql文
$sql = "SELECT * FROM テーブル名 ORDER BY id DEC LIMIT 8 ";


//お試し
$hairetu = $sql;
<div class="info flex">
    foreach($hairetu as $result ){
        <div class="info_content" >
            <img src="$encode($result['p)ath']" >
        </div>
    }
</div>

-->

<?php
require_once "db_connect.php";

// chatテーブルから全件表示,取得したid以降のものを表示する
$sql = "SELECT * FROM テーブル名 ORDER BY id DEC LIMIT 8 ";

$stm = $pdo->prepare($sql);

// idを取得する
// $stm->bindValue(":id",$_GET["id"],PDO::PARAM_INT);

$stm->execute();

$result = $stm->fetchAll(PDO::FETCH_ASSOC);

$php_content1 = $encode($result[0]);

$php_content2 = $encode($result[1]);

$php_content3 = $encode($result[2]);

$php_content4 = $encode($result[3]);

$php_content5 = $encode($result[4]);

$php_content6 = $encode($result[5]);

$php_content7 = $encode($result[6]);

$php_content8 = $encode($result[7]);

// このPHPスクリプトが現在のページに埋め込まれていると仮定
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // JSONデータを受け取る
    $data = file_get_contents('php://input');

    // データをデコードして配列に変換
    $contents = json_decode($data, true);

    // データを処理（例: データベースに保存するなど）
    // ここでは、データをファイルに保存する例を示します
    // file_put_contents('data.json', json_encode($contents));

    // 応答を返す
    // echo json_encode(['status' => 'success']);

    

    exit;
}


function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

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
                    <img class="img1" src="<?php echo h($contents[0]["img"]) ?>" alt="">
                    <p class="small_info"><?php echo h($contents[0]["heading"]) ?></p>
                    <p class="small_content"><?php echo h($contents[0]["content"])?></p>
                    <p class="date"><?php echo h($contents[0]["date"]) ?></p>
                </div>
                <div class="info_content">
                    <img class="img2" src="<?php echo h($contents[1]["img"]) ?>" alt="">
                    <p class="small_info"><?php echo h($contents[1]["heading"]) ?></p>
                    <p class="small_content"><?php echo h($contents[1]["content"]) ?></p>
                    <p class="date"><?php echo h($contents[1]["date"]) ?></p>
                </div>
                <div class="info_content">
                    <img class="img3" src="<?php echo h($contents[2]["img"]) ?>" alt="">
                    <p class="small_event"><?php echo h($contents[2]["heading"]) ?></p>
                    <p class="small_content"><?php echo h($contents[2]["content"]) ?></p>
                    <p class="date"><?php echo h($contents[2]["date"]) ?></p>
                </div>
                <div class="info_content">
                    <img class="img4" src="<?php echo h($contents[3]["img"]) ?>" alt="">
                    <p class="small_info"><?php echo h($contents[3]["heading"]) ?></p>
                    <p class="small_content"><?php echo h($contents[3]["content"]) ?></p>
                    <p class="date"><?php echo h($contents[3]["date"]) ?></p>
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



        <!-- 見つける -->
        <div class="find">
            <div class="find_heading flex">
                <img src="../img/top/info_heading_border.png" alt="">
                <h1>見つける</h1>
                <img src="../img/top/info_heading_border.png" alt="">
            </div>

            <div class="scroll-infinity">
                <div class="scroll-infinity__wrap">
                    <ul class="scroll-infinity__list scroll-infinity__list--left ">
                        <li class="scroll-infinity__item">
                            <img class="h-100" src="../img/find/slider1.png" />
                        </li>
                        <div class="items_123 flex items-wrap ">
                            <img class="items1" src="../img/find/find1.png" />
                            <img class="items2" src="../img/find/find8.png" />
                            <img class="items3" src="../img/find/find2.png" />
                        </div>
                        <div class="items_45">
                            <img class="items4" src="../img/find/find3.png" />
                            <img class="items5" src="../img/find/find4.png" />
                        </div>
                        <div class="items_678">
                            <img class="items6" src="../img/find/find5.png" />
                            <div class="flex items_78">
                                <img class="items7" src="../img/find/find6.png" />
                                <img class="items8" src="../img/find/find7.png" />
                            </div>
                        </div>
                    </ul>
                    <ul class="scroll-infinity__list scroll-infinity__list--left ">
                        <li class="scroll-infinity__item">
                            <img class="h-100" src="../img/find/slider1.png" />
                        </li>
                        <div class="items_123 flex items-wrap ">
                            <img class="items1" src="../img/find/find1.png" />
                            <img class="items2" src="../img/find/find8.png" />
                            <img class="items3" src="../img/find/find2.png" />
                        </div>
                        <div class="items_45">
                            <img class="items4" src="../img/find/find3.png" />
                            <img class="items5" src="../img/find/find4.png" />
                        </div>
                        <div class="items_678">
                            <img class="items6" src="../img/find/find5.png" />
                            <div class="flex items_78">
                                <img class="items7" src="../img/find/find6.png" />
                                <img class="items8" src="../img/find/find7.png" />
                            </div>
                        </div>
                    </ul>
                </div>
            </div>

        </div>

        <!-- サンプル画像
        <img src="../img/top/../img/find/slider1.png" alt="" style="width: 80%; margin:100px 0 0 200px;;"> -->

        <!-- 一覧 -->
        <div class="kinds">
            <div class="flex box">
                <div class="experience">
                    <h1>たいけん</h1>
                    <h2>ガラス工房森のくに</h2>
                    <div class="flex">
                        <img class="e_l" src="../img/top/e_l.png" alt="">
                        <img class="e_r" src="../img/top/e_r.png" alt="">
                    </div>
                    <div class="flex">
                        <div class="wrap">
                            <img src="../img/top/wrap_lt.png" alt="">
                            <img src="../img/top/wrap_rt.png" alt="">
                            <img src="../img/top/wrap_lb.png" alt="">
                            <img src="../img/top/wrap_rb.png" alt="">
                        </div>
                        <div class="e_text">
                            <p>岩手県にも数少ない、体験できるガラス工房です。</p>
                            <p>すりガラス風のコップや吹きガラス、小物まで自作体験が可能です。
                                様々なガラス細工も販売しております。
                            </p>
                            <p>ぜひお子様やお友達、ご家族でお越しください</p>
                            <!-- 遷移リンク -->
                            <div>
                                <a href="">詳しくはこちら ></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="food">
                    <div class="flex">
                        <div>
                            <h1>たべる</h1>
                            <h2>レストランベルンドルフ</h2>
                        </div>
                        <img class="f_r" src="../img/top/f_r.png" alt="">
                    </div>
                    <div class="flex">
                        <img class="f_l" src="../img/top/f_l.png" alt="">
                        <div class="f_text">
                            <p>
                                地元特産の食材を取り入れた料理と、大迫特産のエーデルワインを提供しています。
                            </p>
                            <p>
                                昼食や夕食に豪華な食事の時間をお過ごしいただけます。
                            </p>

                            <!-- 遷移リンク -->
                            <div>
                                <a href="">詳しくはこちら ></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex box">
                <div class="wine">
                    <h1>あじわう</h1>
                    <h2>ワインシャトー大迫</h2>
                    <div class="flex">
                        <img class="w_l" src="../img/top/w_l.png" alt="">
                        <div class="w_text">
                            <p>
                                2000本貯蔵のワインセラーを完備したワインシャトー大迫。
                                テイスティングルームはもちろん、現地でワインがお楽しみいただけます。
                            </p>
                            <!-- 遷移リンク -->
                            <div>
                                <a href="">詳しくはこちら ></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hotel">
                    <div class="flex">
                        <div>
                            <h1>とまる</h1>
                            <h2>ホテルベルンドルフ</h2>
                        </div>
                        <img class="h_r" src="../img/top/h_r.png" alt="">
                    </div>
                    <div class="flex">
                        <img class="h_l" src="../img/top/h_l.png" alt="">
                        <div class="h_text">
                            <p>雄大な早池峰山の自然に溶け込む、このホテル。</p>
                            <p>
                                早池峰山登山の際にご利用いただくことはもちろん、
                                ガラス工房やレストラン、ワインシャトーと一緒に。
                            </p>

                            <!-- 遷移リンク -->
                            <div>
                                <a href="">詳しくはこちら ></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        // PHPからのデータをオブジェクトに格納
        let js_contents = {
            1: <?php echo json_encode($php_content1); ?>,
            2: <?php echo json_encode($php_content2); ?>,
            3: <?php echo json_encode($php_content3); ?>,
            4: <?php echo json_encode($php_content4); ?>,
            5: <?php echo json_encode($php_content5); ?>,
            6: <?php echo json_encode($php_content6); ?>,
            7: <?php echo json_encode($php_content7); ?>,
            8: <?php echo json_encode($php_content8); ?>
        };

        // 初期化
        let set = 0;
        let number = 0;
        let count = 0;

        // ボタン要素を取得（idは適宜変更してください）
        const button = document.getElementById('button');

        button.addEventListener("click", function() {
            set += 1;
            count = set;
            number = 0;

            // コンテンツを一時的に格納する配列
            let tempContents = {};

            // コンテンツのシフト処理
            for(let i = 0; i < 8; i++) {
                if(number === 9) {
                    set = 1;
                    number = set;
                }
                
                // js_contents から動的に値を取得して tempContents に設定
                tempContents[number] = js_contents[count];
                count += 1;
                number += 1;
            }

            // 更新後の内容を js_contents に戻す
            for(let i = 1; i <= 8; i++) {
                js_contents[i] = tempContents[i] || js_contents[i];
            }

            // 結果を表示（例）
            console.log(js_contents);

            // データをPHPに送信
            fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(js_contents)
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });
        
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