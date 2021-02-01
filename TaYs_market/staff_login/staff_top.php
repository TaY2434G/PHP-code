<?php
session_start();
session_regenerate_id(ture);
if(isset($_SESSION['login'])==false){
  echo 'ログインしていません。<br/>';
  echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
  exit();
}else{
  echo 'ログイン中：'.$_SESSION['staff_name'].'さん<br/>';
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>TaY's Market</title>
  </head>
  <body>
管理トップメニュー<br/>
<br/>
<a href="../staff/staff_list.php">スタッフ管理</a><br/>
<br/>
<a href="../item/item_list.php">商品管理</a><br/>
<br/>
<a href="../order/order_check.php">注文状況確認</a><br/>
<br/>
<a href="staff_logout.php">ログアウト</a><br/>
  </body>
</html>
