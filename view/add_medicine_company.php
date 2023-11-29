<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/usersModel.php');
$get_current_user_info = get_current_user_info();
//get current user id
$user_id = get_current_user_id();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Medicine Company</title>
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
                <h3>Add Medicine Company</h3>
                <form action="#" method="post" onsubmit="addCompany()">


                <label for="">Company Name </label><input type="text" name="company_name" id="company_name">
                <hr>
                <label for="">Short Description </label><textarea name="description" id="description" cols="30" rows="10"></textarea>
                <hr>

                <br>
                <div id="status_messages"></div>
                <input type="submit" value="Submit" name="submit">
                <input type="submit" value="Reset" name="reset">
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
        function addCompany(){
            event.preventDefault();

            let company_name = document.getElementById('company_name').value;
            let description = document.getElementById('description').value;
            let added_by = <?php echo $user_id; ?>

            if(company_name == ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must fill company name!</p>';
            }else if(description == ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must fill company description!</p>';
            }else{

                let action = 'add_company';
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../controller/medicineCompanyController.php', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('action=' + action + '&company_name='+company_name + '&description='+description + '&added_by='+added_by);
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('status_messages').innerHTML = this.responseText;
                        document.getElementById('company_name').value = '';
                        document.getElementById('description').value = '';
                    }
                }
            }
        }
    </script>
</body>
</html>