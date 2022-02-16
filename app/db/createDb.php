 <?php
    //on va récupérer la connection grace à un require
    //Db connection
    require 'connectionDb.php';

    //on va créer des requêtes
    //Create users table
    $pdo->exec("CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    
) ENGINE=InnoDB DEFAULT CHARSET=UTF8");
