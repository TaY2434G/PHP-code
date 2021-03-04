<?php
//セッション開始
session_start();
session_regenerate_id();
if($_SESSION['register_flag'] == 1){
  echo '<div class="text-center">';
  echo '<div class="alert alert-success alert-dismissble fade show" role="alert">';
  echo '<strong>会員登録が完了しました</strong>';
  echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
  echo '<span aria-hidden="true">&times;</span>';
  echo '</button>';
  echo '</div>';
  echo '</div>';
  $_SESSION['register_flag'] = 0;
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
  <title>ログイン | TaY's Market</title>
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

        <!--/歯車のアイコンにマウスを乗せた際の動き-->
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
<!--/ナビゲーションバー -->

<!--/パンくずリスト-->
<main>
  <!--ログインに失敗した際の表示-->
  <?php if($_SESSION['error_flag'] == 1){
    echo '<div class="text-center">';
    echo '<div class="alert alert-warning" role="alert">';
    echo 'メールアドレスもしくはパスワードが間違っています。';
    echo '</div>';
    echo '</div>';
    $_SESSION['error_flag'] = 0;
  } ?>
  <div class="container">
    <h2>ログイン</h2>
    <p>会員様のログインは下記フォームから。新規会員登録は<a href="member_register.php">こちら</a>から。</p>
  </div>
  <div class="py-3">
    <div class="container">
      <h3 class="mb-3">ログインフォーム</h3>
      <form method="post" action="member_login_confirm.php">

        <div class="form-group row">
          <label for="mail" class="col-md-3 col-form-label">
            メールアドレス<span class="badge badge-warning">必須</span>
          </label>
          <div class="col-md-9">
            <input type="text" class="form-control" name="mail" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="password" class="col-md-3 col-form-label">
            パスワード<span class="badge badge-warning">必須</span>
          </label>
          <div class="col-md-9">
            <input type="text" class="form-control" name="password" required>
          </div>
        </div>

          <div class="form-group row justify-content-end">
            <div class="col-md-9">
              <button type="submit" class="btn btn-primary">OK</button>
            </div>
          </div>

      </form>
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
