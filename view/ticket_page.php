<?php
$page_title = "Ticket Page - MedioSoft";
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

<!-- including header -->
<?php include_once('../view/component/dashboard_header.php'); ?>

<div class="main-section">
                <div class="container">
                    <div class="row">
                        <div class="column-thirty-three">
                            <div class="dashboard-sidebar">
                                <?php echo get_sidebar();?>
                            </div>
                        </div>
                        <div class="column-sixty-six">
                            <div class="medicines-container">
                                <div class="ticket_details">
                                    <h3>Ticket Details</h3>
                                    <p>Ticket Subject: <strong><?php echo $ticket_data['ticket_subject']; ?></strong></p>
                                    <p>Medicine Title: <strong><?php echo $ticket_data['medicine_title']; ?></strong></p>
                                    <p>Ticket Description: <strong><?php echo $ticket_data['ticket_message']; ?></strong></p>
                                </div>

                                <div class="message_details">
                                        <div id="message_box" class="message_box">

                                        </div>

                                        <form id="reply_form" action="#" method="post" onsubmit="sendReply()">
                                            <textarea name="reply_message" id="reply_message" placeholder="Type your reply..." rows="6"></textarea>
                                            <br>
                                            <input type="submit" value="Send Reply">

                                            <div id="status_messages"></div>

                                            
                                    
                                        </form>
                                        
                                </div>
                                <div id="status_messages"></div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>



        
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

            setInterval(showData, 1000);
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



<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>