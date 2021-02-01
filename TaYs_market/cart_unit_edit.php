<?php
session_start();
session_regenerate_id(true);

require_once('function/function.php');

$post = escape($_POST);

$max = $post['max'];

for($i = 0;$i < $max;$i ++){

  if(preg_match("/\A[0-9]+\z/",$post['unit'.$i]) == 0){
    $_SESSION['unit_error'] = 1;
    header('Location:market_cart_view.php');
    exit();
  }

  if($post['unit'.$i] < 1 || 5 < $post['unit'.$i]){
    $_SESSION['unit_error'] = 2;
    header('Location:market_cart_view.php');
    exit();
  }

  $unit[] = $post['unit'.$i];
}

$cart=$_SESSION['cart'];

for($i=$max;0 <= $i;$i--){
  if(isset($_POST['delete'.$i]) == true){
    array_splice($cart,$i,1);
    array_splice($unit,$i,1);
  }
}

$_SESSION['cart'] = $cart;
$_SESSION['unit'] = $unit;

header('Location:market_cart_view.php');
exit();
 ?>
