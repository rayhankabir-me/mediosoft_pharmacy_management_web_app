<?php
//auth
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/supportTicketsModel.php');
require_once('../model/usersModel.php');
$action = $_REQUEST['action'];

if($action == 'add_reply'){

    $error_message = '';

    $ticket_id = $_REQUEST['ticket_id'];
    $sender_id = $_REQUEST['sender_id'];
    $reply_message = $_REQUEST['reply_message'];

    if($reply_message == ''){
        $error_message .= '<p id="error_message">you must type something...!</p>';
    }

    if($error_message === ''){

        $result = create_reply($ticket_id, $sender_id, $reply_message);
    
        if($result === true){
            echo '<p id="success_message"> reply sent successfully...! </p>';
        }elseif ($result === false) {
            echo '<p id="error_message"> reply sent failed...! </p>';
        }
        
   }else{
       echo $error_message;
   }

    
 }

 if($action == 'get_data'){
    $ticketID = $_GET['ticket_id'];

    //get current user id
    $user_info = get_current_user_info();
    $current_user_id = $user_info['id'];

    //get replies data by ticket id
    $ticket_replies = get_replies_by_ticket_id($ticketID);
    foreach ($ticket_replies as $reply) {

        $sender_class = ($reply['sender_id'] == $current_user_id) ? 'current-user' : 'other-user';
        
        echo '<div class="message ' . $sender_class . '">';
        echo '<img src="'.$reply['profile_photo'].'">';
        echo '<strong>' . $reply['sender_name'] . '</strong>';
        echo '<p>' . $reply['reply_message'] . '</p>';
        echo '<span>' . $reply['created_at'] . '</span>';
        echo '</div>';
    }

 }


?>
