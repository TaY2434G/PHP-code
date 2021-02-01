<?php
 try{

   $staff_code=$_POST['code'];
   $staff_password=$_POST['password'];

   $staff_code = htmlspecialchars($staff_code,ENT_QUOTES,'UTF-8');
   $staff_password = htmlspecialchars($staff_password,ENT_QUOTES,'UTF-8');

   require_once('../DB/dbaccess.php');

   /*$sql = 'SELECT password FROM staff WHERE code = :code;';
   $stmt = $dbh->prepare($sql);
   $stmt->bindParam(':code', $_POST['code']);
   $stmt->execute();
   $record = $stmt->fetch();*/

   $sql = 'SELECT name, password FROM staff WHERE code = ?';
   $stmt = $dbh->prepare($sql);
   $data[] = $staff_code;
   $stmt->execute($data);

   $dbh = null;

   $record = $stmt->fetch(PDO::FETCH_ASSOC);

    //パスワード認証処理
    if(password_verify($staff_password, $record['password'])){
        session_start();
        $_SESSION['login']=1;
        $_SESSION['staff_code']=$staff_code;
        $_SESSION['staff_name']=$record['name'];

        header('Location:staff_top.php');
      exit();
    }else{
        echo 'スタッフコードもしくはパスワードが間違っています。<br/>';
        echo '<a href="staff_login.html">戻る</a>';
    }

   /*$sql = 'SELECT name FROM staff WHERE code=? AND password=?';
   $stmt = $dbh->prepare($sql);
   $data[] = $staff_code;
   $data[] = $staff_password;
   $stmt->execute($data);

   $dbh = null;

   $record = $stmt->fetch(PDO::FETCH_ASSOC);

   if($record==false){
     echo 'スタッフコードもしくはパスワードが間違っています。<br/>';
     echo '<a href="staff_login.html">戻る</a>';
   }else{
     header('Location:staff_top.php');
     exit();
   }*/

 }catch(Exception $e){
   require_once('../ERROR/error.log.php');
 }

 ?>
