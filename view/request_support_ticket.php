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
            <form action="#">
                <select name="ticket" id="">

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
                <label for="">Ticket Subject</label> <input type="text" name="ticket_subject">
                <hr>
                <label for="">Support Message</label> <input type="text" name="support_message" id="">
                <hr>
                <input type="submit" value="Make Ticket">

            </form>
            <br>
            <br>

        </td>
    </tr>
    <tr>
        <td colspan="3">Copyright &copy; 2023 MedioSoft. All rights are reserved.</td>
    </tr>

    </table>
</body>
</html>