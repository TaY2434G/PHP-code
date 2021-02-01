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
  $staff_code = $_GET['staffcode'];

  require_once('../DB/dbaccess.php');

  $sql = 'SELECT name FROM staff WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[]=$staff_code;
  $stmt->execute($data);

  $record = $stmt->fetch(PDO::FETCH_ASSOC);
  $staff_name=$record['name'];

  $dbh = null;
}catch(Exception $e){
  require_once('../ERROR/error.log.php');
}
?>

スタッフ編集<br/><br/>
スタッフコード<br/>
<?php echo $staff_code; ?>
<br/><br/>
<form method = "post" action = "staff_edit_confirm.php">
<input type = "hidden" name="code" value = "<?php echo $staff_code; ?>">
スタッフ名<br/>
<input type="text" name="name" style="width:200px" value="<?php echo $staff_name ;?>"><br/>
パスワードを入力してください。<br/>
<input type="password" name = "password" style = "width:100px"><br/>
【確認用】もう一度パスワードを入力してください。<br/>
<input type="password" name = "password_confirm" style = "width:100px"><br/>
<br/>
<input type = "button" onclick="history.back()" value="戻る">
<input type = "submit" value = "送信">
</form>
  </body>
</html>
