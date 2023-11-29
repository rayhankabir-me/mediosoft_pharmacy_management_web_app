<?php
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
include_once('../model/medicineCategoryModel.php');
$get_current_user_info = get_current_user_info();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Medicine Category</title>
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
                <table id="show_category" border="1" width="100%">


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
        //showing category with ajax
        showCategory();
        function showCategory(){

            let action = 'get_category';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/medicineCategoryController.php?action='+action, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('show_category').innerHTML = this.responseText;
                }
            }

        }
        //delete operation using ajax
        function deleteCategory(event){
            event.preventDefault();
            alert('are you sure to delete this category?');
            let category_id = event.target.getAttribute('data-category-id');
            category_id = parseInt(category_id);

            let action = 'delete_category';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/medicineCategoryController.php?action='+action+'&category_id='+category_id, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){

                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('status_messages').innerHTML = this.responseText;
                    showCategory();
                }
            }

        }
    </script>
</body>
</html>