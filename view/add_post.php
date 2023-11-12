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
require_once('../model/postsModel.php');
require_once('../model/usersModel.php');
require_once('../model/postCategoryModel.php');

$category_data = get_all_category_data();


if(isset($_REQUEST['submit'])){
   $error_message = '';
   $success_message = '';

   $image = $_FILES['image'];
   $title = $_REQUEST['title'];
   $description = $_REQUEST['description'];
   $category = '';
   if(isset($_REQUEST['category'])){
    $category = $_REQUEST['category'];
   }


   if($image == ''){
       $error_message .= "Your must fill Image! <br>";
   }
   if($title == ''){
       $error_message .= "Your must fill title! <br>";
   }
   if($category == ''){
       $error_message .= "Your must select a category! <br>";
   }
   if($description == ''){
       $error_message .= "Your must fill description! <br>";
   }

   // file info
   $source = $image['tmp_name'];
   $destination = '../assets/image/posts/'.$image['name'];


   //get current user id
   $user_id = get_current_user_id();
   //data array
   $data = [
    'title' => $title,
    'image' => $destination,
    'description' => $description,
    'category'   => $category,
    'added_by'   => $user_id,
    'date'       => date("Y-m-d")

    ];





    if($error_message === ''){

        $result = add_post($data);
    
        if($result === true){
            
            if (!file_exists($destination)) {
                if(move_uploaded_file($source, $destination)){
                }
            }
            $success_message .= "Post added successfully!";
        }elseif ($result === false) {
            $success_message .= "Post add failed!";
        }
        
       }



   
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Post</title>
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
                <h3>Add Post</h3>
                <form action="#" method="post" enctype="multipart/form-data">

                <label for="">Upload Image  </label><input type="file" name="image" id="">
                <hr>
                <label for="">Title </label><input type="text" name="title" id="">
                <hr>
                <label for="">Description </label><textarea name="description" id=""></textarea>
                <hr>
                <label for="">Category </label>
                <select name="category" id="">
                    <?php 
                    foreach($category_data as $data){
                        ?>
                            <option value="<?php echo $data['id']; ?>"><?php echo $data['category_name']; ?></option>
                        <?php
                    }
                    ?>

                </select>
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
