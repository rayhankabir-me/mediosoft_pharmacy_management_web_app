<?php 
require_once('../model/usersModel.php');


function get_sidebar(){
    $get_current_user_type = get_current_user_type();
    if($get_current_user_type == "Admin"){
        ?>

        <ul>

            <li><a href="">Manage Medicines</a></li>
            <li><a href="">Manage Medicines Category</a></li>
            <li><a href="">Manage Medicines Company</a></li>
            <li><a href="">Manage Posts</a></li>
            <li><a href="">Manage Posts Category</a></li>
            <li><a href="">View Requested Medicines</a></li>
            <li><a href="">Manage Orders</a></li>
            <li><a href="">Contacts</a></li>
            <li><a href="">Pages Options</a></li>
            <li><a href="">View Profile</a></li>
            <li><a href="">Edit Profile</a></li>
            <li><a href="">Change Profile Photo</a></li>
            <li><a href="">Change Password</a></li>

        </ul>

        <?php
    }



}

?>