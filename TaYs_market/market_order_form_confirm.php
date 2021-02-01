
<?php

require_once('function/function.php');

$post=escape($_POST);

$cus_name = $post['cus_name'];
$mail = $post['mail'];
$post_num_1 = $post['post_num_1'];
$post_num_2 = $post['post_num_2'];
$address = $post['address'];
$tel = $post['tel'];
$order = $post['order'];
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

if($order == 'order_register'){
  if($password == ''){
    $flag = false;
  }

  if($password!=$password_confirm){
    $flag = false;
  }

}

if($flag == true){

echo '<form method="post" action="market_form_complete.php">';
echo '<input type = "hidden" name="cus_name" value="'.$cus_name.'">';
echo '<input type = "hidden" name="mail" value="'.$mail.'">';
echo '<input type = "hidden" name="post_num_1" value="'.$post_num_1.'">';
echo '<input type = "hidden" name="post_num_2" value="'.$post_num_2.'">';
echo '<input type = "hidden" name="address" value="'.$address.'">';
echo '<input type = "hidden" name="tel" value="'.$tel.'">';
echo '<input type = "hidden" name="order" value="'.$order.'">';
echo '<input type = "hidden" name="password" value="'.$password.'">';
echo '<input type = "hidden" name="gender" value="'.$gender.'">';

echo '<input type = "button" onclick="history.back()" value="戻る">';
echo '<input type = "submit" value="送信"><br/>';
echo '</form>';

}else{
  echo '<form>';
  echo '<input type="button" onclick="history.back()" value="戻る">';
  echo '</form>';
}

 ?>
  </body>
</html>
