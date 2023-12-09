<?php 
require_once('../model/usersModel.php');


function get_sidebar(){
    $get_current_user_type = get_current_user_type();

    //showing menus for pharmacists and admin

    if($get_current_user_type == "Pharmacist" || $get_current_user_type == "Admin"){
        ?>

        <ul>

            <li>
                <a href="../view/all_medicines.php">Manage Medicines</a>
                <ul><li><a href="../view/add_medicine.php">Add Medicine</a></li></ul>
            </li>
            <li>
                <a href="../view/all_medicine_category.php">Manage Medicines Category</a>
                <ul>
                    <li><a href="../view/add_medicine_category.php">Add Category</a></li>
                </ul>
            </li>
            <li>
                <a href="../view/all_medicine_company.php">Manage Medicines Company</a>
                <ul>
                    <li><a href="../view/add_medicine_company.php">Add Company</a></li>
                </ul>
            </li>
            <li>
                <a href="../view/all_posts.php">Manage Posts</a>
                <ul>
                    <li><a href="../view/add_post.php">Add Post</a></li>
                </ul>
            </li>
            <li>
                <a href="../view/all_post_category.php">Manage Posts Category</a>
                <ul>
                    <li><a href="../view/add_post_category.php">Add Category</a></li>
                </ul>
            </li>
            <li><a href="../view/requested_medicines.php">View Requested Medicines</a></li>

        </ul>

        <?php
    }
    //showing menus for admin only
    if($get_current_user_type == "Admin"){
        ?>
            <ul>
                <li><a href="../view/view_all_chats.php">Manage Live Chat</a></li>
                <li><a href="../view/all_orders.php">Manage Orders</a></li>
                <li><a href="../view/all_contacts.php">Contacts</a></li>
                <li><a href="../view/pages_opitons.php">Pages Options</a></li>
                <li><a href="../view/all_users.php">Manage Users</a>
                    <ul>
                        <li><a href="../view/add_user.php">Add User</a></li>
                    </ul>
                </li>

            </ul>
        <?php
    }
    //showing menu for pharmacists only
    if($get_current_user_type == "Pharmacist"){
        ?>

        <ul>
            <li><a href="../view/view_all_tickets.php">View Support Tickets</a></li>
            <li><a href="../view/my_chats.php">Live Chat Lists</a></li>
        </ul>

        <?php
    }



    //showing menu for customers
    if($get_current_user_type == "Customer"){
        ?>
        <ul>
            <li><a href="../view/my_tickets.php">My Tickets</a></li>
            <li><a href="../view/my_chats.php">Live Chat Lists</a></li>
        </ul>

        <?php
    }

    //showing menu for all users
    ?>
        <ul>
            <li><a href="../view/profile.php">View Profile</a></li>
            <li><a href="../view/edit_profile.php">Edit Profile</a></li>
            <li><a href="../view/change_password.php">Change Password</a></li>
        </ul>


    <?php

}

?>