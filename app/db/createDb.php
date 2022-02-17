 <?php
    //on va récupérer la connection grace à un require
    //Db connection
    require 'connectionDb.php';

    //on va créer des requêtes

    //Create users table
    $pdo->exec("CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    password CHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    role ENUM ('Author','Admin', 'Suscriber') NULL DEFAULT 'Suscriber'    
) ENGINE=InnoDB DEFAULT CHARSET=UTF8");

    echo 'Tables : USERS, ';

    //Create posts table
    $pdo->exec("CREATE TABLE posts (
        id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        user_id int DEFAULT NULL,
        title VARCHAR(255) NOT NULL,
        chapo VARCHAR(255) NOT NULL,
        content text NOT NULL,
        image VARCHAR(255) NOT NULL,
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        published TINYINT NOT NULL,
        FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION      
        ) ENGINE=InnoDB DEFAULT CHARSET=UTF8");

    echo 'Tables : POSTS, ';

    //Create comments table
    $pdo->exec("CREATE TABLE comments (
        id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        pseudo VARCHAR(255) NOT NULL,
        title VARCHAR(255) NOT NULL,        
        content text NOT NULL,
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        published TINYINT NOT NULL       
        ) ENGINE=InnoDB DEFAULT CHARSET=UTF8");

    echo 'Tables : COMMENTS, ';

    //Create categories table
    $pdo->exec("CREATE TABLE categories (
        id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,        
        title VARCHAR(255) NOT NULL, 
        image VARCHAR(255) NOT NULL,       
        content text NOT NULL              
        ) ENGINE=InnoDB DEFAULT CHARSET=UTF8");

    echo 'Tables : CATEGORIES, ';


    //Create posts_comments table

    $pdo->exec("CREATE TABLE posts_comments (
            post_id INT UNSIGNED NOT NULL,
            comment_id INT UNSIGNED NOT NULL,
            PRIMARY KEY (post_id, comment_id),
            CONSTRAINT fk_post
                FOREIGN KEY (post_id)
                REFERENCES posts (id)
                ON UPDATE CASCADE
                ON DELETE RESTRICT,
            CONSTRAINT fk_comment
                FOREIGN KEY (comment_id)
                REFERENCES comments (id)
                ON UPDATE CASCADE
                ON DELETE RESTRICT
        ) DEFAULT CHARSET=UTF8");

    echo 'POSTS_COMMENTS,';

    //Create users_posts table

    $pdo->exec("CREATE TABLE users_posts (
            user_id INT UNSIGNED NOT NULL,
            post_id INT UNSIGNED NOT NULL,
            PRIMARY KEY (user_id, post_id),
            CONSTRAINT fk_user
                FOREIGN KEY (user_id)
                REFERENCES users (id)
                ON UPDATE CASCADE
                ON DELETE RESTRICT,
            CONSTRAINT fk_post
                FOREIGN KEY (post_id)
                REFERENCES posts (id)
                ON UPDATE CASCADE
                ON DELETE RESTRICT
        ) DEFAULT CHARSET=UTF8");

    echo 'USERS_POSTS,';

    //Create posts_categories table

    $pdo->exec("CREATE TABLE posts_categories (
            post_id INT UNSIGNED NOT NULL,
            category_id INT UNSIGNED NOT NULL,
            PRIMARY KEY (post_id, category_id),
            CONSTRAINT fk_post
                FOREIGN KEY (post_id)
                REFERENCES posts (id)
                ON UPDATE CASCADE
                ON DELETE RESTRICT,
            CONSTRAINT fk_category
                FOREIGN KEY (category_id)
                REFERENCES categories (id)
                ON UPDATE CASCADE
                ON DELETE RESTRICT
        )  DEFAULT CHARSET=UTF8");

    echo 'POSTS_CATEGORIES were created successfully!';
