<?php
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
include_once('../model/medicineCompanyModel.php');
$get_current_user_info = get_current_user_info();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Medicine Company</title>
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
                <table id="show_company" border="1" width="100%">


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
        //showing company with ajax
        showCompany();
        function showCompany(){

            let action = 'get_company';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/medicineCompanyController.php?action='+action, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('show_company').innerHTML = this.responseText;
                }
            }

        }
        //delete operation using ajax
        function deleteCompany(event){
            event.preventDefault();
            alert('are you sure to delete this company name?');
            let company_id = event.target.getAttribute('data-company-id');
            company_id = parseInt(company_id);

            let action = 'delete_compnay';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/medicineCompanyController.php?action='+action+'&company_id='+company_id, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){

                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('status_messages').innerHTML = this.responseText;
                    showCompany();
                }
            }

        }
    </script>
</body>
</html>