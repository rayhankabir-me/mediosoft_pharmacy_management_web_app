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
             echo '<p id="success_message">chat created successfully! go to <a class="medio-btn" href="../view/live_chat.php">Live Page"</a></p>';
         }elseif ($result === false) {
             echo '<p id="error_message">ticket created failed... try again!</p>';
         }
         
    }else{
        echo $error_message;
    }
 
 
 
    
 }

?>