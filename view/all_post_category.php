<?php
$page_title = "Add Post Category - MedioSoft";
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
include_once('../model/postCategoryModel.php');
$get_current_user_info = get_current_user_info();

$categories = get_all_category_data();

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
                            <div class="table-data">
                                <div class="form-title">
                                    <h3>All Post Category</h3>
                                </div>

                                <div class="all-medicines">
                                    <table class="table" id="show_category">


                                    </table>
                                </div>
                                <div id="status_messages"></div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>


    </table>

    <script>
        //showing category with ajax
        showCategory();
        function showCategory(){

            let action = 'get_category';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/postCategoryController.php?action='+action, true);
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
            xhttp.open('GET', '../controller/postCategoryController.php?action='+action+'&category_id='+category_id, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){

                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('status_messages').innerHTML = this.responseText;
                    showCategory();
                }
            }

        }
    </script>
    
<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>