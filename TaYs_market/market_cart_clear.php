<?php
session_start();
/*$_SESSION=array();
if(isset($_COOKIE[session_name()])==ture){
  setcookie(session_name(),'',time()-42000,'/');
}*/
unset($_SESSION['cart']);
?>
