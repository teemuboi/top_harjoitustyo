<?php
require_once "database/connection.php";
require_once "controllers/usercontroller.php";

require_once "partials/head.php";
switch(explode("?", $_SERVER["REQUEST_URI"])[0]) {
    case "/":
        require_once "views/main.view.php";
    break;

    case "/register":
        register_controller();
    break;

    case "/login":
        login_controller();
    break;

    case "/db":
        require_once "database/createdb.php";
    break;

    default:
      echo "404";
}
require_once "partials/footer.php";
?>