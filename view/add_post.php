<?php
include_once('../controller/functions.php');
require_once('../model/postCategoryModel.php');
require_once('../model/usersModel.php');

$category_data = get_all_category_data();


if(isset($_REQUEST['submit'])){
   $error_message = '';
   $success_message = '';

   $image = $_REQUEST['category_name'];
   $title = $_REQUEST['short_description'];
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

   //get current user id
   $user_id = get_current_user_id();
   //data array
   $data = [
    'title' => $title,
    'image' => $image,
    'category'   => $category,
    'added_by'   => $user_id,
    'date'       => date("Y m d")

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
    <title>Add Post</title>
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
                <h3>Add Post</h3>
                <form action="#" method="post">

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

id, image, title, description, category, added_by, date
