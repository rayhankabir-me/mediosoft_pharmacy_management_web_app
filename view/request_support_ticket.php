<?php
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
$get_current_user_info = get_current_user_info();

include_once('../model/medicinesModel.php');
$medicines = get_all_medicines_data();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Request Support Ticket</title>
</head>
<body>
    <table border="1" width="100%">
    <tr>
        <td><a href="../index.php"><h2>MedioSoft</h2></a></td>
        <td colspan="2">
            <a href="../index.php">Home</a>
             | <a href="view/medicines.php">Medicines</a> 
             | <a href="view/blog.php">Blog</a> 
             | <a href="view/contact.php">Contact</a>
             | <a href="../view/request_support_ticket.php">Request Ticket</a>  
             | <a href="view/registration.php">Register</a> 
        </td>
    </tr>

    <tr>
        <td></td>
        <td colspan="2">
            <br>
            <br>
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
                <br>
                <hr>
                <label for="">Ticket Subject</label>
                <br>
                <input type="text" name="ticket_subject" id="ticket_subject">
                <hr>
                <label for="">Support Message</label>
                <br>
                <textarea name="support_message" id="support_message" cols="30" rows="10"></textarea>
                <hr>
                <input type="submit" value="Make Ticket">
                
                <div id="status_messages"></div>
            </form>
            <br>
            <br>

        </td>
    </tr>
    <tr>
        <td colspan="3">Copyright &copy; 2023 MedioSoft. All rights are reserved.</td>
    </tr>

    </table>

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
    

</body>
</html>