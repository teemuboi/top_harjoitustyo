<?php
require_once "../database/connection.php";
require_once "../database/models/topics.php";
require_once "../database/models/messages.php";
function dateDifference($date){
    return date('d', strtotime("now")-strtotime($date))-1;
}

function archive(){
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
        if(dateDifference($topic["date"]) <= 10){
            echo dateDifference($topic["date"])." ".$topic["title"]."<br>";
        }else{
            echo "deleted/archived"."<br>";
        }
    }
}
archive();