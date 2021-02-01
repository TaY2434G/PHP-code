<?php
session_start();
session_regenerate_id(true);
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
  <title>注文 | TaY's Market</title>
</head>
<body>
<header class="py-4">
  <div class="container text-center">
    <hi><a href="index.php"><img src="img/market_logo.png" class="img-responsive" alt="TaY's Market"></a></h1>
  </div>
</header>

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

      <ul class="navbar-nav">
        <span class="navbar-text" style="color: #fff;">
          <?php if(isset($_SESSION['member_name'])==false){
          echo 'ゲスト　様　';
         }else{
          echo $_SESSION['member_name'].'　様　';
          } ?>
        </span>
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
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-shopping-cart fa-1x" style="color: #fff;"></i>
            </a>
            <div class="dropdown-menu mt-0" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="market_cart_view.php">カートを見る</a>
            </div>
        </li>
    </ul>
  </div>
</nav>
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

  $code = $_SESSION['member_code'];

  require_once('DB/dbaccess.php');

  $sql = 'SELECT name,mail,post_num_1,post_num_2,address,tel FROM member WHERE code = ?';
  $stmt = $dbh->prepare($sql);
  $data[] = $code;
  $stmt->execute($data);
  $record = $stmt->fetch(PDO::FETCH_ASSOC);

  $dbh = null;

  $cus_name = $record['name'];
  $mail = $record['mail'];
  $post_num_1 = $record['post_num_1'];
  $post_num_2 = $record['post_num_2'];
  $address = $record['address'];
  $tel = $record['tel'];

   ?>
  <div class="container">
    <h2>お客様情報</h2>
    <p>以下の情報を元に発送いたします。</p>
  </div>
  <div class="py-3">
    <div class="container">
      <form method="post" action="market_order_complete.php">

        <div class="form-group row">
          <label for="name" class="col-md-3 col-form-label">
            お名前
          </label>
          <div class="col-md-3">
          <?php echo $cus_name; ?>
          </div>
        </div>

        <div class="form-group row">
          <label for="mail" class="col-md-3 col-form-label">
            メールアドレス
          </label>
          <div class="col-md-6">
          <?php echo $mail; ?>
          </div>
        </div>

        <div class="form-group row">
          <label for="post_num_1" class="col-md-3 col-form-label">
            郵便番号
          </label>
          <div class="col-md-1">
            <?php echo $post_num_1.$post_num_2; ?>
          </div>
        </div>

        <div class="form-group row">
          <label for="address" class="col-md-3 col-form-label">
            住所
          </label>
          <div class="col-md-9">
            <?php echo $address; ?>
          </div>
        </div>

        <div class="form-group row">
          <label for="tel" class="col-md-3 col-form-label">
            電話番号
          </label>
          <div class="col-md-3">
            <?php echo $tel;?>
          </div>
        </div>
        <?php
        echo '<input type = "hidden" name="cus_name" value="'.$cus_name.'">';
        echo '<input type = "hidden" name="mail" value="'.$mail.'">';
        echo '<input type = "hidden" name="post_num_1" value="'.$post_num_1.'">';
        echo '<input type = "hidden" name="post_num_2" value="'.$post_num_2.'">';
        echo '<input type = "hidden" name="address" value="'.$address.'">';
        echo '<input type = "hidden" name="tel" value="'.$tel.'">';

        echo '<a href="market_cart_view.php" class="btn btn-info">戻る</a>';
        echo "　　";
        echo '<input type = "submit" value="OK" class="btn btn-info">';
        ?>
      </form>
      <br/>
    </div>
  </div>
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
