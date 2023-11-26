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
    $ticket_replies = get_replies_by_ticket_id($ticket_id);
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
            <br>
                <div class="ticket_details">
                <h3>Ticket Details</h3>
                <p>Ticket Subject: <strong><?php echo $ticket_data['ticket_subject']; ?></strong></p>
                <p>Medicine Title: <strong><?php echo $ticket_data['medicine_title']; ?></strong></p>
                <p>Requested By: <strong><?php echo $ticket_data['requested_by_name']; ?></strong></p>
                </div>
                <h3>Ticket Replies....</h3>
                    <div id="message-container" class="message-container">
                        <?php foreach ($replies as $reply): ?>
                            <div class="message">
                                <strong><?php echo $reply['sender_name']; ?>:</strong>
                                <p><?php echo $reply['reply_message']; ?></p>
                                <small><?php echo $reply['created_at']; ?></small>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <form id="reply-form">
                        <textarea id="reply-message" placeholder="Type your reply"></textarea>
                        <br>
                        <button type="button" onclick="sendReply()">Send Reply</button>
                    </form>

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
                var replyMessage = document.getElementById('reply-message').value;

                if (replyMessage.trim() === "") {
                    alert("Please enter a reply message.");
                    return;
                }

                var ticketId = <?php echo $ticket_id; ?>;
                var senderId = <?php echo $get_current_user_info['id']; ?>;

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'process_reply.php', true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Reload the page or update the message container
                        // based on your requirement
                        window.location.reload();
                    }
                };
                xhr.send('ticket_id=' + ticketId + '&sender_id=' + senderId + '&reply_message=' + replyMessage);
            }
        </script>
        <style>
            .message-container {
                max-width: 600px;
                margin: 20px auto;
            }

            .message {
                padding: 10px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
            }
        </style>
</body>
</html>
