<?php
require_once "database/connection.php";

function addTopic($title){
    $pdo = connectDB();
    $userid = $_SESSION['userid'];

    $data = [$userid, $title];
    $sql = "INSERT INTO topics (userid, title) VALUES (?, ?)";
    $stm = $pdo->prepare($sql);

    return $stm->execute($data);
}

function getAllTopics(){
    $pdo = connectDB();

    $sql = "SELECT * FROM `topics`";
    $stm = $pdo->query($sql);
    $topics = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $topics;
}

function getTopic($topicid){
    $pdo = connectDB();

    $sql = "SELECT * FROM `topics` WHERE topicid = $topicid";
    $stm = $pdo->query($sql);
    $topic = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $topic;
}