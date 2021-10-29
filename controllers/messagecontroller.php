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
            echo "Error editing table: " . $e->getMessage();
        }
    }else{
        $message = getMessage($_GET['messageid']);
        if(!isset($message[0]["userid"])){
            header("Location: /");
        }

        if($_SESSION['userid'] == $message[0]["userid"] || isAdmin()){
            require_once "views/editmessage.view.php";
        }else{
            // header("Location: /");
            header("Location: /topic?topicid=".$message[0]["topicid"]);
        }
    }
}

function deletemessage_controller(){
    $message = getMessage($_GET['messageid']);
    if(!isset($message[0]["userid"])){
        header("Location: /");
    }
    
    if($_SESSION['userid'] == $message[0]["userid"] || isAdmin()){
        $messageid = $_GET['messageid'];
        deleteMessage($messageid);
        header("Location: /".explode("/", $_SERVER["HTTP_REFERER"])[3]);
    }else{
        // header("Location: /");
        header("Location: /topic?topicid=".$message[0]["topicid"]);
    }
}