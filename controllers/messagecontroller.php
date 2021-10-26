<?php
require_once "database/models/messages.php";

function messages_controller(){
    if(isset($_POST['text'])){
        $text = $_POST['text'];
        $topicid = $_GET['topicid'];

        try {
            addMessage($text, $topicid);
        } catch (PDOException $e){
            echo "Error saving to database: " . $e->getMessage();
        }
    }
}

function editmessage_controller(){
    if(isset($_POST['text'])){
        $text = $_POST['text'];
        $messageid = $_GET['messageid'];

        try {
            editMessage($text, $messageid);
            header("Location: /topic?topicid=".getMessage($messageid)[0]["topicid"]);
        } catch (PDOException $e){
            echo "Error saving to database: " . $e->getMessage();
        }
    }else{
        $message = getMessage($_GET['messageid']);
        require_once "views/editmessage.view.php";
    }
}