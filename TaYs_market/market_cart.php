<?php
session_start();
session_regenerate_id(ture);

try{

  $item_code = $_GET['itemcode'];

  if(isset($_SESSION['cart']) == true){
    $cart = $_SESSION['cart'];
    $unit = $_SESSION['unit'];
    if(in_array($item_code,$cart) == true){
      $_SESSION['cart_error'] = 1;
      header('Location:index.php');
      exit();
    }
  }

  $cart[] = $item_code;
  $unit[] = 1;
  $_SESSION['cart']=$cart;
  $_SESSION['unit']=$unit;

  $_SESSION['cart_success'] = 1;
  header('Location:index.php');
  exit();
}catch(Exception $e){
  require_once('ERROR/error.log.php');
}
?>
