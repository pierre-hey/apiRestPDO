<?php
    //phpinfo();

    // Se connecter à la base de donnée.
    // on pourrait créer un fichier de config : config.inc
    // J'ai besoin : 
    // login, mdp, url, port, database
    // port : 3306
    define('LOGIN','root');
    define('MDP','');
    define('HOST','localhost');
    define('BASE','db_personne_api_rest');

    try{
        $db="mysql:host=".HOST.";dbname=".BASE.";charset=utf8";
        $pdo = new PDO($db,LOGIN,MDP);
        // ::ATTRMODE => constante de classe
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "PB connection : ".$e->getMEssage();
    }
?>