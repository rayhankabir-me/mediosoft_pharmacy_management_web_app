<?php
$page_title = "Update Post Category - MedioSoft";
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
require_once('../model/usersModel.php');
if(!check_login_status()){
    header('location: login.php');
}

//include_once('../controller/functions.php');
require_once('../model/postCategoryModel.php');

$get_current_user_info = get_current_user_info();
$category_id = '';
if(isset($_GET['id'])){
    $category_id = $_GET['id'];
}
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
                                    <h3>Update Post Category</h3>
                                </div>

                                <div class="medio-form">
                                    <form action="#" method="post" onsubmit="updateCategory()">
                                        <label for="category_name">Category Name </label>
                                        <input type="text" name="category_name" id="category_name" value="">
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

        showData();
        //fetch current post data using ajax
        function showData(){
            let category_id = <?php echo $category_id; ?>;
            let action = 'current_data';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/postCategoryController.php?action='+action+'&category_id='+category_id, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    let data = JSON.parse(this.responseText);
                    document.getElementById('category_name').value = data.category_name;
                    document.getElementById('short_description').value = data.short_description;
                }
            }
        }

        //update category data by ajax
        function updateCategory(){
            event.preventDefault();
            let category_id = <?php echo $category_id; ?>;
            let category_name = document.getElementById('category_name').value;
            let short_description = document.getElementById('short_description').value;

            if(category_name == ''){
                document.getElementById('status_messages').innerHTML = "<p id='error_message'>You must fill the category name..!</p>";
            }else if(short_description == ''){
                document.getElementById('status_messages').innerHTML = "<p id='error_message'>You must fill the description..!</p>";
            }else{

                let action = 'update_category';

                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../controller/postCategoryController.php', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('action=' + action + '&category_name='+category_name + '&short_description='+short_description + '&category_id='+category_id);
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('status_messages').innerHTML = this.responseText;
                        showData();
                    }
                }
            }
        }
    </script>


<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>