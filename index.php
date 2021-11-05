<?php
date_default_timezone_set("Europe/Helsinki");
session_start();

require_once "database/connection.php";
require_once "controllers/frontpagecontroller.php";
require_once "controllers/usercontroller.php";
require_once "controllers/topiccontroller.php";
require_once "controllers/messagecontroller.php";

require_once "partials/head.php";

// echo $_SESSION['userid'];
switch(explode("?", $_SERVER["REQUEST_URI"])[0]){
    case "/":
        // topic_controller();
        frontpage_controller();
        // require_once "views/main.view.php";
    break;

    case "/register":
        register_controller();
    break;

    case "/login":
        login_controller();
    break;

    case "/logout":
        logout_controller();
    break;

    case "/addtopic":
        topic_controller();
    break;

    case "/topic":
        messages_controller();
        viewtopic_controller();
    break;

    case "/edittopic":
        edittopic_controller();
    break;

    case "/deletetopic":
        deletetopic_controller();
    break;

    case "/editmessage":
        editmessage_controller();
    break;

    case "/deletemessage":
        deletemessage_controller();
    break;

    default:
      echo "404";
}
require_once "partials/footer.php";
?>