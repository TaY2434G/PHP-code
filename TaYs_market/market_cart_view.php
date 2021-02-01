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
  <link rel="stylesheet" href="css/custom_3.css">
  <script src="https://kit.fontawesome.com/58251798dc.js" crossorigin="anonymous"></script>
  <title>カート | TaY's Market</title>
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
      Cart
    </li>
  </ol>
</nav>
<!--/パンくずリスト-->
<main>
  <?php
    if($_SESSION['unit_error'] == 1){
    echo '<div class="text-center">';
    echo '<div class="alert alert-warning" role="alert">';
    echo '無効な数量です';
    echo '</div>';
    echo '</div>';
    $_SESSION['unit_error'] = 0;
    }
    if($_SESSION['unit_error'] == 2){
      echo '<div class="text-center">';
      echo '<div class="alert alert-warning" role="alert">';
      echo '転売防止の為、お一人様につき5個までとさせていただいております';
      echo '</div>';
      echo '</div>';
      $_SESSION['unit_error'] = 0;
    }
  ?>
  <div class="py-4">
    <div class="container">
      <div class="row p-3">
        <div class="col-md-8 md-4">
          <h4>カート</h4>
          <br/>
          <table class="table table-striped">
            <tbody>
          <?php

          try{

          if(isset($_SESSION['cart']) == true){

            $cart = $_SESSION['cart'];
            $unit = $_SESSION['unit'];
            $max = count($cart);

          }else{
          $max = 0;
          }
            if($max == 0){
              echo 'カートに商品が入っていません。<br/>';
              echo '<br/>';
              echo '<a href="index.php" class="btn btn-secondary">戻る</a>';
              exit();
            }

            require('DB/dbaccess.php');

          foreach ($cart as $key => $value) {
            $sql = 'SELECT code,name,price,picture FROM item WHERE code = ?';
            $stmt = $dbh->prepare($sql);
            $data[0] = $value;
            $stmt->execute($data);

            $record = $stmt->fetch(PDO::FETCH_ASSOC);

            $item_name[] = $record['name'];
            $item_price[] = $record['price'];
            if($record['picture'] == ''){
              $item_picture[]='';
            }else{
              $item_picture[] = '<img src="item/picture/'.$record['picture'].'">';
            }
           }

          $dbh = null;

          }catch(Exception $e){
            require_once('ERROR/error.log.php');
          }
          ?>

          <form method="post" action="cart_unit_edit.php">
            <tr>
              <td>商品</td>
              <td>商品画像</td>
              <td>価格</td>
              <td>数量</td>
              <td>小計</td>
              <td>削除</td>
            </tr>
          <?php for($i = 0;$i < $max;$i ++){ ?>
            <tr>
              <td><?php echo $item_name[$i]; ?></td>
              <td><?php echo $item_picture[$i]; ?></td>
              <td><?php echo $item_price[$i]; ?>円</td>
              <td><input type="text" class="unit" name="unit<?php echo $i;?>" value="<?php echo $unit[$i];?>"></td>
              <td><?php echo $item_price[$i] * $unit[$i]; ?>円</td>
              <td><input type="checkbox" name="delete<?php echo $i;?>"></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

  <input type="hidden" name="max" value="<?php echo $max; ?>">
  <input type="submit" value="数量変更" class="btn btn-secondary"><br/>
  </form>
  <br/>

  <?php
    if(isset($_SESSION["member_login"]) == true){
      echo '<a href="market_order_confirm.php" class="btn btn-info">ご購入手続きへ進む</a><br/>';
    }else{
      echo '<a href="market_order_form.php" class="btn btn-info">ご購入手続きへ進む</a><br/>';
    }
  ?>
  <br/>
</div>
</div>
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
