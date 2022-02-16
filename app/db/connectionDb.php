<?php
$host = 'localhost';
$db = 'blogdb_sz';
$user = 'root';
$psw = '';
$port = '3308';
$charset = 'UTF8';
//dsn = data source name
$dsn = "mysql:host=$host;dbname=$db;port=$port;charset=$charset";

//les différentes options pour se connecter en utilisant PDO
$options = [
    \PDO::ATTR_ERRMODE             => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE  => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES    => false,
];

//on va initialiser la connection
try {
    //on va créer une nvlle variable qui va stocker le resultat de cette tentative de connection
    $pdo = new \PDO($dsn, $user, $psw, $options);
    echo 'Database connexion established! - ';
    //on va catcher les erreurs grace à la class PDOException, on va stocker ds $e pr récupérer le mess d'erreur    
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), $e->getCode());
}
