<?php
$dsn = 'mysql:dbname=heroku_3afc1a8b17ceafa;host=us-cdbr-east-03.cleardb.com;charset=utf8';
$user = 'b803a5c432846d';
$password = '5d34b185';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>
