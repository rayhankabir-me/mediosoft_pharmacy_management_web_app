<?php
$page_title = "Update Medicine Category";
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
                                    <h3>Update Medicine Category</h3>
                                </div>

                                <div class="medio-form">
                                    <form action="#" method="post" onsubmit="updateCategory()">
                                        <label for="category_title">Category Name </label><input type="text" name="category_title" id="category_title" value="">
                                        <label for="description">Short Description </label><textarea name="description" id="description" cols="30" rows="10"></textarea>
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
<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>