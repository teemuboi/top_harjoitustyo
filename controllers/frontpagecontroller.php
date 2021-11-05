<?php
require_once "database/models/topics.php";

function frontpage_controller(){
    topic_controller();
    $topics = getAllTopics();

    //hopefully fixed, but look for more bugs
    function date_sort($a, $b){
        // if(getMessageDate($b["topicid"])){ //some topics dont always sort right.
        //     if(getMessageDate($a["topicid"])){
        //         return strtotime(getMessageDate($b["topicid"])) - 
        //         strtotime(getMessageDate($a["topicid"]));
        //     }
        //     return strtotime(getMessageDate($b["topicid"])) - strtotime($a["date"]);
        // }
        // return strtotime($b["date"]) - strtotime($a["date"]);

        if(getMessageDate($b["topicid"]) || getMessageDate($a["topicid"])){
            if(getMessageDate($b["topicid"]) && getMessageDate($a["topicid"])){
                return strtotime(getMessageDate($b["topicid"])) - 
                strtotime(getMessageDate($a["topicid"]));
            }
            if(getMessageDate($a["topicid"])){
                return strtotime($b["date"]) - 
                strtotime(getMessageDate($a["topicid"]));
            }
            if(getMessageDate($b["topicid"])){
                return strtotime(getMessageDate($b["topicid"])) - 
                strtotime($a["date"]);
            }
        }

        return strtotime($b["date"]) - strtotime($a["date"]);
    }
    if(isset($topics) && is_array($topics)){
        //sorts topics
        usort($topics, "date_sort");

        //checks if page number is a number or exists
        if(isset($_GET["page"]) && is_numeric($_GET["page"])){
            $page = $_GET["page"];
        }else{
            $page = 1;
        }
        $maxpage = 12; //how many topics per page
        $topiccount = count($topics); //total amount of topics
        $topics = array_slice($topics, $maxpage*($page-1), $maxpage); //breaks the topic array to pages
    }

    require_once "views/main.view.php";
}