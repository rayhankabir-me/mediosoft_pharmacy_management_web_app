<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
require_once('../model/usersModel.php');
if(!check_login_status()){
    header('location: login.php');
}

require_once('../model/medicineCategoryModel.php');


$get_current_user_info = get_current_user_info();

$category_id = '';
if(isset($_GET['id'])){
    $category_id = $_GET['id'];
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Medicine Category</title>
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
                <h3>Update Medicine Category</h3>
                <form action="#" method="post" onsubmit="updateCategory()">


                <label for="">Category Name </label><input type="text" name="category_title" id="category_title" value="">
                <hr>
                <label for="">Short Description </label><textarea name="description" id="description" cols="30" rows="10"></textarea>
                <hr>


                <br>
                <input type="submit" value="Submit" name="submit">
                <input type="submit" value="Reset" name="reset">
                </form>
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

        showData();
        //fetch current data using ajax
        function showData(){
            let category_id = <?php echo $category_id; ?>;
            let action = 'current_data';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/medicineCategoryController.php?action='+action+'&category_id='+category_id, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    let data = JSON.parse(this.responseText);
                    document.getElementById('category_title').value = data.category_title;
                    document.getElementById('description').value = data.description;
                }
            }


        }


        //update category data by ajax
        function updateCategory(){
            event.preventDefault();
            let category_id = <?php echo $category_id; ?>;
            let category_title = document.getElementById('category_title').value;
            let description = document.getElementById('description').value;

            if(category_title == ''){
                document.getElementById('status_messages').innerHTML = "<p id='error_message'>you must fill category title..!</p>";
            }else if(description == ''){
                document.getElementById('status_messages').innerHTML = "<p id='error_message'>you must fill description..!</p>";
            }else{

                let action = 'update_category';

                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../controller/medicineCategoryController.php', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('action=' + action + '&category_title='+category_title + '&description='+description + '&category_id='+category_id);
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('status_messages').innerHTML = this.responseText;
                        showData();
                    }
                }

            }


        }
    </script>
</body>
</html>