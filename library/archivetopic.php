<?php
require_once "../database/connection.php";
require_once "../database/models/topics.php";
require_once "../database/models/messages.php";
$topics = getAllTopics();
function dateDifference($date){
    $diff = strtotime($date)-time();
    $days = round($diff/(60*60*24));
    return -$days;
}

function archiveTopic($topicid){
    $pdo = connectDB();

    $sql = "UPDATE topics SET archived = 'true' WHERE topicid = $topicid";
    $stm = $pdo->query($sql);
    $topic = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $topic;
}

foreach($topics as $topic){
    if(getMessageDate($topic["topicid"])){
        $topic["date"] = getMessageDate($topic["topicid"]);
    }
    if(dateDifference($topic["date"]) > 10){
        // archiveTopic($topic["topicid"]);
    }
    echo 
    // $topic["date"]." ".
    dateDifference($topic["date"])." ".
    $topic["title"]."<br>";
}