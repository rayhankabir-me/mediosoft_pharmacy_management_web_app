<?php

$page_title = 'All Users - MedioSoft';
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');

$get_current_user_info = get_current_user_info();



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
                                    <h3>All Users</h3>
                                </div>

                                <div class="all-medicines">
                                    <table class="table" id="show_users" width="100%">


                                    </table>
                                </div>
                                <div id="status_messages"></div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>


    
    <script>
            showUsers();
            //fetching medicines data using ajax
            function showUsers(){

                let action = 'get_data';
                let xhttp = new XMLHttpRequest();
                xhttp.open('GET', '../controller/userController.php?action='+action, true);

                xhttp.send();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('show_users').innerHTML = this.responseText;
                    }
                }

            }

        //delete operation using ajax
        function deleteUser(event){
            event.preventDefault();
            alert('are you sure to delete this user?');
            let user_id = event.target.getAttribute('data-user-id');
            user_id = parseInt(user_id);

            let action = 'delete_user';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/userController.php?action='+action+'&user_id='+user_id, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){

                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('status_messages').innerHTML = this.responseText;
                    showUsers();
                }
            }

        }
    </script>
<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>