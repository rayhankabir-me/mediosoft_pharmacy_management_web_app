<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
$get_current_user_info = get_current_user_info();



include_once('../controller/functions.php');
require_once('../model/postCategoryModel.php');
require_once('../model/usersModel.php');




if(isset($_REQUEST['submit'])){
   $error_message = '';
   $success_message = '';

   $category_name = $_REQUEST['category_name'];
   $short_description = $_REQUEST['short_description'];

   if($category_name == ''){
       $error_message .= "Your must fill Category Name! <br>";
   }
   if($short_description == ''){
       $error_message .= "Your must add Description! <br>";
   }

   //get current user id
   $user_id = get_current_user_id();
   //data array
   $data = [
    'category_name' => $category_name,
    'short_description' => $short_description,
    'user_id'   => $user_id

    ];

   if($error_message === ''){
    $result = add_category($data);

    if($result){
        $success_message .= "Category added successfully!";
    }else{
        $error_message .= "Category add failed! try again!";
    }
    
   }

   
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Post Category</title>
</head>
<body>

    <table border="1" width="100%">
    <tr>
        <td><a href="index.php"><h2>MedioSoft</h2></a></td>
        <td colspan="2">
            Welcome back! <strong><?php echo $get_current_user_info['full_name']; ?></strong>
             | Notifications 
             | <a href="blog.php">Visit Site</a>  
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
                <h3>Add Post Category</h3>
                <form action="#" method="post">


                <label for="">Category Name </label><input type="text" name="category_name" id="">
                <hr>
                <label for="">Short Description </label><textarea name="short_description" id="" cols="30" rows="10"></textarea>
                <hr>
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