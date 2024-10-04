<?php 
$a = "Example.png";
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>レストラン ベルンドルフ</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css"
    />
    <link rel="stylesheet" href="../css/restaurant.css" />
    <!-- font: Kiwi Maru -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&display=swap"
      rel="stylesheet"
    />
  </head>

  <body class="PositionRelative">
    <!-- お問い合わせリンク -->
    <a href="" class="ContactLink">お問い合わせ・予約</a>

    <div class="Container">
      <!-- サイドバー -->
      <div class="Side">
        <ul>
          <li>ガラス</li>
          <li>レストラン</li>
        </ul>
      </div>

      <!-- メイン -->
      <div class="Article">
        <div class="MainWidth">
          <!-- タイトル部分 -->
          <section class="flexRow">
            <!-- 左側 -->
            <div class="TitleLeft">
              <h1 class="TitleMainText KiwiMaru">たべる</h1>
              <h2 class="TitleSubText">レストラン ベルンドルフ</h2>
              <img src="../img/restaurant/restaurantMark.png" alt="restaurantMark" class="TitleMark" />
            </div>
            <!-- 右側 -->
            <div class="flexCol">
              <div id="Slideshow">
                <img src="../img/restaurant/restaurant1.jpg" alt="restaurant1" class="TitleImg" />
                <img src="../img/restaurant/restaurant2.jpg" alt="restaurant2" class="TitleImg Hidden" />
                <img src="../img/restaurant/restaurant3.jpg" alt="restaurant3" class="TitleImg Hidden" />
              </div>
              <div id="SlideBtn" class="SlideBtnBox">
                <button type="button" class="SlideBtn BtnActive"></button>
                <button type="button" class="SlideBtn"></button>
                <button type="button" class="SlideBtn"></button>
              </div>
            </div>
          </section>
          <h1 class="Catchcopy KiwiMaru">
            地元産の食材を取り入れた料理と<br />エーテルワインを楽しもう
          </h1>

          <!-- 紹介 -->
          <section class="Detail">
            <h1 class="DetailTitle DetailBorder KiwiMaru">
              レストラン<span>について</span>
            </h1>
            <div class="DetailItems">
              <p class="DetailText">
                レストランベルンドルフでは、
                料理長おすすめの、ジューシーな羊肉、
                サフォークのステーキやハンバーグの他、
                パスタ・ピザ等のお料理と地元エーデルワインを各種取り揃えております。
                <br />
                <br />
                あなただけのゆったりとした時間を過ごしてみませんか？
              </p>
              <div class="DetailImgs">
                <div class="shadow1"></div>
                <img src="../img/restaurant/restaurantDetail1.png" alt="restaurantDetail1" class="img1" />
                <div class="shadow2"></div>
                <img src="../img/restaurant/restaurantDetail2.png" alt="restaurantDetail2" class="img2" />
              </div>
            </div>
          </section>

          <!-- プラン -->
          <section class="Plan">
            <h1 class="PlanTitle KiwiMaru">プラン一覧</h1>
            <div class="PlanTitleLine">
              <div class="UnderLine1"></div>
              <div class="UnderLine2"></div>
            </div>

            <!-- 内容 -->
            <div class="PlanDetail">
              <div class="PlanItem">
                <!-- 写真(左側) -->
                <img src=" <?php $a ?>" alt="restaurantPlan1" />
                <!-- 内容詳細(右側) -->
                <div class="flexCol">
                  <h1>チキンの照り焼きセット</h1>
                  <table>
                    <tr>
                      <th>セット</th>
                      <td>　･･･　</td>
                      <td>サラダ・スープ・ライス・コーヒー付き</td>
                    </tr>
                    <tr>
                      <th>値段</th>
                      <td>　･･･　</td>
                      <td>900円</td>
                    </tr>
                    <tr>
                      <th>時間帯</th>
                      <td>　･･･　</td>
                      <td>11:30~15:00<br />（ラストオーダー14:30）</td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="PlanItem">
                <!-- 写真(左側) -->
                <img src= "<?php  ?>" alt="restaurantPlan2" />
                <!-- 内容詳細(右側) -->
                <div class="flexCol">
                  <h1>特性ナポリタンセット</h1>
                  <table>
                    <tr>
                      <th>セット</th>
                      <td>　･･･　</td>
                      <td>サラダ・スープ・ライス・コーヒー付き</td>
                    </tr>
                    <tr>
                      <th>値段</th>
                      <td>　･･･　</td>
                      <td>900円</td>
                    </tr>
                    <tr>
                      <th>時間帯</th>
                      <td>　･･･　</td>
                      <td>11:30~15:00<br />(ラストオーダー14:30)</td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="PlanItem">
                <!-- 写真(左側) -->
                <img src="<?php   ?>" alt="restaurantPlan3" />
                <!-- 内容詳細(右側) -->
                <div class="flexCol">
                  <h1>豚の生姜焼きセット</h1>
                  <table>
                    <tr>
                      <th>セット</th>
                      <td>　･･･　</td>
                      <td>サラダ・スープ・ライス・コーヒー付き</td>
                    </tr>
                    <tr>
                      <th>値段</th>
                      <td>　･･･　</td>
                      <td>900円</td>
                    </tr>
                    <tr>
                      <th>時間帯</th>
                      <td>　･･･　</td>
                      <td>11:30~15:00<br />（ラストオーダー14:30）</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </section>

          <!-- GoogleMap -->
          <section>
            <h1 class="ItemTitle MapBorder KiwiMaru">周辺案内</h1>
            <iframe
              class="GoogleMap"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3079.812031492457!2d141.2801567102894!3d39.47357497148834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5f858b7c8c19ba79%3A0x8231e8973f597d3a!2z44Os44K544OI44Op44OzIOODmeODq-ODs-ODieODq-ODlQ!5e0!3m2!1sja!2sjp!4v1725331688994!5m2!1sja!2sjp"
              width="600"
              height="450"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
          </section>
        </div>
        <!-- footer -->
        <footer>
          <div class="Data">
            <table class="FooterTable">
              <tr class="FooterItem">
                <td>営業時間</td>
                <td>　:　</td>
                <td>9:00～1700（体験受付最終 16:00）</td>
              </tr>
              <tr class="FooterItem">
                <td>定休日</td>
                <td>　:　</td>
                <td>火曜日（祝祭日の場合は営業致します。）</td>
              </tr>
              <tr class="FooterItem">
                <td>TEL</td>
                <td>　:　</td>
                <td>0198-48-3009</td>
              </tr>
              <tr class="FooterItem">
                <td>FAX</td>
                <td>　:　</td>
                <td>0198-48-2630</td>
              </tr>
              <tr class="FooterItem">
                <td>住所</td>
                <td>　:　</td>
                <td>岩手県花巻市大迫町大迫12-45-1</td>
              </tr>
            </table>
          </div>
          <div class="FooterLinks">
            <p class="FooterLink">TOP</p>
            <p class="FooterLink">森のくに</p>
            <p class="FooterLink">ホテルベルン<br />ドルフ</p>
            <p class="FooterLink">レストランベルン<br />ドルフ</p>
            <p class="FooterLink">ワインシャトー<br />大迫</p>
          </div>
        </footer>
      </div>
    </div>

    <script type="module" src="js/detail_slideshow.js"></script>
  </body>
</html>
