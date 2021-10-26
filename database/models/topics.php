<?php
require_once "database/connection.php";

function addTopic($title){
    $pdo = connectDB();
    $userid = $_SESSION['userid'];
    $date = date('d-m-Y H:i:s');

    $data = [$userid, $title, $date];
    $sql = "INSERT INTO topics (userid, title, date) VALUES (?, ?, ?)";
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

    return $topic;
}

function editTopic($title, $topicid){
    $pdo = connectDB();

    $sql = "UPDATE topics SET title = '$title' WHERE topicid = $topicid";
    $stm = $pdo->query($sql);
    $topic = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $topic;
}