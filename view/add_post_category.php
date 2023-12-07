<?php
$page_title = 'Add Post Category';
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
                                    <h3>Add Post Category</h3>
                                </div>

                                <div class="medio-form">
                                    <form action="#" method="post" onsubmit="addCategory()">

                                        <label for="category_name">Category Name </label>
                                        <input type="text" name="category_name" id="category_name">

                                        <label for="short_description">Short Description </label>
                                        <textarea name="short_description" id="short_description" cols="30" rows="10"></textarea>


                                        <input type="submit" value="Submit" name="submit">

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

            let category_name = document.getElementById('category_name').value;
            let short_description = document.getElementById('short_description').value;
            let added_by = <?php echo $user_id; ?>

            if(category_name == ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must fill the Category Name!</p>';
            }else if(short_description == ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must fill the Post Category Description!</p>';
            }else{

                let action = 'add_category';
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../controller/postCategoryController.php', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('action=' + action + '&category_name='+category_name + '&short_description='+short_description + '&added_by='+added_by);
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('status_messages').innerHTML = this.responseText;
                        document.getElementById('category_name').value = '';
                        document.getElementById('short_description').value = '';
                    }
                }
            }
        }
    </script>

<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>