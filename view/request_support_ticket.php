<?php
$page_title = "Request Ticket - MedioSoft";
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
$get_current_user_info = get_current_user_info();

include_once('../model/medicinesModel.php');
$medicines = get_all_medicines_data();

$get_current_user_type = get_current_user_type();

?>

<!-- including header -->
<?php include_once('../view/component/frontend_header.php'); ?>

<section class="banner-section">
    <div class="container">
        <div class="banner-title">
            <h2>Request Support Ticket</h2>
        </div>
    </div>
</section>
<section class="main-section">
    <div class="container">
        <div class="form-container">

            <?php
                if($get_current_user_type == "Admin" || $get_current_user_type == "Pharmacist"){
                    echo "<p id='error_message'>this feature isn't available for you! </p>";
                }else{

                    ?>

                        <div class="medio-form">
                                        <form action="#" method="post" onsubmit="addTicket()">
                                            <label for="">Select Medicine</label>
                                            <select name="ticket" id="select_medicine">

                                                    <?php
                                                        foreach($medicines as $medicine){
                                                            
                                                            ?>
                                                                <option value="<?php echo $medicine['id']; ?>"><?php echo $medicine['medicine_title']; ?></option>
                                                            <?php
                                                        }
                                                    ?>

                                                    
                                            </select>
                                            <label for="">Ticket Subject</label>

                                            <input type="text" name="ticket_subject" id="ticket_subject">

                                            <label for="">Support Message</label>

                                            <textarea name="support_message" id="support_message" cols="30" rows="10"></textarea>

                                            <input type="submit" value="Make Ticket">
                                            
                                            <div id="status_messages"></div>
                                        </form>
                                    </div>

                    <?php
                }
            ?>


            <div id="status_messages"></div>
        </div>
    </div>
</section>



    <!-- javascript validation -->
    <script>
        function addTicket(){
            event.preventDefault();
            let select_medicine = document.getElementById('select_medicine').value;
            let ticket_subject = document.getElementById('ticket_subject').value;
            let support_message = document.getElementById('support_message').value;

            if(ticket_subject === ""){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must fill ticket subject!</p>';
            }else if(support_message === ""){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must fill support message!</p>';
            }else{

                let action = 'add_ticket';
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../controller/support_ticket_process.php', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('action=' + action + '&select_medicine='+select_medicine + '&ticket_subject='+ticket_subject + '&support_message='+support_message);
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