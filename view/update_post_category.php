<?php
include_once('../controller/functions.php');
require_once('../model/postCategoryModel.php');



$category_id = '';
if(isset($_GET['id'])){
    $category_id = $_GET['id'];
}

if(isset($_SESSION['notify_status'])){
    echo $_SESSION['notify_status'];
}

$category_data = get_category_data($category_id);

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



   //data array
   $data = [
    'category_name' => $category_name,
    'short_description' => $short_description,

    ];

   if($error_message === ''){
    $result = update_category($category_id, $data);

    if($result){
        $success_message .= "Category updated successfully!";
    }else{
        $error_message .= "Category update failed! try again!";
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
            <a href="index.php">Home</a>
             | <a href="medicines.php">Medicines</a> 
             | <a href="blog.php">Blog</a> 
             | <a href="contact.php">Contact</a> 
             | <a href="../controller/logout.php">Logout</a>
        </td>
    </tr>

    <tr>
        <td></td>
        <td colspan="2">
            <br>
            <br>
                <h3>Update Post Category</h3>
                <form action="#" method="post">


                <label for="">Category Name </label><input type="text" name="category_name" id="" value="<?php if($category_data){echo $category_data['category_name']; }?>">
                <hr>
                <label for="">Short Description </label><textarea name="short_description" id="" cols="30" rows="10"><?php if($category_data){echo $category_data['short_description']; }?></textarea>
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