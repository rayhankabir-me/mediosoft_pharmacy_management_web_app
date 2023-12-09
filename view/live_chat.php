<?php
$page_title = "Live Chat - MedioSoft";
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
require_once('../model/chatModel.php');

$get_current_user_info = get_current_user_info();


if(isset($_GET['id'])){
    $chat_id = $_GET['id'];

    //get chat data
    $chat_data = get_chat_data($chat_id);

   
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
                                    <h3>Chat Details</h3>
                                    <p>Chat Subject: <strong><?php echo $chat_data['chat_subject']; ?></strong></p>
                                    <p>Created At: <strong><?php echo $chat_data['created_at']; ?></strong></p>
                                    <p>Created By: <strong><?php echo $chat_data['full_name']; ?></strong></p>
                                    <p>Chat Message: <strong><?php echo $chat_data['chat_message']; ?></strong></p>
                                </div>

                                <div class="message_details">
                                        <div id="message_box" class="message_box">

                                        </div>

                                        <form id="reply_form" action="#" method="post" onsubmit="sendMessage();">
                                            <textarea name="chat_message" id="chat_message" placeholder="Type your reply..." rows="6"></textarea>
                                            <br>
                                            <input type="submit" value="Send Reply">

                                            <div id="status_messages"></div>

                                            
                                    
                                        </form>
                                        
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
    </div>



        
        <script>
            function sendMessage(){
                event.preventDefault();
                let chat_message = document.getElementById('chat_message').value;
                if(chat_message == ""){
                    document.getElementById('status_messages').innerHTML = '<p id="error_message">you must type something...!</p>';
                }else{

                    let action = 'add_message';
                    let chat_id = <?php echo $chat_id; ?>;
                    let sender_id = <?php echo $get_current_user_info['id']; ?>;
                    let xhttp = new XMLHttpRequest();
                    xhttp.open('POST', '../controller/chatController.php', true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send('action=' + action + '&chat_message='+chat_message + '&chat_id='+chat_id + '&sender_id='+sender_id);
                    xhttp.onreadystatechange = function(){

                        if(this.readyState == 4 && this.status == 200){
                            document.getElementById('status_messages').innerHTML = this.responseText;
                            document.getElementById('chat_message').value = '';
                            showData();
                        }
                    }
                }
            }

            setInterval(showData, 1000);
            showData();
            //fetching messages data using ajax
            function showData(){
                let chat_id = <?php echo $chat_id; ?>;
                let action = 'get_messages';
                let xhttp = new XMLHttpRequest();
                xhttp.open('GET', '../controller/chatController.php?chat_id='+chat_id+'&action='+action, true);

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