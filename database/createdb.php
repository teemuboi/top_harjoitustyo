<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName = "chatforum";

$connection = new mysqli($host, $user, $password);
if ($connection->error) {
    die("Connection failed: " . $connection->error);
}

// If database is not exist create one
if (!mysqli_select_db($connection,$dbName)){
    $sql = "CREATE DATABASE ".$dbName;
    if ($connection->query($sql) === TRUE) {
        echo "Database created successfully";
    }else {
        echo "Error creating database: " . $connection->error;
    }
}


$table1 = "CREATE TABLE users (
    userid INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password CHAR(128),
    role VARCHAR(30)
)";

$table2 = "CREATE TABLE topics (
    topicid INT(11) AUTO_INCREMENT PRIMARY KEY,
    userid INT(11) NOT NULL,
    title VARCHAR(30) NOT NULL,
    date DATE NOT NULL
)";

$table3 = "CREATE TABLE messages (
    messageid INT(11) AUTO_INCREMENT PRIMARY KEY,
    topicid INT(11) NOT NULL,
    userid INT(11) NOT NULL,
    text VARCHAR(250) NOT NULL,
    date DATE NOT NULL
)";

$tables = [$table1, $table2, $table3];

foreach($tables as $k => $sql){
    $query = @$connection->query($sql);

    if(!$query)
        echo "Table $k : Creation failed ($connection->error)<br>";
    else
        echo "Table $k : Creation done<br>";
}