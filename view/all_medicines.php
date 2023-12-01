<?php
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
include_once('../model/medicinesModel.php');
$medicines = get_all_medicines_data();
$get_current_user_info = get_current_user_info();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Medicines</title>
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
                <table id="show_medicine" border="1" width="100%">


                </table>
                <div id="status_messages"></div>

            <br>
            <br>

        </td>
    </tr>
    <tr>
        <td colspan="3">Copyright &copy; 2023 MedioSoft. All rights are reserved.</td>
    </tr>

    </table>
    
    <script>
            showMedicines();
            //fetching medicines data using ajax
            function showMedicines(){

                let action = 'get_data';
                let xhttp = new XMLHttpRequest();
                xhttp.open('GET', '../controller/medicinesController.php?action='+action, true);

                xhttp.send();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('show_medicine').innerHTML = this.responseText;
                    }
                }

            }

        //delete operation using ajax
        function deleteMedicine(event){
            event.preventDefault();
            alert('are you sure to delete this medicine?');
            let medicine_id = event.target.getAttribute('data-medicine-id');
            medicine_id = parseInt(medicine_id);

            let action = 'delete_medicine';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/medicinesController.php?action='+action+'&medicine_id='+medicine_id, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){

                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('status_messages').innerHTML = this.responseText;
                    showMedicines();
                }
            }

        }
    </script>
</body>
</html>