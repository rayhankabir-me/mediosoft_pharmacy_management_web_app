<?php
$page_title = "User Registration - MedioSoft";
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

<!-- including header -->
<?php include_once('../view/component/frontend_header.php'); ?>

<section class="banner-section">
    <div class="container">
        <div class="banner-title">
            <h2>User Registration</h2>
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

                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email">

                    <label for="full_name">Full Name: </label>
                    <input type="text" name="full_name" id="full_name">

                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password">

                    <label for="c_password">Confirm Password: </label>
                    <input type="password" name="c_password" id="c_password">

                    <div class="checkbox-container">
                        <fieldset>
                        <legend>Gender</legend>
                            <input type="radio" name="gender" value="male" id=""><label for=""> Male</label>
                            <input type="radio" name="gender" value="female" id=""><label for=""> Female</label>
                            <input type="radio" name="gender" value="other" id=""><label for=""> Other</label>
                        </fieldset>
                    </div>

                    <fieldset>
                    <legend>Date of Birth</legend>
                    <input type="date" name="date_of_birth" id="">
                    </fieldset>



                    <br>
                    <input type="submit" value="Submit" name="submit">
                    <input type="submit" value="Reset" name="reset">
                </form>
            </div>
            <div id="status_messages">
                
                    <p><?php if(isset($error_message)){echo $error_message;} ?></p>
                    <p><?php if(isset($success_message)){echo $success_message;} ?></p>
            </div>
        </div>
    </div>
</section>



<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>