<?php
//セッション開始
session_start();
session_regenerate_id();
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
  <title>注文完了 | TaY's Market</title>
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
          <a class="nav-link" href="index.php">Top <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="index.php#about">About </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="index.php#item">Item </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="index.php#information">Information </a>
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

<!--パンくずリスト-->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb container">
    <li class="breadcrumb-item">
      <a href="index.php">Top</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
      Order
    </li>
  </ol>
</nav>
<!--/パンくずリスト-->
<main>
<?php

try{
//エスケープ処理
require_once('function/function.php');

$post=escape($_POST);

$cus_name = $post['cus_name'];
$mail = $post['mail'];
$post_num_1 = $post['post_num_1'];
$post_num_2 = $post['post_num_2'];
$address = $post['address'];
$tel = $post['tel'];

?>
<div class="mx-auto" style="width: auto;">
  <div class="container">
    <div class="col-md-8">
  <h2>ご注文が完了しました</h2>
  <p>ご注文情報</p>
    <br/>
    </div>
  </div>
</div>
<?
$cart = $_SESSION['cart'];
$unit = $_SESSION['unit'];
$max = count($cart);

//DBアクセス
require_once('DB/dbaccess.php');

//カートの中の個数分表示
for($i = 0;$i < $max; $i ++){
  $sql = 'SELECT name,price FROM item WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[0] = $cart[$i];
  $stmt->execute($data);

  $record = $stmt->fetch(PDO::FETCH_ASSOC);

  $name = $record['name'];
  $price = $record['price'];
  $prices[] = $price;
  $unit = $unit[$i];
  $sub_total = $price * $unit;

  $text.=$name.'';
  $text.=$price.'円x';
  $text.=$unit.'個 = ';
  $text.=$sub_total."円\n";

}
?>
<div class="mx-auto" style="width: auto;">
  <div class="container">

        <div class="col-md-8">
        <?php
        //購入後確認画面
        echo $cus_name.'様<br/>';
        echo 'ご注文ありがとうございました。<br><br/>';
        //echo $mail.'宛にメールを送りましたのでご確認ください。<br/>';
        echo '商品は以下の住所に発送させて頂きます。<br/><br/>';
        echo '郵便番号：'.$post_num_1.'-'.$post_num_2.'<br/>';
        echo '住所：'.$address.'<br/>';
        echo '電話番号：'.$tel.'<br/><br/><br/>';
        echo 'ご注文内容<br>';
        echo '-----------------------------------<br/>';
        echo '商品名：'.$name.'<br/>';
        echo '価格：'.$price.'円<br/>';
        echo '個数：'.$unit.'個<br/>';
        echo '合計：'.$sub_total.'円<br/>';
        echo '※送料は無料です※<br/>';
        echo '-----------------------------------<br/>';
        echo '代金は以下の口座にお振り込みください。<br/>';
        echo "TaY's銀行 T支店 普通口座 1234567<br/>";
        echo '※入金が確認出来次第、梱包、発送をさせて頂きます。※<br/>';
        echo '-----------------------------------<br/>';
        echo "~TaY's Market~<br/>";
        echo '東京都〇〇〇区〇〇〇町 1-2-3<br/>';
        echo '電話 xxx-xxxx-xxxx<br/>';
        echo 'メール info@taysmarket.co.jp<br/>';
        echo '-----------------------------------<br/>';
        ?>
        <a href="index.php" class="btn btn-info">トップページへ</a>
        <br/>
        <br/>
        <br/>
        </div>
        <br/>

  </div>
</div>

<?php
//未実装機能

/*
$text = '';
$text.=$cus_name."様\n\nこの度はご注文ありがとうございました。\n";
$text.="\n";
$text.="ご注文商品\n";
$text.="-----------------------------------\n";

$cart = $_SESSION['cart'];
$unit = $_SESSION['unit'];
$max = count($cart);


require_once('DB/dbaccess.php');

//カートの中の個数分表示
for($i = 0;$i < $max; $i ++){
  $sql = 'SELECT name,price FROM item WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[0] = $cart[$i];
  $stmt->execute($data);

  $record = $stmt->fetch(PDO::FETCH_ASSOC);

  $name = $record['name'];
  $price = $record['price'];
  $prices[] = $price;
  $unit = $unit[$i];
  $sub_total = $price * $unit;

  $text.=$name.'';
  $text.=$price.'円x';
  $text.=$unit.'個 = ';
  $text.=$sub_total."円\n";

}

//テーブルロック
$sql = 'LOCK TABLES order_history WRITE,order_history_details WRITE,member WRITE';
$stmt = $dbh->prepare($sql);
$stmt->execute();

//会員登録情報をデータベースに保存
$last_member_code = $_SESSION['member_code'];

//注文をデータベースに保存
$sql = 'INSERT INTO order_history (member_code,name,mail,post_num_1,post_num_2,address,tel) VALUES(?,?,?,?,?,?,?)';
$stmt = $dbh->prepare($sql);
$data = array();
$data[] = $last_member_code;
$data[] = $cus_name;
$data[] = $mail;
$data[] = $post_num_1;
$data[] = $post_num_2;
$data[] = $address;
$data[] = $tel;
$stmt->execute($data);
/*
//最後に追加したIDを取得
$sql = 'SELECT LAST_INSERT_ID()';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$record = $stmt->fetch(PDO::FETCH_ASSOC);
$last_code = $record['LAST_INSERT_ID()'];

//注文履歴を最後に追加したIDを元にデータベースに保存
for($i = 0;$i < $max;$i ++){
  $sql = 'INSERT INTO order_history_details (order_code,item_code,price,unit) VALUES(?,?,?,?)';
  $stmt = $dbh->prepare($sql);
  $data = array();
  $data[] = $last_code;
  $data[] = $cart[$i];
  $data[] = $prices[$i];
  $data[] = $unit[$i];
  $stmt->execute($data);
}
*/
//テーブルロック解除
/*
$sql = 'UNLOCK TABLES';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$dbh = null;

$text.="※送料は無料です。※\n";
$text.="-----------------------------------\n";
$text.="\n";
$text.="代金は以下の口座にお振り込みください。\n";
$text.="TaY's銀行 T支店 普通口座 1234567\n";
$text.="※入金が確認出来次第、梱包、発送をさせて頂きます。※\n";
$text.="\n";
$text.="-----------------------------------\n";
$text.=" ~TaY's Market~\n";
$text.="\n";
$text.="東京都〇〇〇区〇〇〇町 1-2-3\n";
$text.="電話 xxx-xxxx-xxxx\n";
$text.="メール info@taysmarket.co.jp\n";
$text.="-----------------------------------\n";

//お客様にメールを送る
$title = 'ご注文ありがとうございます。';
$header = 'From:info@taysmarket.co.jp';
$text = html_entity_decode($text,ENT_QUOTES,'UTF-8');

require ('vendor/autoload.php');

$email = new SendGrid\Mail\Mail();
      $email->setFrom("info@taysmarket.co.jp", "TaY");
      $email->setSubject($title);
      $email->addTo($mail, $cus_name);
      $email->addContent("text/plain", $text);
      $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
      try {
          $response = $sendgrid->send($email);
          print $response->statusCode() . "\n";
          print_r($response->headers());
          print $response->body() . "\n";
      } catch (Exception $e) {
          echo 'Caught exception: '. $e->getMessage() ."\n";
      }
/*
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail($mail,$title,$text,$header);
*/

/*店舗向けのメール
$title = '注文情報';
$header = 'From:.$mail';
$text = html_entity_decode($text,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail('info@taysmarket.co.jp',$title,$text,$header);
*/

//注文完了後にカート内の商品を初期化
require_once('market_cart_clear.php');
}catch(Exception $e){
  //エラー処理
  require_once('ERROR/error.log.php');
}

?>
</main>
<footer class="py-4 bg-dark text-light">
  <div class="container text-center">
    <!-- ナビゲーション -->
    <ul class="nav justify-content-center mb-3">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Top</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php#about">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php#item">Item</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php#information">Information</a>
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
