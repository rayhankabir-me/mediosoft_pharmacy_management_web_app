<?php
$page_title = "Forgot Password - MedioSoft";

 include_once('../controller/functions.php');
 require_once('../model/usersModel.php');
 require_once('../controller/send_mail.php');


 if(isset($_REQUEST['submit'])){

    $error_message = '';
    $email = $_REQUEST['email'];

    if($email == ''){
        $error_message .= "Your must fill User Name! <br>";

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
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Forgot Pasword - MedioSoft</title>
</head>
<body>

    <table border="1" width="100%">
    <tr>
        <td><a href="index.php"><h2>MedioSoft</h2></a></td>
        <td colspan="2">
            <a href="index.php">Home</a>
             | <a href="medicines.php">Medicines</a> 
             | <a href="blog.php">Blog</a> 
             | <a href="contact.php">Contact</a> 
             | <a href="registration.php">Register</a> 
             | <a href="login.php">Login</a>
        </td>
    </tr>

    <tr>
        <td></td>
        <td colspan="2">
            <br>
            <br>
                <form action="#" method="post">
                    <fieldset>
                        <legend>Reset Password</legend>
                        <label for="">Enter Email </label><input type="email" name="email" id="">
                        <hr>
                        <br>
                        <input type="submit" value="Submit" name="submit">
                        <br>
                        <p><?php if(isset($error_message)){echo $error_message;} ?></p>
                        <p><?php if(isset($invalid_login)){echo $invalid_login;} ?></p>
                    </fieldset>
                </form>
            <br>
            <br>

        </td>
    </tr>
    <tr>
        <td colspan="3">Copyright &copy; 2023 MedioSoft. All rights are reserved.</td>
    </tr>

    </table>
    
</body>
</html>