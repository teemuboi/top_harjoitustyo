<?php
require_once "database/connection.php";

function addUser($username, $password){
    $pdo = connectDB();
    $role = "user";

    $data = [$username, $password, $role];
    $sql = "INSERT INTO users (username, password, role) VALUES(?,?,?)";
    $stm = $pdo->prepare($sql);

    return $stm->execute($data);
}

function login($username, $password){
    $pdo = connectDB();

    $sql = "SELECT * FROM users WHERE username=?";
    $stm = $pdo->prepare($sql);

    $stm->execute([$username]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    
    if(isset($user["password"])){
        if($password == $user["password"]){
            return $user;
        }
    }
    return false;
}

function isLoggedIn(){
    if(isset($_SESSION['username'], $_SESSION['userid']) 
    && ($_SESSION['session_id'] == session_id())){
        return true;
    }
    return false;
}