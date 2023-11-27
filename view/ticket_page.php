<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
require_once('../model/supportTicketsModel.php');

$get_current_user_info = get_current_user_info();


if(isset($_GET['ticket_id'])){
    $ticket_id = $_GET['ticket_id'];

    //get ticket data
    $ticket_data = get_ticket_data($ticket_id);

    //get replies data by ticket id
    // $ticket_replies = get_replies_by_ticket_id($ticket_id);
    // foreach ($ticket_replies as $reply){
    //     echo $reply['sender_name'];
    //     echo $reply['reply_message'];
    //     echo $reply['created_at'];
    // }



   
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View All Tickets</title>
</head>
<body>

    <table border="1" width="100%">
    <tr>
        <td><a href="index.php"><h2>MedioSoft</h2></a></td>
        <td colspan="2">
            Welcome back! <strong><?php echo $get_current_user_info['full_name']; ?></strong>
             | Notifications 
             | <a href="../index.php">Visit Site</a>  
             | <a href="../controller/logout.php">Logout</a>
        </td>
    </tr>

    <tr>

        <td>
        <?php echo get_sidebar();?>
        </td>


        <td colspan="2">

            <br>
                <div class="ticket_details">
                    <h3>Ticket Details</h3>
                    <p>Ticket Subject: <strong><?php echo $ticket_data['ticket_subject']; ?></strong></p>
                    <p>Medicine Title: <strong><?php echo $ticket_data['medicine_title']; ?></strong></p>
                    <p>Ticket Description: <strong><?php echo $ticket_data['ticket_message']; ?></strong></p>
                    <p>Requested By: <strong><?php echo $ticket_data['requested_by_name']; ?></strong></p>
                </div>

                <div class="message_details">
                    <h3>Ticket Message....</h3>

                        <div id="message_box" class="message_box">

                        </div>

                        <form id="reply_form" action="#" method="post" onsubmit="sendReply()">
                            <textarea name="reply_message" id="reply_message" placeholder="Type your reply..." cols="60" rows="4"></textarea>
                            <br>
                            <input type="submit" value="Send Reply">

                            <div id="status_messages"></div>

                            
                    
                        </form>
                        
                </div>


            <br>
            <br>

        </td>
    </tr>
    <tr>
        <td colspan="3">Copyright &copy; 2023 MedioSoft. All rights are reserved.</td>
    </tr>

    </table>

        
        <script>
            function sendReply() {
                event.preventDefault();
                let reply_message = document.getElementById('reply_message').value;
                if(reply_message === ""){
                    document.getElementById('status_messages').innerHTML = '<p id="error_message">you must type something...!</p>';
                }else{

                    let action = 'add_reply';
                    let ticketId = <?php echo $ticket_id; ?>;
                    let senderId = <?php echo $get_current_user_info['id']; ?>;
                    let xhttp = new XMLHttpRequest();
                    xhttp.open('POST', '../controller/ticket_reply_process.php', true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send('action=' + action + '&reply_message='+reply_message + '&ticket_id='+ticketId + '&sender_id='+senderId);
                    xhttp.onreadystatechange = function(){

                        if(this.readyState == 4 && this.status == 200){
                            document.getElementById('status_messages').innerHTML = this.responseText;
                            document.getElementById('reply_message').value = '';
                            showData();
                        }
                    }
                }
            }

            //setInterval(showData, 2000);
            showData();
            //fetching reply data using ajax
            function showData(){
                let ticketId = <?php echo $ticket_id; ?>;
                let action = 'get_data';
                let xhttp = new XMLHttpRequest();
                xhttp.open('GET', '../controller/ticket_reply_process.php?ticket_id='+ticketId+'&action='+action, true);

                xhttp.send();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('message_box').innerHTML = this.responseText;
                    }
                }

            }



        </script>
        <style>
            .message_box {
                max-width: 600px;
                max-height: 600px;
                overflow-y: scroll;
            }

            .message {
                margin: 10px;
                padding: 10px;
                border: 1px solid #ccc;
            }

            .current-user {
                background-color: rgba(255, 87, 5, 0.2);
                text-align: right;
            }

            .other-user {
                background-color: rgba(141, 2, 207, 0.2);
                text-align: left;
            }
        </style>
</body>
</html>