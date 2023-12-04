<?php
$page_title = 'Add Medicine Category';
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
                            <div class="form-container">
                                <div class="form-title">
                                    <h3>Add Medicine Category</h3>
                                </div>

                                <div class="medio-form">
                                <form action="#" method="post" onsubmit="addCategory()">
                                    <label for="category_title">Category Name </label><input type="text" name="category_title" id="category_title">
                                    <label for="description">Short Description </label><textarea name="description" id="description" cols="30" rows="10"></textarea>
                                    <input type="submit" value="Submit" name="submit">
                                    <input type="submit" value="Reset" name="reset">
                                    </form>
                                </div>
                                <div id="status_messages"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



    <script>
        function addCategory(){
            event.preventDefault();

            let category_title = document.getElementById('category_title').value;
            let description = document.getElementById('description').value;
            let added_by = <?php echo $user_id; ?>

            if(category_title == ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must fill category title!</p>';
            }else if(description == ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must fill category description!</p>';
            }else{

                let action = 'add_category';
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../controller/medicineCategoryController.php', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('action=' + action + '&category_title='+category_title + '&description='+description + '&added_by='+added_by);
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('status_messages').innerHTML = this.responseText;
                        document.getElementById('category_title').value = '';
                        document.getElementById('description').value = '';
                    }
                }
            }
        }
    </script>

<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>