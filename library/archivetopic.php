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

    $sql = "UPDATE topics SET archived = '1' WHERE topicid = $topicid";
    $stm = $pdo->query($sql);
    $topic = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $topic;
}

foreach($topics as $topic){
    if(getMessageDate($topic["topicid"])){
        $topic["date"] = getMessageDate($topic["topicid"]);
    }
    if(dateDifference($topic["date"]) > 20 && $topic["archived"] != 1){
        archiveTopic($topic["topicid"]);
        echo $topic["topicid"]." ".$topic["title"]." archived".PHP_EOL;
    }
}