<?php
$page_title = "Reset Password - MedioSoft";

 include_once('../controller/functions.php');
 require_once('../model/usersModel.php');


 if(isset($_REQUEST['submit'])){

    $error_message = '';
    $reset_token = $_REQUEST['reset_token'];

    if($reset_token == ''){
        $error_message .= "Your must fill the reset Code! <br>";

    }

    if($error_message === ''){

        $check_token = check_reset_token($reset_token);

        if ($check_token == true){

            session_start();
            unset($_SESSION['reset_password']);
            $_SESSION['new_pass'] = $reset_token;
            header('location: new_password.php');

        }else{
                $invalid_login = "Invalid reset code! try again!";
            } 
    }

    
 }


?>

<!-- including header -->
<?php include_once('../view/component/frontend_header.php'); ?>

<section class="banner-section">
    <div class="container">
        <div class="banner-title">
            <h2>Reset Password</h2>
        </div>
    </div>
</section>


<section class="main-section">
    <div class="container">
        <div class="form-container">

            <div class="medio-form">
                <?php
                session_start();
                    if(isset($_SESSION['reset_password'])){
                    echo "<p class='reset-password-warning' id='success_message'>".$_SESSION['reset_password']."</p>";
                    }
                ?>
                <form action="#" method="post">
                        <fieldset>
                            <legend>Reset Code</legend>
                            <label for="reset_token">Enter Code </label>
                            <input type="text" name="reset_token" id="reset_token">

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



