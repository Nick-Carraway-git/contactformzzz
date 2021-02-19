<?php
$dsn = 'mysql:dbname=sampledb;host=db;charset=utf8';
$user = 'contactman';
$password = 'password';
$create_table = "CREATE TABLE IF NOT EXISTS contactlogs (
    id INT(5) NOT NULL auto_increment PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    tel BIGINT NOT NULL,
    content TEXT NOT NULL
) DEFAULT CHARSET=utf8";

try {
  $db = new PDO($dsn, $user, $password);
  $db->query($create_table);
} catch (PDOException $e) {
  print('エラー内容:' .$e->getMessage());
}
?>
