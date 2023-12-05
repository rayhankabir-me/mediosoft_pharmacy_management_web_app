<?php
$page_title = "Forgot Password - MedioSoft";

 include_once('../controller/functions.php');
 require_once('../model/usersModel.php');
 require_once('../controller/send_mail.php');


 if(isset($_REQUEST['submit'])){

    $error_message = '';
    $email = $_REQUEST['email'];

    if($email == ''){
        $error_message .= "Your must fill your email address! <br>";

    }
    if($error_message === ''){

        $check_email = check_user_email($email);

        if ($check_email == true){

            $token = random_int(100000, 999999);
            $update_token = update_token($email, $token);

            if($update_token == true){

                //$send_mail = mail($email, "Reset Password - MedioSoft", "Use this code to reset your password: ".$token);
                
                $subject = "Password Reset from MedioSoft";
                $message = "Use this code to reset your password: ".$token;

                $send_mail = send_mail($email, $subject, $message);
                if($send_mail == true){
                    session_start();
                    $_SESSION['reset_password'] = 'We have sent you a reset code. Please check your email!';
                    header('location: reset_password.php');
                }elseif ($send_mail == false) {
                    $_SESSION['reset_password'] .= "Something is wrong in the mail setup!";
                    header('location: reset_password.php');
                }
            }


        }else{
                $invalid_login = "Sorry no user exists!";
            } 
    }



    

    
 }


?>


<!-- including header -->
<?php include_once('../view/component/frontend_header.php'); ?>

<section class="banner-section">
    <div class="container">
        <div class="banner-title">
            <h2>Forgot Password</h2>
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
                            <label for="email">Enter Email </label>
                            <input type="email" name="email" id="email">

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