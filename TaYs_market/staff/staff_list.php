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

try {
  require_once('../DB/dbaccess.php');

  $sql = 'SELECT code,name FROM staff WHERE 1';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $dbh = null;

  echo 'スタッフ一覧<br/><br/>';

  echo '<form method="post" action="staff_branch.php">';

  while(ture){
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    if($record == false){
      break;
    }
    echo '<input type="radio" name="staffcode" value="'.$record['code'].'">';
    echo $record['name'];
    echo "<br/>";
  }
  echo '<input type = "submit" name="disp" value="参照">';
  echo '<input type = "submit" name="add" value="追加">';
  echo '<input type = "submit" name="edit" value="編集">';
  echo '<input type = "submit" name="delete" value="削除">';
  echo '</form>';
} catch (Exception $e) {
  require_once('../ERROR/error.log.php');
}

   ?>
<br/>
<a href="../staff_login/staff_top.php">トップメニューへ</a><br/>
  </body>
</html>
