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
<?php

require_once('../function/function.php');

$post = escape($_POST);
$staff_name = $post['name'];
$staff_password = $post['password'];
$staff_password_confirm = $post['password_confirm'];

if($staff_name == "")
{
  echo "スタッフ名が記入されていません。<br/>";
}else{
  echo "スタッフ名:".$staff_name;
  echo "<br/>";
}

if($staff_password == "")
{
  echo "パスワードが入力されていません。<br/>";
}
if($staff_password != $staff_password_confirm)
{
  echo "パスワードが一致しません。<br/>";
}

if($staff_name == "" || $staff_password == "" || $staff_password != $staff_password_confirm)
{
  echo '<form>';
  echo '<input type="button" onclick="history.back()" value="戻る">';
  echo '</form>';
}else{

  $staff_password = password_hash($staff_password,PASSWORD_DEFAULT);
  echo '<form method= "post" action= "staff_add_complete.php">';
  echo '<input type = "hidden" name="name" value="'.$staff_name.'">';
  echo '<input type = "hidden" name="password" value="'.$staff_password.'">';
  echo '<br/>';
  echo '<input type="button" onclick="history.back()" value="戻る">';
  echo '<input type="submit" value="送信">';
  echo '</form>';

}
?>
 </body>
</html>
