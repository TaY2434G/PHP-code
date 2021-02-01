<?php
session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()])==ture){
  setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>TaY's Market</title>
  </head>
  <body>
ログアウトしました。<br/><br/>
<a href="../staff_login/staff_login.html">ログイン画面へ</a>
  </body>
</html>
