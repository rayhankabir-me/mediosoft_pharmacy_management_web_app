<?php
$page_title = "Profile - MedioSoft";
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');

$get_current_user_info = get_current_user_info();


?>

<!-- including header -->
<?php include_once('../view/component/dashboard_header.php'); ?>


<div class="main-section">
                <div class="container">
                    <div class="row">
                        <div class="column-thirty-three">
                            <div class="dashboard-sidebar">
                                <?php echo get_sidebar();?>
                            </div>
                        </div>
                        <div class="column-sixty-six">
                            <div class="medicines-container">
                                
                                <div class="profile-content">

                                <h3>Profile Photo</h3>
                                <img width="200px" src="<?php echo $get_current_user_info['profile_photo'];?>" alt="">
                                <p>Username: <strong><?php echo $get_current_user_info['user_name'];?></strong></p>
                                <p>Full Name: <strong><?php echo $get_current_user_info['full_name'];?></strong></p>
                                <p>Email Address: <strong><?php echo $get_current_user_info['email'];?></strong></p>
                                <p>Gender: <strong><?php echo $get_current_user_info['gender'];?></strong></p>
                                <p>Date Of Birth: <strong><?php echo $get_current_user_info['date_of_birth'];?></strong></p>
                                <p>User Role: <strong><?php echo $get_current_user_info['user_type'];?></strong></p>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
    </div>

    
<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>