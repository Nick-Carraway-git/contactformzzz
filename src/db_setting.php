<?php
$dboutlone = 'mysql:dbname=sampledb;host=mysql;charset=utf8';
$user = 'contactman';
$password = 'password';
try {
  $db = new PDO($dboutline, $user, $password);
} catch (PDOException $e) {
  print('エラー発生:' .$e->getMessage());
}
?>
