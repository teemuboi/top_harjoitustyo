<?php
require_once "database/models/topics.php";

function frontpage_controller(){
    topic_controller();
    $topics = getAllTopics();
 
    function date_sort($a, $b){
        if(getMessageDate($b["topicid"])){
            if(getMessageDate($a["topicid"])){
                return strtotime(getMessageDate($b["topicid"])) - 
                strtotime(getMessageDate($a["topicid"]));
            }
            return strtotime(getMessageDate($b["topicid"])) - strtotime($a["date"]);
        }
        return strtotime($b["date"]) - strtotime($a["date"]);
    }
    usort($topics, "date_sort");


    if(isset($_GET["page"]) && is_numeric($_GET["page"])){
        $page = $_GET["page"];
    }else{
        $page = 1;
    }
    $maxpage = 10;
    $topiccount = count($topics);
    $topics = array_slice($topics, $maxpage*($page-1), $maxpage);

    require_once "views/main.view.php";
}