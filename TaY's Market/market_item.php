<?php
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
  <title>ログイン | TaY's Market</title>
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
              <a class="dropdown-item" href="./market/market_cart_view.php">カートを見る</a>
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
      Login
    </li>
  </ol>
</nav>
<!--/パンくずリスト-->
<main>
  <?php

  try{
    $item_code = $_GET['itemcode'];

    require_once('DB/dbaccess.php');

    $sql = 'SELECT name,price,picture,comment FROM item WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[]=$item_code;
    $stmt->execute($data);

    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    $item_name=$record['name'];
    $item_price=$record['price'];
    $item_picture_name=$record['picture'];
    $item_comment=$record['comment'];

    $dbh = null;

    if($item_picture_name == ''){
      $disp_picture='';
    }else{
      $disp_picture='<img src="item/picture/'.$item_picture_name.'" class="img-responsive">';
    }
    //echo '<a href="market_cart.php?itemcode='.$item_code.'">カートに入れる</a><br/><br/>';
  }catch(Exception $e){
    require_once('ERROR/error.log.php');
  }
  ?>

  <div class="py-4 bg-light">
    <section id="about">
      <div class="container">
        <br/><br/><br/><br/>
        <div class="row mb-4">
          <div class="col-mb-4">
            <?php echo $disp_picture;?>
          </div>

          <div class="col-md-8 mb-4">
            <h4 class="mb-3"><?php echo $item_name; ?></h4>
            <p>価格：<?php echo $item_price ; ?>円（税込）</p>
            <p>詳細：<?php echo $item_comment ; ?></p>
            <?php echo '<a href="market_cart.php?itemcode='.$item_code.'" class="btn btn-info">カートに入れる</a> ';?>
          </div>
        </div>
        <br/><br/><br/>
      </div>
    </section>
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
