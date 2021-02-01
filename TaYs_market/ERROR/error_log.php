<?php
echo '通信エラーです。もう一度時間をおいてお試しください。';
echo '<br/>';
echo 'エラー内容';
echo '<br/>';
print_r($stmt -> errorInfo());
exit();
 ?>
