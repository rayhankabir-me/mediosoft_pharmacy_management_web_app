<?php

//auth
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/supportTicketsModel.php');
include_once('../model/usersModel.php');

//fetching current user data
$get_current_user_info = get_current_user_info();



$action = $_REQUEST['action'];

if($action == 'add_ticket'){

    $error_message = '';

    $select_medicine = $_REQUEST['select_medicine'];
    $ticket_subject = $_REQUEST['ticket_subject'];
    $support_message = $_REQUEST['support_message'];





    if($select_medicine == ''){
        $error_message .= '<p id="error_message">you must select medicine!</p>';
    }
    if($ticket_subject == ''){
        $error_message .= '<p id="error_message">you must fill ticket subject!</p>';
    }
    if($support_message == ''){
        $error_message .= '<p id="error_message">you must fill support message!</p>';
    }

    //data array
   $data = [
    'medicine_id' => $select_medicine,
    'ticket_subject' => $ticket_subject,
    'ticket_message' => $support_message,
    'requested_by'   => $get_current_user_info['id'],
    ];

     if($error_message === ''){

         $result = add_ticket($data);
     
         if($result === true){
             echo '<p id="success_message">ticket created successfully!</p>';
         }elseif ($result === false) {
             echo '<p id="error_message">ticket created failed... try again!</p>';
         }
         
    }else{
        echo $error_message;
    }
 
 
 
    
 }

?>