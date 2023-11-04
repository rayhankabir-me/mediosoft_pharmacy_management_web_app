<?php

$db_host = 'localhost';
$db_name = 'mediosoft';
$db_username = 'root';
$db_password = '';

function get_connection(){

    global $db_host;
    global $db_name;
    global $db_username;
    global $db_password;

    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

    if(!$conn){
        die("Database Connection Failed!");
    }

    return $conn;
}

?>