<?php
// require_once "database/connection.php";

function addTopic($title){
    $pdo = connectDB();
    $userid = $_SESSION['userid'];
    $date = date('Y-m-d H:i:s'); //date('d-m-Y H:i:s')
    $modifiedby = $_SESSION['userid'];

    $data = [$userid, $title, $date, $modifiedby];
    $sql = "INSERT INTO topics (userid, title, date, modifiedby) VALUES (?, ?, ?, ?)";
    $stm = $pdo->prepare($sql);

    return $stm->execute($data);
}

function getAllTopics(){
    $pdo = connectDB();

    $sql = "SELECT * FROM topics ORDER BY topicid DESC";
    $stm = $pdo->query($sql);
    $topics = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $topics;
}

function getTopic($topicid){
    $pdo = connectDB();

    $sql = "SELECT * FROM topics WHERE topicid = $topicid";
    $stm = $pdo->query($sql);
    $topic = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $topic[0];
}

function getTopicDate($topicid){
    $pdo = connectDB();

    $sql = "SELECT date FROM topics WHERE topicid = $topicid";
    $stm = $pdo->query($sql);
    $topic = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $topic;
}

function editTopic($title, $topicid){
    $pdo = connectDB();
    $modifiedby = $_SESSION['userid'];
    $lastmodified = date('Y-m-d H:i:s');

    $sql = "UPDATE topics SET title = '$title', modifiedby = '$modifiedby', lastmodified = '$lastmodified' WHERE topicid = $topicid";
    $stm = $pdo->query($sql);
    $topic = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $topic;
}

function deleteTopic($topicid){
    $pdo = connectDB();

    $sql = "DELETE FROM topics WHERE topicid = $topicid";
    $stm = $pdo->query($sql);
    $topic = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $topic;
}