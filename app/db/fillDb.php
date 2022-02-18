 <?php
    //remplissage de la base de données

    //require de l'autoloader de composer
    require dirname(__DIR__) . '../../vendor/autoload.php';

    $faker = Faker\Factory::create('fr_FR');

    //on récupère notre connection à la base de donnée
    require 'connectionDb.php';

    //on va créer un tableau pr les posts, categories, comments, users
    $posts = [];
    $categories = [];
    $comments = [];
    $users = [];

    //si on veut utiliser ce fichier remplissage de données, il faudra que notre 
    //BD soit vide à chaque fois, donc on va faire une opération de nettoyage des tables
    //avant de générer les nouvelles datas, on va utiliser PDO
    //et on va désactivé les FK, et les réactivé

    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    //nettoyage des 3 tables de jonctions
    $pdo->exec("TRUNCATE TABLE posts_categories");
    $pdo->exec("TRUNCATE TABLE posts_comments");
    $pdo->exec("TRUNCATE TABLE users_posts");
    //nettoyage des autres tables
    $pdo->exec("TRUNCATE TABLE users");
    $pdo->exec("TRUNCATE TABLE posts");
    $pdo->exec("TRUNCATE TABLE categories");
    $pdo->exec("TRUNCATE TABLE comments");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

    echo 'Database tables cleaned successfully !';

    //Create fake users
    //on s'occupe du mot de passe
    $hashPassword = null;
    //on crée une boucle
    //qd $i est égale à 0 et tant que $i est inférieur à 13 on aura $i qui s'incrémentera
    //on crée des users en partant de 0 jusqu'à qu'on ait 13 users, c'est pr ca qu'il faut la BD soit vide
    for ($i = 0; $i < 13; $i++) {
        //on génère un password pr notre user
        $hashPassword = password_hash($faker->password, PASSWORD_BCRYPT);
        //maintenant qu'on a un password pr chaque users de 0 à 13
        //on va utiliser notre requete sur la table users
        $pdo->exec("INSERT INTO users 
                SET lastname='{$faker->lastName}',
                    firstname='{$faker->firstName}',
                    password='{$hashPassword}',
                    email='{$faker->email}',
                    phone='{$faker->phoneNumber}',
                    role='Suscriber'                    
                ");
        //on récupère ds notre tableau users le dernier élémt renseigné (le N°13)
        $users[] = $pdo->lastInsertId();
    }
    echo 'USERS ';

    //Create Admin 
    //il sera unique, pas besoin de boucle vu qu'il y a qu'un admin, l'admin aura l'id 14   
    //on génère un password pr l' admin
    $hashPassword = password_hash('test', PASSWORD_BCRYPT);
    //maintenant qu'on a un password pr chaque users de 0 à 13
    //on va utiliser notre requete sur la table users
    $pdo->exec("INSERT INTO users 
            SET lastname='{zhiri}',
                firstname='{samia}',
                password='{$hashPassword}',
                email='{$faker->email}',
                phone='{$faker->phoneNumber}',
                role='Admin'                    
            ");

    echo 'ADMIN, ';

    //Create posts
    for ($i = 0; $i < 72; $i++) {

        $pdo->exec("INSERT INTO posts 
                SET user_id='14',
                    title='{$faker->sentence(2)}',                                        
                    content='{$faker->paragraphs(rand(3, 15), true)}',
                    image='image{$faker->numberBetween($min = 1,$max = 5)}.jpg',
                    created_at='{$faker->date} {$faker->time}',
                    published='1'               
 
                ");
        //on récupère ds notre tableau users le dernier élémt renseigné (le N°13)
        $posts[] = $pdo->lastInsertId();
    }
    echo 'POSTS, ';

    //Create comments
