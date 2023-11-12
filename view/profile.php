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
    <title>Profile</title>
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
                <p>Username: <strong><?php echo $get_current_user_info['user_name'];?></strong></p>
                <p>Full Name: <strong><?php echo $get_current_user_info['full_name'];?></strong></p>
                <p>Email Address: <strong><?php echo $get_current_user_info['email'];?></strong></p>
                <p>Gender: <strong><?php echo $get_current_user_info['gender'];?></strong></p>
                <p>Date Of Birth: <strong><?php echo $get_current_user_info['date_of_birth'];?></strong></p>

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