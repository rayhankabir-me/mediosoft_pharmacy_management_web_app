<?php
require_once('db.php');

//add ticket
function add_ticket($data){
    $conneciton = get_connection();
    $sql = "INSERT INTO support_tickets (medicine_id, ticket_subject, ticket_message, requested_by)
    VALUES ({$data['medicine_id']}, '{$data['ticket_subject']}', '{$data['ticket_message']}', {$data['requested_by']})";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
}

//get tickets data based on current user and medicine author
function get_all_tickets_data_for_pharmacists($user_id) {
    $connection = get_connection();

    $sql = "SELECT s.id AS ticket_id, m.medicine_title, s.ticket_subject, u.full_name AS requested_by_name FROM support_tickets s JOIN medicines m ON s.medicine_id = m.id JOIN users u ON s.requested_by = u.id WHERE m.added_by = {$user_id}";

    $result = mysqli_query($connection, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $ticket = [
            'ticket_id' => $row['ticket_id'],
            'medicine_title' => $row['medicine_title'],
            'ticket_subject' => $row['ticket_subject'],
            'requested_by_name' => $row['requested_by_name']
        ];
        array_push($data, $ticket);
    }

    return $data;
}

//get tickets data based on current user and medicine author
function get_all_tickets_data_for_customers($user_id) {
    $connection = get_connection();

    $sql = "SELECT s.id AS ticket_id, m.medicine_title, s.ticket_subject, u.full_name AS requested_by_name FROM support_tickets s JOIN medicines m ON s.medicine_id = m.id JOIN users u ON s.requested_by = u.id WHERE s.requested_by = {$user_id}";

    $result = mysqli_query($connection, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $ticket = [
            'ticket_id' => $row['ticket_id'],
            'medicine_title' => $row['medicine_title'],
            'ticket_subject' => $row['ticket_subject'],
            'requested_by_name' => $row['requested_by_name']
        ];
        array_push($data, $ticket);
    }

    return $data;
}

//get ticket data by tikcet id
function get_ticket_data($ticket_id){
    $connection = get_connection();
    $sql = "SELECT s.id AS ticket_id, m.medicine_title, s.ticket_subject, s.ticket_message, u.full_name AS requested_by_name FROM support_tickets s JOIN medicines m ON s.medicine_id = m.id JOIN users u ON s.requested_by = u.id WHERE s.id = {$ticket_id}";
    $result = mysqli_query($connection, $sql);
    $ticket = mysqli_fetch_assoc($result);
    return $ticket;
}

//get replies fot ticket
function get_replies_by_ticket_id($ticket_id){
    $connection = get_connection();
    $sql = "SELECT r.reply_id, r.reply_message, r.sender_id, r.created_at, u.profile_photo, u.full_name AS sender_name FROM replies_ticket r JOIN users u ON r.sender_id = u.id WHERE r.ticket_id = {$ticket_id} ORDER BY r.created_at ASC";

    $result = mysqli_query($connection, $sql);
    $replies = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $reply = [
            'reply_id' => $row['reply_id'],
            'reply_message' => $row['reply_message'],
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
function create_reply($ticket_id, $sender_id, $reply_message) {
    $connection = get_connection();
    $sql = "INSERT INTO replies_ticket (ticket_id, sender_id, reply_message) VALUES ({$ticket_id}, {$sender_id}, '{$reply_message}')";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        return true;
    }{
        return false;
    }

}




?>
