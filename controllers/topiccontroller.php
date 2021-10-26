<?php
require_once "database/models/topics.php";
require_once "database/models/messages.php";

function topic_controller(){
    if(isset($_POST['title'])){
        $title = $_POST['title'];

        try {
            if(addTopic($title)){
                header("Location: /");
            }
        } catch (PDOException $e){
            echo "Error saving to database: " . $e->getMessage();
        }
    }
}

function viewtopic_controller(){
    if(isset($_GET['topicid'])){
        $topic = getTopic($_GET['topicid']);
        $messages = getAllMessages($_GET['topicid']);
        require_once "views/topic.view.php";
    }else{
        header("Location: /");
    }
}

function edittopic_controller(){
    if(isset($_POST['title'])){
        $title = $_POST['title'];

        
        try {
            editTopic($title, $_GET['topicid']);
            header("Location: /");
        } catch (PDOException $e){
            echo "Error saving to database: " . $e->getMessage();
        }
    }else{
        $topic = getTopic($_GET['topicid']);
        require_once "views/edittopic.view.php";
    }
}