<?php


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

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
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
            <?php
            session_start();
            if(isset($_SESSION['reset_password'])){
            echo $_SESSION['reset_password'];
            }
            ?>
            <br>
            <br>
                <form action="#" method="post">
                    <fieldset>
                        <legend>Reset Code</legend>
                        <label for="">Enter Code </label><input type="text" name="reset_token" id="">
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



