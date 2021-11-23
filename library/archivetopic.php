<?php
require_once "../database/connection.php";
require_once "../database/models/topics.php";
require_once "../database/models/messages.php";
function dateDifference($date){
    $diff = strtotime($date)-time();
    $days = round($diff/(60*60*24));
    return -$days;
}
$topics = getAllTopics();

function date_sort($a, $b){
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
usort($topics, "date_sort");

foreach($topics as $topic){
    if(getMessageDate($topic["topicid"])){
        $topic["date"] = getMessageDate($topic["topicid"]);
    }
    echo $topic["date"]." ".dateDifference($topic["date"])." ".$topic["title"]."<br>";
}