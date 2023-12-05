<?php
$page_title = "New Password";
 include_once('../controller/functions.php');
 require_once('../model/usersModel.php');
 session_start();

 $token = $_SESSION['new_pass'];

 if(isset($_REQUEST['submit'])){

    $error_message = '';
    $new_password = $_REQUEST['new_password'];
    $c_password = $_REQUEST['c_password'];

    if($new_password == ''){
        $error_message .= "Your must fill Password! <br>";
    }elseif (password_validation($new_password) === false) {
        $error_message .= "Wrong Password Format! <br>";
    }elseif ($c_password !== $new_password) {
        $error_message .= "Password Doesn't Match! <br>";
    }

    if($error_message === ''){

        $update_password = update_password_by_token($new_password, $token);

        if ($update_password == true){

            unset($_SESSION['new_pass']);
            $_SESSION['success_message'] = "Your password has been changed!";
            header('location: ../controller/logout.php');

        }else{
                $invalid_login = "password update failed! try again!";
            } 
    }

 }

?>

<!-- including header -->
<?php include_once('../view/component/frontend_header.php'); ?>

<section class="banner-section">
    <div class="container">
        <div class="banner-title">
            <h2>New Password</h2>
        </div>
    </div>
</section>


<section class="main-section">
    <div class="container">
        <div class="form-container">

            <div class="medio-form">
                <form action="#" method="post">
                    <fieldset>
                        <legend>Reset Password</legend>
                        <label for="new_password">New Password </label>
                        <input type="password" name="new_password" id="new_password">
                        <label for="">Confirm Password </label>
                        <input type="password" name="c_password" id="c_password">
                        <input type="submit" value="Submit" name="submit">
                    </fieldset>
                </form>
            </div>
            <div id="status_messages">
                
                <?php if(isset($error_message)){echo "<p id='error_message'>".$error_message."</p>";} ?>
                <?php if(isset($invalid_login)){echo "<p id='error_message'>".$invalid_login."</p>";} ?></p>
            </div>
        </div>
    </div>
</section>
    
    
<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>



