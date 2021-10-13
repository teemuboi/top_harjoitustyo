<?php
require_once "database/models/topics.php";

function frontpage_controller(){
    topic_controller();
    $topics = getAllTopics();
    require_once "views/main.view.php";
}