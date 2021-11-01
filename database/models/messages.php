<?php
require_once "database/connection.php";

function addMessage($text, $topicid){
    $pdo = connectDB();
    $userid = $_SESSION['userid'];
    $date = date('Y-m-d H:i:s'); //date('d-m-Y H:i:s')

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

    return $message[0];
}

function getMessageDate($topicid){
    $pdo = connectDB();

    $sql = "SELECT date FROM messages WHERE topicid = $topicid ORDER BY date DESC LIMIT 1";
    $stm = $pdo->query($sql);
    $message = $stm->fetchAll(PDO::FETCH_ASSOC);

    if($message){
        return $message[0]["date"];
    }
}

function getUser($userid){
    $pdo = connectDB();

    $sql = "SELECT * FROM users WHERE userid = $userid";
    $stm = $pdo->query($sql);
    $user = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $user[0];
}

function editMessage($text, $messageid){
    $pdo = connectDB();

    $sql = "UPDATE messages SET text = '$text' WHERE messageid = $messageid";
    $stm = $pdo->query($sql);
    $message = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $message;
}

function deleteMessage($messageid){
    $pdo = connectDB();

    $sql = "DELETE FROM messages WHERE messageid = $messageid";
    $stm = $pdo->query($sql);
    $message = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $message;
}

function deleteMessages($topicid){
    $pdo = connectDB();

    $sql = "DELETE FROM messages WHERE topicid = $topicid";
    $stm = $pdo->query($sql);
    $messages = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $messages;
}