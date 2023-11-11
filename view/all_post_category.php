<?php
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
include_once('../model/postCategoryModel.php');
$get_current_user_info = get_current_user_info();

$categories = get_all_category_data();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Post Category</title>
</head>
<body>

    <table border="1" width="100%">
    <tr>
        <td><a href="index.php"><h2>MedioSoft</h2></a></td>
        <td colspan="2">
            Welcome back! <strong><?php echo $get_current_user_info['full_name']; ?></strong>
             | Notifications 
             | <a href="index.php">Visit Site</a>  
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
                <table border="1" width="100%">
                    <tr>
                        <td>Category Name</td>
                        <td>Short Description</td>
                        <td>Action</td>
                    </tr>

                    <?php

                        foreach ($categories as $category) {
                           ?>
                            <tr>
                                <td><?php echo $category['category_name']; ?></td>
                                <td><?php echo $category['short_description']; ?></td>
                                <td><a href="../view/update_post_category.php?id=<?php echo $category['id']; ?>">Edit</a> | <a href="../view/delete_post_category.php?id=<?php echo $category['id']; ?>">Delete</a></td>
                            </tr>
                           <?php
                        }

                    ?>

                </table>

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