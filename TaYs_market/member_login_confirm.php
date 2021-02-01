<?php
 try{

   require_once('function/function.php');

   $post = escape($_POST);
   $error_flag = 0;
   $member_mail=$post['mail'];
   $member_password=$post['password'];

   require_once('DB/dbaccess.php');

   $sql = 'SELECT code, name, password FROM member WHERE mail = ?';
   $stmt = $dbh->prepare($sql);
   $data[] = $member_mail;
   $stmt->execute($data);

   $dbh = null;

   $record = $stmt->fetch(PDO::FETCH_ASSOC);

    //パスワード認証処理
    if($member_password == $record['password']){
        session_start();
        $_SESSION['member_login']=1;
        $_SESSION['member_code']=$record['code'];
        $_SESSION['member_name']=$record['name'];
        header('Location:index.php');
        exit();
    /*if(password_verify($member_password, $record['password'])){
        session_start();
        $_SESSION['login']=1;
        $_SESSION['member_code']=$record['code'];
        $_SESSION['member_name']=$record['name'];

        header('Location:market_list.php');
      exit();*/
    }else{
        session_start();
        $_SESSION['error_flag']=1;
        header('Location:member_login.php');
        exit();
    }

 }catch(Exception $e){
   require_once('ERROR/error.log.php');
 }

 ?>
