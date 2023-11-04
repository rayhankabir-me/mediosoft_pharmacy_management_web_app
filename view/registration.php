<?php
include_once('../controller/functions.php');
require_once('../model/usersModel.php');

if(isset($_REQUEST['submit'])){

   $error_message = '';
   $success_message = '';
   $username = $_REQUEST['username'];
   $email = $_REQUEST['email'];
   $full_name = $_REQUEST['full_name'];
   $password = $_REQUEST['password'];
   $c_password = $_REQUEST['c_password'];

   if(isset($_REQUEST['gender'])){
       $gender = $_REQUEST['gender'];
   }else{
       $gender = '';
   }

   $date_of_birth = $_REQUEST['date_of_birth'];

   if($full_name == ''){
       $error_message .= "Your must fill Full Name! <br>";
   }elseif (name_validation($full_name) === false) {
       $error_message .= "Invalid Name Format! <br>";
   }
   if($email == ''){
       $error_message .= "Your must fill Email! <br>";
   }elseif (email_validation($email) === false) {
       $error_message .= "Invalid Email Format! <br>";
   }
   if($username == ''){
       $error_message .= "Your must fill User Name! <br>";
   }elseif (username_validation($username) === false) {
       $error_message .= "Invalid User Name Format! <br>";
   }elseif (user_name_exists($username) == true) {
    $error_message .= "This User Name Already Exists. Try Another! <br>";
   }
   if($password == ''){
       $error_message .= "Your must fill Password! <br>";
   }elseif (password_validation($password) === false) {
       $error_message .= "Wrong Password Format! <br>";
   }elseif ($c_password !== $password) {
       $error_message .= "Password Doesn't Match! <br>";
   }
   if($gender == ''){
       $error_message .= "Your must fill Gender! <br>";
   }
   if ($date_of_birth == '') {
       $error_message .= "You must fill Date of Birth! <br>";
   }


   //data array
   $submited_data = [
    'user_name' => $username,
    'full_name' => $full_name,
    'email' => $email,
    'gender' => $gender,
    'date_of_birth' => $date_of_birth,
    'password' => $password,
    'user_type' => 'Customer'
    ];

   if($error_message === ''){

    $result = create_user($submited_data);
    if($result){
        $error_message .= "Registration Success! <a href='login.php'>Login Now</a> <br>";
    }
    
   }


   


   

   
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration - MedioSoft</title>
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
                <h3>User Registration</h3>
                <form action="#" method="post">


                <label for="">User Name: </label><input type="text" name="username" id="">
                <hr>
                <label for="">Email: </label><input type="email" name="email" id="">
                <hr>
                <label for="">Full Name: </label><input type="text" name="full_name" id="">
                <hr>
                <label for="">Password: </label><input type="password" name="password" id="">
                <hr>
                <label for="">Confirm Password: </label><input type="password" name="c_password" id="">
                <hr>
                <fieldset>
                <legend>Gender</legend>
                <input type="radio" name="gender" value="male" id=""><label for=""> Male</label>
                <input type="radio" name="gender" value="female" id=""><label for=""> Female</label>
                <input type="radio" name="gender" value="other" id=""><label for=""> Other</label>
                </fieldset>
                <br>
                <fieldset>
                <legend>Date of Birth</legend>
                <input type="date" name="date_of_birth" id="">
                </fieldset>

                <p><?php if(isset($error_message)){echo $error_message;} ?></p>
                <p><?php if(isset($success_message)){echo $success_message;} ?></p>

                <br>
                <input type="submit" value="Submit" name="submit">
                <input type="submit" value="Reset" name="reset">
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