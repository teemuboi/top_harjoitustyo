<?php
require_once "database/models/users.php";

function register_controller(){
    if(isset($_POST['username'], $_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            if(!addUser($username, $password)){
                require_once "views/register.view.php";
            } else {
                header("Location: /login");
            }
        } catch (PDOException $e) {
            echo "Error saving to database: " . $e->getMessage();
        }
    } else {
        require_once "views/register.view.php";
    }
}

function login_controller(){
    if(isset($_POST['username'], $_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = login($username, $password);
        if($result){
            // $_SESSION['username'] = $result['kayttajatunnus'];
            // $_SESSION['userid'] = $result['kayttajaID'];
            // $_SESSION['session_id'] = session_id();
            header("Location: /");
        }
    }
    require_once "views/login.view.php";
}