<?php
require_once "database/models/topics.php";
require_once "database/models/messages.php";

function topic_controller(){
    if(isset($_POST['title'])){
        //sterilize input
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
        if($topic = getTopic($_GET['topicid'])){
            $messages = getAllMessages($_GET['topicid']);


            if(isset($messages)){
                if(isset($_GET["page"]) && is_numeric($_GET["page"])){
                    $page = $_GET["page"];
                }else{
                    $page = 1;
                }
                $maxpage = 15;
                $messagescount = count($messages);
                $messages = array_slice($messages, $maxpage*($page-1), $maxpage);
            }

            require_once "views/topic.view.php";
        }else{
            echo "404";
        }
    }else{
        header("Location: /");
    }
}

function edittopic_controller(){
    if(isset($_POST['title'])){
        //sterilize input
        $title = $_POST['title'];
        // if(isAdmin() && isset($_POST['archived'])){
        //     $archived = $_POST['archived'];
        // }

        try {
            editTopic($title, $_GET['topicid']);
            // header("Location: /");
        } catch (PDOException $e){
            echo "Error editing table: " . $e->getMessage();
        }
    }else{
        $topic = getTopic($_GET['topicid']);
        if(!isset($topic["userid"])){
            header("Location: /");
        }
        
        if($_SESSION['userid'] == $topic["userid"] || isAdmin()){
            require_once "views/edittopic.view.php";
        }else{
            header("Location: /");
        }
    }
}

function deletetopic_controller(){
    $topic = getTopic($_GET['topicid']);
    if(!isset($topic["userid"])){
        header("Location: /");
    }
    
    if($_SESSION['userid'] == $topic["userid"] || isAdmin()){
        $topicid = $_GET['topicid'];
        try {
            deleteMessages($topicid);
            deleteTopic($topicid);
            header("Location: /");
        } catch (PDOException $e){
            echo "Error deleting table: " . $e->getMessage();
        }
    }else{
        header("Location: /");
    }
}