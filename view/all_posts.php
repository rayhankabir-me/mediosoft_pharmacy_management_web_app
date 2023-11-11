<?php
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
include_once('../model/postsModel.php');
$get_current_user_info = get_current_user_info();

$get_posts_data = get_all_posts_data();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Posts</title>
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
                        <td>Post Image</td>
                        <td>Post Title</td>
                        <td>Category</td>
                        <td>Date</td>
                        <td>Action</td>
                    </tr>

                    <?php
                        foreach ($get_posts_data as $data) {
                           ?>
                            <tr>
                                <td><img width="120px" src="<?php echo $data['image']; ?>" alt=""></td>
                                <td><?php echo $data['title']; ?></td>
                                <td><?php echo $data['category']; ?></td>
                                <td><?php echo $data['date']; ?></td>
                                <td><a href="../view/edit_post.php?id=<?php echo $data['id']; ?>">Edit</a> | <a href="../view/delete_post.php?id=<?php echo $data['id']; ?>">Delete</a></td>
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