<?php
session_start();
session_regenerate_id(ture);
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
  <title>会員登録 | TaY's Market</title>
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
      Register
    </li>
  </ol>
</nav>
<!--/パンくずリスト-->
<main>
  <?php if($_SESSION['register_flag'] == 2){
    echo '<div class="text-center">';
    echo '<div class="alert alert-warning" role="alert">';
    echo 'ご記入項目に誤りがあります';
    echo '</div>';
    echo '</div>';
    $_SESSION['register_flag'] = 0;
  } ?>
  <div class="container">
    <h2>お客様情報</h2>
    <p>お客様情報を入力してください</p>
  </div>
  <div class="py-3">
    <div class="container">
      <h3 class="mb-3">登録フォーム</h3>
      <form method="post" action="market_order_form_confirm.php">

        <div class="form-group row">
          <label for="name" class="col-md-3 col-form-label">
            お名前<span class="badge badge-warning">必須</span>
          </label>
          <div class="col-md-3">
            <input type="text" class="form-control" name="cus_name" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="mail" class="col-md-3 col-form-label">
            メールアドレス（半角）<span class="badge badge-warning">必須</span>
          </label>
          <div class="col-md-6">
            <input type="text" class="form-control" name="mail" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="post_num_1" class="col-md-3 col-form-label">
            郵便番号(上3桁)<span class="badge badge-warning">必須</span>
          </label>
          <div class="col-md-1">
            <input type="text" class="form-control" name="post_num_1" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="post_num_2" class="col-md-3 col-form-label">
            郵便番号(下4桁)<span class="badge badge-warning">必須</span>
          </label>
          <div class="col-md-2">
            <input type="text" class="form-control" name="post_num_2" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="address" class="col-md-3 col-form-label">
            住所<span class="badge badge-warning">必須</span>
          </label>
          <div class="col-md-9">
            <input type="text" class="form-control" name="address" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="tel" class="col-md-3 col-form-label">
            電話番号（半角数字）<span class="badge badge-warning">必須</span>
          </label>
          <div class="col-md-3">
            <input type="text" class="form-control" name="tel" required>
          </div>
        </div>

        <fieldset class="form-group">
          <div class="row">
            <legend class="col-form-label col-md-3">
              性別<span class="badge badge-warning">必須</span>
            </legend>
            <div class="col-md-9">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="male" checked>
                <label class="form-check-label" for="gender">男性</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="female">
                <label class="form-check-label" for="gender">女性</label>
              </div>
            </div>
          </div>
        </fieldset>

        <fieldset class="form-group">
          <div class="row">
            <legend class="col-form-label col-md-3">
              注文方法<span class="badge badge-warning">必須</span>
            </legend>
            <div class="col-md-9">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="order" value="order_once" checked>
                <label class="form-check-label" for="gender">会員登録せずに注文</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="order" value="order_register">
                <label class="form-check-label" for="gender">会員登録して注文</label>
              </div>
            </div>
          </div>
        </fieldset>

        <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label">
            <strong>会員登録される方は以下もご記入ください</strong>
          </label>
        </div>

        <div class="form-group row">
          <label for="password" class="col-md-3 col-form-label">
            パスワード（半角英数字）<span class="badge badge-warning">必須</span>
          </label>
          <div class="col-md-3">
            <input type="password" class="form-control" name="password">
          </div>
        </div>

        <div class="form-group row">
          <label for="password" class="col-md-3 col-form-label">
            パスワード【確認用】<span class="badge badge-warning">必須</span>
          </label>
          <div class="col-md-3">
            <input type="password" class="form-control" name="password_confirm">
          </div>
        </div>

          <div class="form-group row justify-content-end">
            <div class="col-md-9">
              <button type="submit" class="btn btn-primary">送信</button>
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
