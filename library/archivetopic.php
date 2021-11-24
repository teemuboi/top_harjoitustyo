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

foreach($topics as $topic){
    if(getMessageDate($topic["topicid"])){
        $topic["date"] = getMessageDate($topic["topicid"]);
    }
    echo $topic["date"]." ".dateDifference($topic["date"])." ".$topic["title"]."<br>";
}