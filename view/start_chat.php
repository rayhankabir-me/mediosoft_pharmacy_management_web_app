<?php
$page_title = "Start Live Chat - MedioSoft";
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
$get_current_user_info = get_current_user_info();


?>

<!-- including header -->
<?php include_once('../view/component/frontend_header.php'); ?>

<section class="banner-section">
    <div class="container">
        <div class="banner-title">
            <h2>Live Chat with Admin</h2>
        </div>
    </div>
</section>
<section class="main-section">
    <div class="container">
        <div class="form-container">

            <div class="medio-form">
                <form action="#" method="post" onsubmit="addChat()">
                    <label for="chat_subject">Chat Subject</label>

                    <input type="text" name="chat_subject" id="chat_subject">

                    <label for="chat_message">Tell something about the chat</label>

                    <textarea name="chat_message" id="chat_message" cols="30" rows="10"></textarea>

                    <input type="submit" value="Start Chat">
                    

                </form>
            </div>
            <div id="status_messages"></div>
        </div>
    </div>
</section>



    <!-- javascript validation -->
    <script>
        function addChat(){
            event.preventDefault();
            let chat_subject = document.getElementById('chat_subject').value;
            let chat_message = document.getElementById('chat_message').value;


            if(chat_subject === ""){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must enter chat subject!</p>';
            }else if(chat_message === ""){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must say something about the chat!</p>';
            }else{

                let action = 'add_chat';
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../controller/chatController.php', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('action=' + action + '&chat_subject='+chat_subject + '&chat_message='+chat_message);
                xhttp.onreadystatechange = function(){

                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('status_messages').innerHTML = this.responseText;
                        document.getElementById('ticket_subject').value = '';
                        document.getElementById('support_message').value = '';
                    }
                }
            }
        }
        



    </script>
    
<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>