<?php
$page_title = "Change Password - MedioSoft";
//auth
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
                            <div class="form-container">
                                <div class="form-title">
                                    <h3>Change Password</h3>
                                </div>

                                <div class="medio-form change_password">
                                    <form action="#" method="POST" onsubmit="changePassword()">
                                        <label for="password">Current Password: </label>
                                        <input type="password" name="password" id="password">
                                        <label for="new_password">New Password: </label><input type="password" name="new_password" id="new_password">
                                        <label for="c_password">Confirm Password: </label>
                                        <input type="password" name="c_password" id="c_password">
                                        <input type="submit" value="Change Password" name="submit">
                                    </form>
                                </div>
                                <div id="status_messages">
                                    <p><?php if(isset($error_message)){echo $error_message;} ?></p>
                                    <p><?php if(isset($success_message)){echo $success_message;} ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



<script>
    //update user data by ajax
    function changePassword(){
    event.preventDefault();
    let user_id = <?php echo $get_current_user_info['id'];?>;

    let password = document.getElementById('password').value;
    let new_password = document.getElementById('new_password').value;
    let c_password = document.getElementById('c_password').value;
    let action = 'change_password';


    if(password === ''){
        document.getElementById('status_messages').innerHTML = '<p id="error_message">you must enter your current password!</p>';
    }else if(new_password === ''){
        document.getElementById('status_messages').innerHTML = '<p id="error_message">you must enter new password!</p>';
    }else if(c_password === ''){
        document.getElementById('status_messages').innerHTML = '<p id="error_message">you must enter confirm password!</p>';
    }else if(new_password != c_password){
        document.getElementById('status_messages').innerHTML = '<p id="error_message">new password and confirm password don not match!</p>';
    }else{

        let xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../controller/userController.php', true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send('action=' + action + '&password='+password + '&new_password='+new_password + '&c_password='+c_password + '&user_id='+user_id);
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('status_messages').innerHTML = this.responseText;


            }
        }


        }



}
</script>

<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>