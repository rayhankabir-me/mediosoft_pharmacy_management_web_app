<?php
require_once('db.php');

//add chat
function add_chat($data){
    $conneciton = get_connection();
    $sql = "INSERT INTO live_chats (chat_subject, chat_message, chat_by)
    VALUES ('{$data['chat_subject']}', '{$data['chat_message']}', {$data['chat_by']})";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
}


//get chat lists for customers
function get_all_chats_data_for_customers($user_id) {
    $connection = get_connection();

    $sql = "SELECT id, chat_subject, chat_message, created_at FROM live_chats WHERE chat_by = {$user_id}";

    $result = mysqli_query($connection, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $ticket = [
            'id' => $row['id'],
            'chat_subject' => $row['chat_subject'],
            'chat_message' => $row['chat_message'],
            'created_at' => $row['created_at']
        ];
        array_push($data, $ticket);
    }

    return $data;
}


//get all chats data for admin
function get_all_chats_data_for_admin() {
    $connection = get_connection();

    $sql = "SELECT c.id, c.chat_subject, c.chat_message, u.full_name, c.chat_by, c.created_at FROM live_chats c JOIN users u ON c.chat_by = u.id";

    $result = mysqli_query($connection, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $ticket = [
            'id' => $row['id'],
            'chat_subject' => $row['chat_subject'],
            'chat_message' => $row['chat_message'],
            'full_name' => $row['full_name'],
            'created_at' => $row['created_at']
        ];
        array_push($data, $ticket);
    }

    return $data;
}



//get chat data by chat id
function get_chat_data($chat_id){
    $connection = get_connection();
    $sql = "SELECT c.id, c.chat_subject, c.chat_message, u.full_name, c.chat_by, c.created_at FROM live_chats c JOIN users u ON c.chat_by = u.id WHERE c.id = {$chat_id}";
    $result = mysqli_query($connection, $sql);
    $ticket = mysqli_fetch_assoc($result);
    return $ticket;
}

//get messages fot chat id
function get_messages_by_chat_id($chat_id){
    $connection = get_connection();
    $sql = "SELECT m.id, m.message, m.sender_id, m.created_at, u.profile_photo, u.full_name AS sender_name FROM messages m JOIN users u ON m.sender_id = u.id WHERE m.chat_id = {$chat_id} ORDER BY m.created_at ASC";

    $result = mysqli_query($connection, $sql);
    $replies = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $reply = [
            'id' => $row['id'],
            'message' => $row['message'],
            'created_at' => $row['created_at'],
            'sender_name' => $row['sender_name'],
            'sender_id' => $row['sender_id'],
            'profile_photo' =>$row['profile_photo']
        ];
        array_push($replies, $reply);
    }

    return $replies;
}

//create reply
function create_message($chat_id, $sender_id, $chat_message) {
    $connection = get_connection();
    $sql = "INSERT INTO messages (chat_id, sender_id, message) VALUES ({$chat_id}, {$sender_id}, '{$chat_message}')";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        return true;
    }{
        return false;
    }

}


?>