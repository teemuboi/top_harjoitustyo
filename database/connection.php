<?php
function connectDB(){
    static $connection;

    if(!isset($connection)){
        $connection = connect();
    }
    return $connection;
}

function connect(){
    $host = "localhost";
    $dbname = "chatforum";
    $user = "root";
    $password = "";
    $connectionString = "mysql:host=$host;dbname=$dbname";

    try {
        $pdo = new PDO($connectionString, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e){
        echo "Virhe tietokantayhteydessä: " . $e->getMessage();
        die();
    }
}