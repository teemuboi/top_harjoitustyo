<?php
require_once "database/models/users.php";

function register_controller(){
    if(isset($_POST['username'], $_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            if(!addUser($username, $password)){
                require_once "views/register.view.php";
            }else{
                header("Location: /login");
            }
        } catch (PDOException $e) {
            echo "Error saving to database: ".$e->getMessage();
        }
    }else{
        if(isLoggedIn()){
            header("Location: /");
        }else{
            require_once "views/register.view.php";
        }
    }
}

function login_controller(){
    if(isset($_POST['username'], $_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = login($username, $password);
        if($result){
            $_SESSION['username'] = $result['username'];
            $_SESSION['userid'] = $result['userid'];
            $_SESSION['role'] = $result['role'];
            $_SESSION['session_id'] = session_id();
            header("Location: /");
        }
    }
    if(isLoggedIn()){
        header("Location: /");
    }else{
        require_once "views/login.view.php";
    }
}

function logout_controller(){
    session_unset();
    session_destroy();

    session_regenerate_id(true);
    
    header("Location: /login");
    die();
}