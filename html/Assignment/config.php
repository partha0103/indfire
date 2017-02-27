<?php
    define ('DB_USER', "root");
    define ('DB_PASSWORD', '308ab220');
    define ('DB_NAME', 'profile_app');
    define ('DB_HOST', 'localhost');

    try{
        #pdo object for database connectivity
        $dbc = new PDO('mysql:host=' .DB_HOST.';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        return $dbc;
    }
    catch(PDOException $e){
        echo $e->getMessage();
        exit;
    }
?>