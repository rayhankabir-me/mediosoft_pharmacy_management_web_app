<?php

$page_title = "User Login - MedioSoft";
 include_once('../controller/functions.php');
 require_once('../model/usersModel.php');
 include_once('../controller/check_login_status.php');

if(check_login_status()){
    header('location: dashboard.php');
}


 if(isset($_REQUEST['submit'])){

    $error_message = '';
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    if($username == ''){
        $error_message .= "Your must fill User Name! <br>";

    }
    if($password == ''){
        $error_message .= "Your must fill Password! <br>";
    }
    if($error_message === ''){

        $login = user_login($username, $password);
        $user_data = get_user_type($username);
        $user_type = $user_data->fetch_assoc();
        if ($login == true){
            session_start();
            $_SESSION["user_login"] = $username;

            if (isset($_POST["remember_me"])) {
                $cookie_name = "remember_user";
                $cookie_value = $username;
                $cookie_expire = time() + 30 * 24 * 60 * 60;
                setcookie($cookie_name, $cookie_value, $cookie_expire, "/");
            }
            header('location: dashboard.php');

        }else{
                $invalid_login = "Invalid login details! Try Again!";
            } 
    }



    

    
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
                <form action="#" method="post">

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
                
                <p><?php if(isset($error_message)){echo $error_message;} ?></p>
                <p><?php if(isset($invalid_login)){echo $invalid_login;} ?></p>
            </div>
        </div>
    </div>
</section>


<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>