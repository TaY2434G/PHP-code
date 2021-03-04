<?php
//セッション開始
session_start();
session_regenerate_id();

//エスケープ処理の関数を呼び出す
require_once('function/function.php');

//エスケープ処理
$post = escape($_POST);

//カート内の商品個数
$max = $post['max'];

//商品の個数分回す
for($i = 0;$i < $max;$i ++){

//入力された商品個数が有効か確認
  if(preg_match("/\A[0-9]+\z/",$post['unit'.$i]) == 0){
    $_SESSION['unit_error'] = 1;
    header('Location:market_cart_view.php');
    exit();
  }

//入力された商品個数が1以上5未満か確認
  if($post['unit'.$i] < 1 || 5 < $post['unit'.$i]){
    $_SESSION['unit_error'] = 2;
    header('Location:market_cart_view.php');
    exit();
  }

  $unit[] = $post['unit'.$i];
}

$cart=$_SESSION['cart'];

//商品削除が選択された場合の処理
for($i=$max;0 <= $i;$i--){
  if(isset($_POST['delete'.$i]) == true){
    array_splice($cart,$i,1);
    array_splice($unit,$i,1);
  }
}

$_SESSION['cart'] = $cart;
$_SESSION['unit'] = $unit;

//カート一覧へ飛ばす
header('Location:market_cart_view.php');
exit();
 ?>
