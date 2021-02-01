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
  $staff_code = $_POST['code'];

  require_once('../DB/dbaccess.php');

  $sql = 'DELETE FROM staff WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $staff_code;
  $stmt->execute($data);

  $dbh = null;

}
catch(Exception $e){
  require_once('../ERROR/error.log.php');
}

?>
削除しました。<br/><br/>
<a href="staff_list.php"> 戻る </a>
  </body>
</html>
