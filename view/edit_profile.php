<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');

$get_current_user_info = get_current_user_info();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
</head>
<body>

    <table border="1" width="100%">
    <tr>
        <td><a href="index.php"><h2>MedioSoft</h2></a></td>
        <td colspan="2">
            Welcome back! <strong><?php echo $get_current_user_info['full_name']; ?></strong>
             | Notifications 
             | <a href="../index.php">Visit Site</a>  
             | <a href="../controller/logout.php">Logout</a>
        </td>
    </tr>

    <tr>

        <td>
        <?php echo get_sidebar();?>
        </td>


        <td colspan="2">
            <br>
            <br>
                <h3>Profile Photo</h3>
                <img width="200px" src="<?php echo $get_current_user_info['profile_photo'];?>" alt="">

                <form action="#" method="post">

                <label for="">Email: </label><input type="email" name="email" id="" value="<?php echo $get_current_user_info['email'];?>">
                <hr>
                <label for="">Full Name: </label><input type="text" name="full_name" id="" value="<?php echo $get_current_user_info['full_name'];?>">
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