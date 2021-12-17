<?php
// require_once "database/connection.php";

function addMessage($text, $topicid){
    $pdo = connectDB();
    $userid = $_SESSION['userid'];
    $date = date('Y-m-d H:i:s'); //date('d-m-Y H:i:s')

    $data = [$topicid, $userid, $text, $date];
    $sql = "INSERT INTO messages (topicid, userid, text, date) VALUES (?, ?, ?, ?)";
    $stm = $pdo->prepare($sql);

    $stm->execute($data);
    return $pdo->lastInsertId();
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

function dateConvert($date){
    $date = explode(" ", $date);
    if($date[0] == date('Y-m-d')){
        return $date[1];
    }else{
        return $date[0];
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

    $sql = "DELETE FROM messages WHERE messageid = :messageid";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(':messageid', $messageid, PDO::PARAM_INT);

    return $stm->execute();
}

function deleteMessages($topicid){
    $pdo = connectDB();

    $sql = "DELETE FROM messages WHERE topicid = $topicid";
    $stm = $pdo->query($sql);
    $messages = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $messages;
}

function voteMessage($messageid, $vote){
    $pdo = connectDB();
    $userid = $_SESSION['userid'];
    $date = date('Y-m-d H:i:s');

    $data = [$messageid, $userid, $vote, $date];
    $sql = "INSERT INTO votes (messageid, userid, vote, date) VALUES (?, ?, ?, ?)";
    $stm = $pdo->prepare($sql);

    return $stm->execute($data);
}

function getVotes($messageid){
    $pdo = connectDB();

    $sql = "SELECT * FROM votes WHERE messageid = $messageid";
    $stm = $pdo->query($sql);
    $votes = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $votes;
}

function editUserVote($messageid, $newvote){
    $userid = $_SESSION['userid'];
    $date = date('Y-m-d H:i:s');

    $pdo = connectDB();

    $sql = "UPDATE votes SET vote = '$newvote', date = '$date' WHERE messageid = $messageid AND userid = $userid";
    $stm = $pdo->query($sql);
    $vote = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $vote;
}

function getUserVote($messageid){
    $userid = $_SESSION['userid'];

    $pdo = connectDB();

    $sql = "SELECT * FROM votes WHERE messageid = $messageid AND userid = $userid";
    $stm = $pdo->query($sql);
    $vote = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $vote;
}

function hasVoted($messageid){
    $pdo = connectDB();

    $sql = "SELECT * FROM votes WHERE messageid = $messageid";
    $stm = $pdo->query($sql);
    $votes = $stm->fetchAll(PDO::FETCH_ASSOC);

    if($votes){
        foreach ($votes as $vote){
            if($_SESSION["userid"] == $vote["userid"]){
                return true;
            }
        }
    }else{
        return false;
    }
}

function votedStyle($messageid, $vote){
    $userid = $_SESSION['userid'];
    if(getUserVote($messageid)){
        $votes = getUserVote($messageid)[0];
    }else{
        return;
    }
    
    if($votes["vote"] >= 1 && $vote == 1){
        return "class='voted'";
    }else if($votes["vote"] <= -1 && $vote == -1){
        return "class='voted'";
    }
}

function countMessageVotes($messageid){
    $votes = getVotes($messageid);
    $count = 0;
    if($votes){
        foreach ($votes as $vote){
            $count += $vote["vote"];
        }
    }
    return $count;
}