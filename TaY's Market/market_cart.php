<!--商品をカートに追加した際の処理-->
<?php
//セッション開始
session_start();
session_regenerate_id();

try{
  //受け取った商品コード
  $item_code = $_GET['itemcode'];

  //カート内に商品が存在するか確認
  if(isset($_SESSION['cart']) == true){
    $cart = $_SESSION['cart'];
    $unit = $_SESSION['unit'];
    //同じ商品が追加されていないか確認
    if(in_array($item_code,$cart) == true){
      $_SESSION['cart_error'] = 1;
      header('Location:index.php');
      exit();
    }
  }

  $cart[] = $item_code;
  $unit[] = 1;

  //セッションで渡す
  $_SESSION['cart']=$cart;
  $_SESSION['unit']=$unit;

  //無事追加された際のフラグ
  $_SESSION['cart_success'] = 1;

  //ホームへ飛ばす
  header('Location:index.php');
  exit();
}catch(Exception $e){
  //エラー処理
  require_once('ERROR/error.log.php');
}
?>
