<?php

//auth
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/chatModel.php');
include_once('../model/usersModel.php');

//fetching current user data
$get_current_user_info = get_current_user_info();

$action = $_REQUEST['action'];

if($action == 'add_chat'){

    $error_message = '';

    $chat_subject = $_REQUEST['chat_subject'];
    $chat_message = $_REQUEST['chat_message'];


    if($chat_subject == ''){
        $error_message .= '<p id="error_message">please enter chat subject!</p>';
    }else if($chat_message == ''){
        $error_message .= '<p id="error_message">please say something about the chat..</p>';
    }

    //data array
   $data = [
    'chat_subject' => $chat_subject,
    'chat_message' => $chat_message,
    'chat_by'   => $get_current_user_info['id'],
    ];

     if($error_message === ''){
         $result = add_chat($data);
     
         if($result === true){
             echo '<p id="success_message">chat created successfully! go to <a class="medio-btn" href="../view/my_chats.php">Live Page"</a></p>';
         }elseif ($result === false) {
             echo '<p id="error_message">ticket created failed... try again!</p>';
         }
         
    }else{
        echo $error_message;
    }
 
 
 
    
 }

//add message
 if($action == 'add_message'){

    $error_message = '';

    $chat_id = $_REQUEST['chat_id'];
    $sender_id = $_REQUEST['sender_id'];
    $chat_message = $_REQUEST['chat_message'];

    if($chat_message == ''){
        $error_message .= '<p id="error_message">you must type something...!</p>';
    }

    if($error_message === ''){

        $result = create_message($chat_id, $sender_id, $chat_message);
    
        if($result === true){
            echo '<p id="success_message"> message sent successfully...! </p>';
        }elseif ($result === false) {
            echo '<p id="error_message"> message sent failed...! </p>';
        }
        
   }else{
       echo $error_message;
   }

    
 }


 if($action == 'get_messages'){
    $chat_id = $_GET['chat_id'];

    //get current user id
    $user_info = get_current_user_info();
    $current_user_id = $user_info['id'];

    //get messages data by chat id
    $messages = get_messages_by_chat_id($chat_id);
    foreach ($messages as $message) {

        $sender_class = ($message['sender_id'] == $current_user_id) ? 'current-user' : 'other-user';
        
        echo '<div class="message ' . $sender_class . '">';
        echo '<img src="'.$message['profile_photo'].'">';
        echo '<strong>' . $message['sender_name'] . '</strong>';
        echo '<p>' . $message['message'] . '</p>';
        echo '<span>' . $message['created_at'] . '</span>';
        echo '</div>';
    }

 }
?>