<?php 
require_once('../model/usersModel.php');


function get_sidebar(){
    $get_current_user_type = get_current_user_type();

    //showing menus for admin only
    if($get_current_user_type == "Admin"){
        ?>

        <ul>

            <li>
                <a href="../view/all_medicines.php">Manage Medicines</a>
                <ul><li><a href="../view/add_medicine.php">Add Medicine</a></li></ul>
            </li>
            <li><a href="">Manage Medicines Category</a></li>
            <li><a href="">Manage Medicines Company</a></li>
            <li>
                <a href="../view/all_posts.php">Manage Posts</a>
                <ul>
                    <li><a href="../view/add_post.php">Add Post</a></li>
                </ul>
            </li>
            <li><a href="">Manage Posts Category</a></li>
            <li><a href="">View Requested Medicines</a></li>
            <li><a href="">Manage Orders</a></li>
            <li><a href="">Contacts</a></li>
            <li><a href="">Pages Options</a></li>
        </ul>

        <?php
    }

    //showing menu for all users
    ?>
        <ul>
            <li><a href="">View Profile</a></li>
            <li><a href="">Edit Profile</a></li>
            <li><a href="">Change Profile Photo</a></li>
            <li><a href="">Change Password</a></li>
        </ul>
    <?php



}

?>