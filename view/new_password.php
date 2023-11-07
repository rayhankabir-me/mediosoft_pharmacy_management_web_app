<?php
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
            header('location: login.php');

        }else{
                $invalid_login = "password update failed! try again!";
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
                <form action="#" method="post">
                    <fieldset>
                        <legend>Reset Password</legend>
                        <label for="">New Password </label><input type="password" name="new_password" id="">
                        <hr>
                        <label for="">Confirm Password </label><input type="password" name="c_password" id="">
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



