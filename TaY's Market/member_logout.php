<?php
//セッション開始
session_start();

//セッションの初期化
$_SESSION=array();
if(isset($_COOKIE[session_name()])==ture){
  setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();

//ログアウトフラグを立ててトップページへ飛ばす
header('Location:index.php?member_logout=1');
exit();
?>
