<?php
//セッション開始
session_start();
session_regenerate_id();
//エスケープ処理の関数を呼び出す
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

//名前が入力されているか確認
if($cus_name == ''){
  $flag = false;
}

//メールアドレスが適切に入力されているか確認
if(preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$mail) == 0){
  $flag = false;
}

//郵便番号上3桁が適切に入力されているか確認
if(preg_match('/\A[0-9]+\z/',$post_num_1) == 0){
  $flag = false;
}

//郵便番号下4桁が適切に入力されているか確認
if(preg_match('/\A[0-9]+\z/',$post_num_2) == 0){
  $flag = false;
}

//住所が適切に入力されているか確認
if($address == ''){
  $flag = false;
}

//電話番号が適切に入力されているか確認
if(preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/',$tel) == 0){
  $flag = false;
}

//パスワードが一致しているか確認
if($password!=$password_confirm){
    $flag = false;
}

//フラグがtureのままであればDBに会員情報を登録
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

  //セッション開始
  session_start();
  //登録フラグ（正常）
  $_SESSION['register_flag'] = 1;
  header('Location:member_login.php');
  exit();

//フラグが1つでもfalseの場合
}else{
  //セッション開始
  session_start();
  //登録フラグ（異常）
  $_SESSION['register_flag'] = 2;
  //会員登録ページに飛ばす
  header('Location:member_register.php');
  exit();
}

?>
