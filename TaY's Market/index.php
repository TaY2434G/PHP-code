<?php
//セッション開始
session_start();
session_regenerate_id();

//ログインした際の表示
if($_SESSION['member_login'] == 1){
  echo '<div class="text-center">';
  echo '<div class="alert alert-success alert-dismissble fade show" role="alert">';
  echo '<strong>ようこそ！</strong>ログインに成功しました';
  echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
  echo '<span aria-hidden="true">&times;</span>';
  echo '</button>';
  echo '</div>';
  echo '</div>';
  $_SESSION['member_login'] = 0;
}

//ログアウトした際の表示
if($_GET['member_logout'] == 1){
  echo '<div class="text-center">';
  echo '<div class="alert alert-success alert-dismissble fade show" role="alert">';
  echo 'ログアウトしました';
  echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
  echo '<span aria-hidden="true">&times;</span>';
  echo '</button>';
  echo '</div>';
  echo '</div>';
  $_GET['member_logout'] = 0;
}

//すでにカートにある商品を追加した際の表示
if($_SESSION['cart_error'] == 1){
  echo '<div class="text-center">';
  echo '<div class="alert alert-warning alert-dismissble fade show" role="alert">';
  echo 'その商品はすでにカートにあります';
  echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
  echo '<span aria-hidden="true">&times;</span>';
  echo '</button>';
  echo '</div>';
  echo '</div>';
  $_SESSION['cart_error'] = 0;
}

//無事にカートに商品を追加したいの表示
if($_SESSION['cart_success'] == 1){
  echo '<div class="text-center">';
  echo '<div class="alert alert-success alert-dismissble fade show" role="alert">';
  echo '商品をカートに追加しました';
  echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
  echo '<span aria-hidden="true">&times;</span>';
  echo '</button>';
  echo '</div>';
  echo '</div>';
  $_SESSION['cart_success'] = 0;
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom_1.css">
  <link rel="stylesheet" href="css/custom_2.css">
  <script src="https://kit.fontawesome.com/58251798dc.js" crossorigin="anonymous"></script>
  <title>TaY's Market</title>
</head>
<body>
  <!--マーケットのロゴ -->
<header class="py-4">
  <div class="container text-center">
    <hi><a href="index.php"><img src="img/market_logo.png" class="img-responsive" alt="TaY's Market"></a></h1>
  </div>
</header>
<!--/マーケットのロゴ -->

<!--ナビゲーションバー -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">TaY's Market</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar-content">

      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Top <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#about">About </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#item">Item </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#information">Information </a>
        </li>
      </ul>

<!--ログインしていたら名前を表示。それ以外はゲスト表示-->
      <ul class="navbar-nav">
        <span class="navbar-text" style="color: #fff;">
          <?php if(isset($_SESSION['member_name'])==false){
          echo 'ゲスト　様　';
         }else{
          echo $_SESSION['member_name'].'　様　';
          } ?>
        </span>

        <!--歯車のアイコンにマウスを乗せた際の動き-->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-cogs fa-1x" style="color: #fff;"></i>
            </a>
            <div class="dropdown-menu mt-0" aria-labelledby="navbarDropdown">
          <?php if(isset($_SESSION['member_login'])==false){
          echo '<a class="dropdown-item" href="member_register.php">新規会員登録</a>';
          echo '<a class="dropdown-item" href="member_login.php">ログイン</a>';
         }else{
          echo '<a class="dropdown-item" href="member_logout.php">ログアウト</a>';
          } ?>
          </div>
        </li>
        <!--/歯車のアイコンにマウスを乗せた際の動き-->

        <!--カートのアイコンにマウスを乗せた際の動き-->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-shopping-cart fa-1x" style="color: #fff;"></i>
            </a>
            <div class="dropdown-menu mt-0" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="market_cart_view.php">カートを見る</a>
          </div>
        </li>
        <!--/カートのアイコンにマウスを乗せた際の動き-->
    </ul>
  </div>
</nav>
<!--/ナビゲーションバー -->

<main>
  <!--メイン-->
  <div class="py-4">
    <div class="container">
      <div id="main_visual" class="carousel slide" data-ride="carousel">
        <!--インジケーター-->
        <ol class="carousel-indicators">
          <li data-target="#main_visual" data-slide-to="0" class="active"></li>
          <li data-target="#main_visual" data-slide-to="1"></li>
          <li data-target="#main_visual" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner">
          <!--スライド1枚目-->
         <div class="carousel-item active">
           <img class="img-fluid" src="img/slide_01.jpg" alt="1枚目">
           <div class="carousel-caption d-none d-md-block">
             <h2>TaY's Marketのこだわり</h2>
             <p>素材にこだわり1つ1つ職人が丁寧に作っております。</p>
           </div>
         </div>
         <!--スライド2枚目-->
         <div class="carousel-item">
           <img class="img-fluid" src="img/slide_02.jpg" alt="2枚目">
           <div class="carousel-caption d-none d-md-block">
             <h2>商品入荷情報</h2>
             <p>新商品は毎週金曜日に入荷します。</p>
           </div>
         </div>
        <!--スライド3枚目-->
         <div class="carousel-item">
           <img class="img-fluid" src="img/slide_03.jpg" alt="3枚目">
           <div class="carousel-caption d-none d-md-block">
             <h2>企業理念</h2>
             <p>全てはお客様のために。</p>
           </div>
         </div>
       </div>

       <!--コントローラー-->
       <a class="carousel-control-prev" href="#main_visual" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">前に戻る</span>
       </a>
       <a class="carousel-control-next" href="#main_visual" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">次に進む</span>
       </a>
     </div>
   </div>
 </div>
  </div>
  <!--コンテンツ1-->
  <div class="py-4">
    <section id="news">
      <div class="container">
        <div class="row">

          <div class="col-md-2">
            <h3>News</h3>
          </div>
          <!--ニュース一覧 -->
          <div class="col-md-10">
            <dl class="row">
              <dt class="col-md-3">2021年1月23日</dt>
              <dd class="col-md-9">新商品「リラックスチェア」が入荷しました</dd>
              <dt class="col-md-3">2021年1月1日</dt>
              <dd class="col-md-9">あけましておめでとうございます</dd>
              <dt class="col-md-3">2020年12月21日</dt>
              <dd class="col-md-9">【重要】メンテナンスのお知らせ</dd>
            </dl>
          </div>
          <!--/ニュース一覧 -->
        </div>
      </div>
    </section>
  </div>
  <!--コンテンツ2-->

  <div class="py-4 bg-light">
    <section id="about">
      <div class="container">
        <!--店舗説明情報 -->
        <div class="row mb-4">
          <div class="col-md-8 mb-3">
            <h3 class="mb-3">TaY's Marketについて</h3>
            <p>TaY's Market（タイズマーケット）は、店主が素材にこだわり、お客様にとって最高の使い心地を追求した製品を販売するオンラインショップです。製品は全て国内工場で作られています。</p>
            <p>毎週新商品が入荷され、幅広いジャンルの製品を取り揃えています。是非、お気に入りの一品をお探しください。</p>
            <a href="#item" class="btn btn-info">商品を見る</a>
          </div>
          <div class="col-mb-4">
            <img src="img/about_01.jpg" class="img-responsive">
          </div>
        </div>
        <!--モーダル-->
        <div class="row">
          <!--モーダル1-->
          <div class="col-md-4">
            <div class="card mb-3">
              <img src="img/about_02.jpeg" class="img-fluid">
              <div class="card-body d-flex justify-content-between">
                <h4 class="card-title">厳選された素材</h4>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal01">
                  詳しく見る
                </button>
              </div>
            </div>
          </div>
          <!--/モーダル1-->

          <!--モーダル2-->
          <div class="col-md-4">
            <div class="card mb-3">
              <img src="img/about_03.jpeg" class="img-fluid">

              <div class="card-body d-flex justify-content-between" data-toggle="modal" data-target="#modal02">
                <h4 class="card-title">幅広いジャンル</h4>
                <button type="button" class="btn btn-secondary">
                  詳しく見る
                </button>
              </div>
            </div>
          </div>
          <!--/モーダル2-->

          <!--モーダル3-->
          <div class="col-md-4">
            <div class="card mb-3">
              <img src="img/about_04.jpeg" class="img-fluid">

              <div class="card-body d-flex justify-content-between" data-toggle="modal" data-target="#modal03">
                <h4 class="card-title">安心の国内生産</h4>
                <button type="button" class="btn btn-secondary">
                  詳しく見る
                </button>
              </div>
            </div>
          </div>
          <!--/モーダル-->
        </div>
        <!--/モーダル-->

        <!--モーダルフェード1-->
      <div class="modal fade" id="modal01" tabindex="-1" role="dialog" aria-labelledby="modal01-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal01-label">厳選された素材</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-center"><img alt="#" src="img/about_02.jpeg" class="img-fuild"></p>
              <p>店主が自ら厳選した素材です。はるばる海外まで足を運んで素材を集めに行くこともあります。</p>
            </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           </div>
         </div>
       </div>
     </div>
     <!--/モーダルフェード1-->

     <!--モーダルフェード2-->
     <div class="modal fade" id="modal02" tabindex="-1" role="dialog" aria-labelledby="modal01-label" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="modal02-label">幅広いジャンル</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <p class="text-center"><img alt="#" src="img/about_03.jpeg" class="img-fuild"></p>
             <p>日用品から大きな家具まで幅広いジャンルの製品を取り揃えております。</p>
           </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!--/モーダルフェード2-->

    <!--モーダルフェード3-->
    <div class="modal fade" id="modal03" tabindex="-1" role="dialog" aria-labelledby="modal01-label" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal03-label">安心の国内生産</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="text-center"><img alt="#" src="img/about_04.jpeg" class="img-fuild"></p>
            <p>製品はすべて国内工場で加工・生産しております。</p>
          </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
       </div>
     </div>
    </div>
    <!--/モーダルフェード3-->

      </div>
      <!--店舗説明情報 -->

    </section>
  </div>

  <!--コンテンツ3-->
  <div class="py-4">
    <section id="item">
      <div class="container">
        <h3 class="mb-3">Item</h3>
        <p>TaY's Marketの商品一覧です。商品の入れ替えが激しいのでお早めにお買い求めください。</p>

        <!-- タブ型ナビゲーション -->
        <div class="nav nav-tabs" id="tab-menus" role="tablist">
          <!-- タブ01 -->
          <a class="nav-item nav-link active" id="tab-menu01" data-toggle="tab" href="#panel-menu01" role="tab" aria-controls="panel-menu01" aria-selected="true">大型家具</a>
          <!-- タブ02 -->
          <a class="nav-item nav-link" id="tab-menu02" data-toggle="tab" href="#panel-menu02" role="tab" aria-controls="panel-menu02" aria-selected="false">食器</a>
          <!-- タブ03 -->
          <a class="nav-item nav-link" id="tab-menu03" data-toggle="tab" href="#panel-menu03" role="tab" aria-controls="panel-menu03" aria-selected="false">小物</a>
          <!-- タブ04 -->
          <a class="nav-item nav-link" id="tab-menu04" data-toggle="tab" href="#panel-menu04" role="tab" aria-controls="panel-menu04" aria-selected="false">日用品</a>
        </div>
        <!-- /タブ型ナビゲーション -->

        <!-- タブパネル -->
        <div class="tab-content" id="panel-menus">
          <!-- パネル01 -->
          <div class="tab-pane fade show active border border-top-0" id="panel-menu01" role="tabpanel" aria-labelledby="tab-menu01">
            <div class="row p-3">
              <div class="col-md-7 order-md-2">
                <h4>Furniture</h4>
                <table class="table table-striped">
                  <tbody>
                    <?php
                    //DBにアクセス
                    try {
                    require('DB/dbaccess.php');

                    $sql = 'SELECT code,name,price,picture FROM item WHERE genre = 1';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    $dbh = null;

                    //ジャンル1の商品の数だけ表示
                    while(ture){
                      $record = $stmt->fetch(PDO::FETCH_ASSOC);
                      if($record == false){
                        break;
                      } ?>
                      <tr>
                        <th><img src="item/picture/<?php echo $record['picture'] ; ?>" class="img-fluid"></th>
                        <!-- 商品を選択すると詳細ページに飛ぶ-->
                        <th><?php echo '<a href="market_item.php?itemcode='.$record['code'].'">'; ?>
                            <br/>
                            <?php echo $record['name']; ?>
                            <?php '</a>'; ?>
                        </th>
                        <th><br/><?php echo $record['price'].' 円'; ?>(税込)</th>
                      </tr>
                    <?php }

                    //DBアクセスのエラー処理
                    }catch (Exception $e) {
                    require_once('ERROR/error.log.php');
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="col-md-5">
                <img src="img/Furniture.png" alt="Furniture" class="img-fluid">
              </div>
            </div>
          </div>
          <!-- パネル02 -->
          <div class="tab-pane fade border border-top-0" id="panel-menu02" role="tabpanel" aria-labelledby="tab-menu02">
            <div class="row p-3">
              <div class="col-md-7 order-md-2">
                <h4>Tableware</h4>
                <table class="table table-striped">
                  <tbody>
                    <?php
                    //DBにアクセス
                    try {
                    require('DB/dbaccess.php');

                    $sql = 'SELECT code,name,price,picture FROM item WHERE genre = 2';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    $dbh = null;
                    //ジャンル2の商品の数だけ表示
                    while(ture){
                      $record = $stmt->fetch(PDO::FETCH_ASSOC);
                      if($record == false){
                        break;
                      } ?>
                      <tr>
                        <th><img src="item/picture/<?php echo $record['picture'] ; ?>" class="img-fluid"></th>
                        <!-- 商品を選択すると詳細ページに飛ぶ-->
                        <th><?php echo '<a href="market_item.php?itemcode='.$record['code'].'">'; ?>
                            <br/>
                            <?php echo $record['name']; ?>
                            <?php '</a>'; ?>
                        </th>
                        <th><br/><?php echo $record['price'].' 円'; ?>(税込)</th>
                      </tr>
                    <?php }

                    //DBアクセスのエラー処理
                    }catch (Exception $e) {
                    require_once('ERROR/error.log.php');
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="col-md-5">
                <img src="img/Tableware.png" alt="Tableware" class="img-fluid">
              </div>
            </div>
          </div>
          <!-- パネル03 -->
          <div class="tab-pane fade border border-top-0" id="panel-menu03" role="tabpanel" aria-labelledby="tab-menu03">
            <div class="row p-3">
              <div class="col-md-7 order-md-2">
                <h4>Accessories</h4>
                <table class="table table-striped">
                  <tbody>
                    <?php
                    //DBにアクセス
                    try {
                    require('DB/dbaccess.php');

                    $sql = 'SELECT code,name,price,picture FROM item WHERE genre = 3';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    $dbh = null;
                    //ジャンル3の商品の数だけ表示
                    while(ture){
                      $record = $stmt->fetch(PDO::FETCH_ASSOC);
                      if($record == false){
                        break;
                      } ?>
                      <tr>
                        <th><img src="item/picture/<?php echo $record['picture'] ; ?>" class="img-fluid"></th>
                        <!-- 商品を選択すると詳細ページに飛ぶ-->
                        <th><?php echo '<a href="market_item.php?itemcode='.$record['code'].'">'; ?>
                            <br/>
                            <?php echo $record['name']; ?>
                            <?php '</a>'; ?>
                        </th>
                        <th><br/><?php echo $record['price'].' 円'; ?>(税込)</th>
                      </tr>
                    <?php }

                    //DBアクセスのエラー処理
                    }catch (Exception $e) {
                    require_once('ERROR/error.log.php');
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="col-md-5">
                <img src="img/Accessories.png" alt="Accessories" class="img-fluid">
              </div>
            </div>
          </div>
          <!-- パネル04 -->
          <div class="tab-pane fade border border-top-0" id="panel-menu04" role="tabpanel" aria-labelledby="tab-menu04">
            <div class="row p-3">
              <div class="col-md-7 order-md-2">
                <h4>Daily necessities</h4>
                <table class="table table-striped">
                  <tbody>
                    <?php
                    //DBにアクセス
                    try {
                    require('DB/dbaccess.php');

                    $sql = 'SELECT code,name,price,picture FROM item WHERE genre = 4';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    $dbh = null;
                    //ジャンル4の商品の数だけ表示
                    while(ture){
                      $record = $stmt->fetch(PDO::FETCH_ASSOC);
                      if($record == false){
                        break;
                      } ?>
                      <tr>
                        <th><img src="item/picture/<?php echo $record['picture'] ; ?>" class="img-fluid"></th>
                        <!-- 商品を選択すると詳細ページに飛ぶ-->
                        <th><?php echo '<a href="market_item.php?itemcode='.$record['code'].'">'; ?>
                            <br/>
                            <?php echo $record['name']; ?>
                            <?php '</a>'; ?>
                        </th>
                        <th><br/><?php echo $record['price'].' 円'; ?>(税込)</th>
                      </tr>
                    <?php }

                    //DBアクセスのエラー処理
                    }catch (Exception $e) {
                    require_once('ERROR/error.log.php');
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="col-md-5">
                <img src="img/Daily_necessities.png" alt="Daily necessities" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
        <!-- /タブパネル -->
      </div>
    </section>
    </div>
    <!-- /コンテンツ03 -->
    <!--コンテンツ4-->
  <div class="py-4 bg-light">
    <section id="information">
      <div class="container">
        <h3 class="mb-3">Information</h3>
        <p>TaY' Market（タイズマーケット）は店主TaY（タイ）によって運営されているオンラインショップです。お問い合わせは下記メールにてお願いします。</p>
        <div class="row">
          <!--セクション-->
          <div class="col-md-12">
            <section id="shop">
              <h4 class="mb-3">Shop</h4>

              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>店名</th>
                    <td>TaY's Market</td>
                  </tr>
                  <tr>
                    <th>工場住所</th>
                    <td>〒〇〇〇-〇〇〇〇  〇〇県〇〇市〇〇町123-1</td>
                  </tr>
                  <tr>
                    <th>電話番号</th>
                    <td>〇〇〇-〇〇〇〇-〇〇〇</td>
                  </tr>
                  <tr>
                    <th>メールアドレス</th>
                    <td>info@taysmarket.co.jp
                  <tr>
                    <th>定休日</th>
                    <td>年末年始、祝日・祭日</td>
                  </tr>
                  <tr>
                    <th>商品発送</th>
                    <td>基本注文日の翌日に発送いたします。</td>
                  </tr>
                  <tr>
                    <th>お支払い方法</th>
                    <td>現在は銀行振り込みのみ対応しております。</td>
                  </tr>
                </tbody>
              </table>
            </section>
          </div>
          <!--/セクション-->
        </div>
      </div>
    </section>
  </div>
</main>
<footer class="py-4 bg-dark text-light">
  <div class="container text-center">
    <!-- ナビゲーション -->
    <ul class="nav justify-content-center mb-3">
      <li class="nav-item">
        <a class="nav-link" href="#">Top</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#about">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#item">Item</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#information">Information</a>
      </li>
    </ul>
    <!-- /ナビゲーション -->
    <p><small>Copyright &copy;2021 TaY's Market, All Rights Reserved.</small></p>
  </div>
</footer>

<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
