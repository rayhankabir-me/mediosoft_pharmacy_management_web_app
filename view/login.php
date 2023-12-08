<?php

$page_title = "User Login - MedioSoft";
 include_once('../controller/functions.php');
 require_once('../model/usersModel.php');
 include_once('../controller/check_login_status.php');

if(check_login_status()){
    header('location: dashboard.php');
}





?>


<!-- including header -->
<?php include_once('../view/component/frontend_header.php'); ?>

<section class="banner-section">
    <div class="container">
        <div class="banner-title">
            <h2>Login Here</h2>
        </div>
    </div>
</section>


<section class="main-section">
    <div class="container">
        <div class="form-container">

            <div class="medio-form">
                <form action="#" method="POST" id="login_form" enctype="multipart/form-data" onsubmit="loginUser()">

                        <label for="username">User Name: </label>
                        <input type="text" name="username" id="username">

                        <label for="password">Password: </label>
                        <input type="password" name="password" id="password">
                        <div class="checkbox-container">
                            <input type="checkbox" name="remember_me" id="remember_me">
                            <label for="">Remember Me </label>

                        </div>


                        <input type="submit" value="Submit" name="submit">
                        <a href="forgot_password.php">Forgot Password?</a>


                    </form>
            </div>
            <div id="status_messages">

            </div>
        </div>
    </div>
</section>


<script>
        function loginUser() {
        event.preventDefault();

        let username = document.getElementById('username').value;
        let password = document.getElementById('password').value;


        if(username === ''){
            document.getElementById('status_messages').innerHTML = '<p id="error_message">You must enter user name!</p>';
        }else if(password === ''){
            document.getElementById('status_messages').innerHTML = '<p id="error_message">You must enter password!</p>';
        }else{
        let formData = new FormData(document.getElementById('login_form'));

        formData.append('action', 'user_login');

        let xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../controller/userController.php', true);

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('status_messages').innerHTML = this.responseText;
  
            }
        }

        xhttp.send(formData);
        }


    }
</script>


<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>