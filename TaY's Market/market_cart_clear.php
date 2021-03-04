<!--カートの中身を削除する-->
<?php
//セッション開始
session_start();
/*$_SESSION=array();
if(isset($_COOKIE[session_name()])==ture){
  setcookie(session_name(),'',time()-42000,'/');
}*/

//カートの中身を初期化
unset($_SESSION['cart']);
?>
