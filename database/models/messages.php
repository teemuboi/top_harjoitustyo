<?php
require_once "database/connection.php";

function addMessage($text, $topicid){
    $pdo = connectDB();
    $userid = $_SESSION['userid'];
    $date = date('d-m-Y H:i:s');

    $data = [$topicid, $userid, $text, $date];
    $sql = "INSERT INTO messages (topicid, userid, text, date) VALUES (?, ?, ?, ?)";
    $stm = $pdo->prepare($sql);

    return $stm->execute($data);
}

function getAllMessages($topicid){
    $pdo = connectDB();

    $sql = "SELECT * FROM messages WHERE topicid = $topicid ORDER BY date DESC";
    $stm = $pdo->query($sql);
    $messages = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $messages;
}

function getMessage($messageid){
    $pdo = connectDB();

    $sql = "SELECT * FROM messages WHERE messageid = $messageid";
    $stm = $pdo->query($sql);
    $message = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $message;
}

function getUser($userid){
    $pdo = connectDB();

    $sql = "SELECT * FROM users WHERE userid = $userid";
    $stm = $pdo->query($sql);
    $user = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $user;
}