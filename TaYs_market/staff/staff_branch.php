<?php

session_start();
session_regenerate_id(ture);
if(isset($_SESSION['login'])==false){
  echo 'ログインしていません。<br/>';
  echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
  exit();
}

if(isset($_POST['disp']) == ture){
  if(isset($_POST['staffcode']) == false){
    header('Location: staff_error.php');
    exit();
  }
  $staff_code=$_POST['staffcode'];
  header('Location: staff_disp.php?staffcode='.$staff_code);
  exit();
}

if(isset($_POST['add']) == ture){
    header('Location: staff_add.php');
    exit();
  }

if(isset($_POST['edit']) == ture){
  if(isset($_POST['staffcode']) == false){
    header('Location: staff_error.php');
    exit();
  }
  $staff_code=$_POST['staffcode'];
  header('Location: staff_edit.php?staffcode='.$staff_code);
  exit();
}

if(isset($_POST['delete']) == ture){
  if(isset($_POST['staffcode']) == false){
    header('Location: staff_error.php');
    exit();
  }
  $staff_code=$_POST['staffcode'];
  header('Location: staff_delete_confirm.php?staffcode='.$staff_code);
  exit();
}
?>
