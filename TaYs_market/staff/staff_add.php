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

スタッフ追加<br/>
<br/>
<form method="post" action="staff_add_confirm.php">
スタッフ名を入力してください。<br/>
<input type="text" name="name" style="width:200px"><br/>
パスワードを入力してください。<br/>
<input type="password" name="password" style="width:100px"><br/>
【確認用】もう一度パスワードを入力してください。<br/>
<input type="password" name="password_confirm" style="width:100px"><br/>
<br/>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="送信">
  </body>
</html>
