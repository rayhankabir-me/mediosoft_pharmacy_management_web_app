<?php


 include_once('../controller/functions.php');
 require_once('../model/usersModel.php');

 session_start();

 if(isset($_SESSION['user_login'])){
     header('location: profile.php');
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

        if ($login == true){
            session_start();
            $_SESSION["user_login"] = $username;

            if (isset($_POST["remember_me"])) {
                $cookie_name = "remember_user";
                $cookie_value = $username;
                $cookie_expire = time() + 30 * 24 * 60 * 60;
                setcookie($cookie_name, $cookie_value, $cookie_expire, "/");
            }
            header('location: profile.php');

        }else{
                $invalid_login = "Invalid login details! Try Again!";
            } 
    }



    

    
 }


?>




<!DOCTYPE html>
<html lang="en">
<head>

    <title>Login</title>
</head>
<body>

    <table border="1" width="100%">
    <tr>
        <td><a href="index.php"><h2>MedioSoft</h2></a></td>
        <td colspan="2">
            <a href="index.php">Home</a>
             | <a href="view/medicines.php">Medicines</a> 
             | <a href="view/blog.php">Blog</a> 
             | <a href="view/contact.php">Contact</a> 
             | <a href="view/registration.php">Register</a> 
             | <a href="view/login.php">Login</a>
        </td>
    </tr>

    <tr>
        <td></td>
        <td colspan="2">
            <br>
            <br>
                <h3>User Login</h3>
                <form action="#" method="post">
                    <fieldset>
                        <legend>Login</legend>
                        <label for="">User Name: </label><input type="text" name="username" id="">
                        <hr>
                        <label for="">Password: </label><input type="password" name="password" id="">
                        <hr>
                        <input type="checkbox" name="remember_me" id=""><label for="">Remember Me </label>
                        <br>
                        <br>
                        <input type="submit" value="Submit" name="submit">
                        <a href="#">Forgor Password?</a>
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