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