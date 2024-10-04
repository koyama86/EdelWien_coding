<?php

require_once "./db_connect.php";

//SQL文 降順にデータを8つ取得するsql文
$sql = "SELECT * FROM post ORDER BY post_id DESC LIMIT 8";

$stm = $pdo->prepare($sql);

$stm->execute();

$result = $stm->fetchAll(PDO::FETCH_ASSOC);

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

?>

<!DOCTYPE html>
<html lang="ja">

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
    <!-- font: Kiwi Maru -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&display=swap" rel="stylesheet" />
    <title>Document</title>
</head>

<body>
    <nav>

    </nav>

    <!-- タイトル部分 -->
    <div class="TitleBox">
        <!-- carousel以外 -->
        <div class="FlexRow">
            <!-- 縦の横向き文字 -->
            <div id="MainTextBox">
                <h1 class="MainText">たいけん</h1>
                <h1 class="MainText ThreeChar Hidden">とまる</h1>
                <h1 class="MainText ThreeChar Hidden">たべる</h1>
                <h1 class="MainText Hidden">あじわう</h1>
            </div>

            <!-- 点線 -->
            <div class="DottedLine"></div>
            <div class="DottedLine"></div>

            <!-- 英語 -->
            <p class="TextVertical">Holiday & Edelwien Sport</p>
        </div>

        <!-- caroucel -->
        <div id="CarouselBox">
            <!-- 画像 -->
            <img src="../img/carousel/carousel1.jpg" alt="grass" />
            <img src="../img/carousel/carousel2.jpg" alt="hotel" class="Hidden" />
            <img src="../img/carousel/carousel3.jpg" alt="restaurant" class="Hidden" />
            <img src="../img/carousel/carousel4.jpg" alt="wien" class="Hidden" />
            <!-- プログレスバー -->
            <progress value="0" max="100" id="Progress"></progress>
        </div>
        <!-- ボタン -->
        <div id="CarouselBtn" class="CarouselBtnBox">
            <button type="button" class="CarouselBtn BtnActive"></button>
            <button type="button" class="CarouselBtn"></button>
            <button type="button" class="CarouselBtn"></button>
            <button type="button" class="CarouselBtn"></button>
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

            <div class="info">
                <div class="flex w-200" id="seed">
                    <?php if (isset($result) && count($result) > 0): ?>
                        <?php foreach ($result as $row): ?>
                            <div class="info_content">
                                <img class="img" src="<?= h($row['path']) ?>" alt="">
                                <p class="small_info"><?= h($row['heading']) ?></p>
                                <p class="small_content"><?= h($row['content']) ?></p>
                                <p class="date"><?= h($row['date']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>お知らせがありません。</p>
                    <?php endif; ?>
                </div>
            </div>
            <img id="button" class="button" src="../img/find/button.png" alt="">
            <a href="news.html">一覧はこちら></a>
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
                                <a href="grass.html">詳しくはこちら ></a>
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
                                <a href="restaurant.php">詳しくはこちら ></a>
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
                                <a href="https://edelwein.co.jp/edel_info/wein_chateau">詳しくはこちら ></a>
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
                                <a href="hotel.html">詳しくはこちら ></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <!-- script -->
    <script src="js/carousel.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        const button = document.getElementById("button");

        const seed = document.getElementById("seed");

        const info_content = document.getElementsByClassName("info_content")

        console.log(seed)

        // const x_content = document.getElementsByClassName("x_content")
        button.addEventListener("click", event => { //クリックしたら

            // for文でinfo_contentにcssのクラスを付与
            for (let i = 0; i < info_content.length; i++) {
                // seed[i].classList.add(x_content)
                info_content[i].classList.add("x_content");
            }
            button.style = "pointer-events:none";
            // 1秒後にcssを削除
            setTimeout(() => {
                for (let i = 0; i < info_content.length; i++) {
                    // seed[i].classList.add(x_content)
                    info_content[i].classList.remove("x_content");
                    // seed.removeChild(info_content[0])
                }
                seed.appendChild(info_content[0]);
                button.style = "";
            }, 1000)

        })

    </script>
</body>

</html>