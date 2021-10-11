<?php
require_once "partials/head.php";

switch(explode("?", $_SERVER["REQUEST_URI"])[0]) {
    case "/":
        require_once "views/main.view.php";
    break;

    case "/register":
        require_once "views/register.view.php";
    break;

    case "/login":
        require_once "views/login.view.php";
    break;

    default:
      echo "404";
}
require_once "partials/footer.php";
?>