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

  try{
  require_once('../function/function.php');

  $post = escape($_POST);
  $staff_name = $post['name'];
  $staff_password = $post['password'];

  require_once('../DB/dbaccess.php');

  $sql = 'INSERT INTO staff(name,password) VALUES (?,?)';
  $stmt = $dbh->prepare($sql);
  $data[] = $staff_name;
  $data[] = $staff_password;
  $stmt->execute($data);

  $dbh = null;
  echo $staff_name;
  echo 'さんを追加しました。<br/>';
}
catch(Exception $e){
  require_once('../ERROR/error.log.php');
}

?>

<a href="staff_list.php"> 戻る </a>
  </body>
</html>
