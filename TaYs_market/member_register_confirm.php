<?php
session_start();
session_regenerate_id(ture);
require_once('function/function.php');

$post=escape($_POST);

$cus_name = $post['cus_name'];
$mail = $post['mail'];
$post_num_1 = $post['post_num_1'];
$post_num_2 = $post['post_num_2'];
$address = $post['address'];
$tel = $post['tel'];
$password = $post['password'];
$password_confirm = $post['password_confirm'];
$gender = $post['gender'];

$flag = true;

if($cus_name == ''){
  $flag = false;
}

if(preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$mail) == 0){
  $flag = false;
}

if(preg_match('/\A[0-9]+\z/',$post_num_1) == 0){
  $flag = false;
}

if(preg_match('/\A[0-9]+\z/',$post_num_2) == 0){
  $flag = false;
}

if($address == ''){
  $flag = false;
}

if(preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/',$tel) == 0){
  $flag = false;
}

if($password!=$password_confirm){
    $flag = false;
}

if($flag == true){
  require_once('DB/dbaccess.php');

  $sql = 'INSERT INTO member (password,name,mail,post_num_1,post_num_2,address,tel,gender) VALUES (?,?,?,?,?,?,?,?)';
  $stmt = $dbh->prepare($sql);
  $data = array();
  $data[] = $password_confirm;//password_hash($password,PASSWORD_DEFAULT);
  $data[] = $cus_name;
  $data[] = $mail;
  $data[] = $post_num_1;
  $data[] = $post_num_2;
  $data[] = $address;
  $data[] = $tel;
  if($gender == 'male'){
    $data[] = 1;
  }else{
    $data[] = 2;
  }
  $stmt->execute($data);

  $dbh = null;

  session_start();
  $_SESSION['register_flag'] = 1;
  header('Location:member_login.php');
  exit();

}else{
  session_start();
  $_SESSION['register_flag'] = 2;
  header('Location:member_register.php');
  exit();
}

?>
