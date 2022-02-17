<?php
//Db connection
require 'connectionDb.php';

//désactivé les FK grace a cette requete
$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");

$pdo->exec("DROP TABLE users");
$pdo->exec("DROP TABLE posts");
$pdo->exec("DROP TABLE comments");
$pdo->exec("DROP TABLE categories");

//on réactivera les FK après la suppression des 2 tables
$pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

echo 'Database TABLES deleted successfully!';
