<?php
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
$get_current_user_info = get_current_user_info();

$get_current_user_type = get_current_user_type();
?>

<!-- including header -->
<?php include_once('../view/component/dashboard_header.php'); ?>

<?php 
if($get_current_user_type == "Pharmacist" || $get_current_user_type == "Customer"){
    header('location: ../view/profile.php');
}

?>

<div class="main-section">
                <div class="container">
                    <div class="row">
                        <div class="column-thirty-three">
                            <div class="dashboard-sidebar">
                                <?php echo get_sidebar();?>
                            </div>
                        </div>
                        <div class="column-sixty-six">
                            <div class="dashboard-block">
                                <div class="row">
                                    <div class="column-twenty-five">
                                        <div class="single-block">
                                            <h3>Total Medicines</h3>
                                            <p>20</p>
                                        </div>
                                    </div>
                                    <div class="column-twenty-five">
                                        <div class="single-block">
                                            <h3>Medicines Category</h3>
                                            <p>20</p>
                                        </div>
                                    </div>
                                    <div class="column-twenty-five">
                                        <div class="single-block">
                                            <h3>Medicines Company</h3>
                                            <p>20</p>
                                        </div>
                                    </div>
                                    <div class="column-twenty-five">
                                        <div class="single-block">
                                            <h3>Posts</h3>
                                            <p>20</p>
                                        </div>
                                    </div>
                                    <div class="column-twenty-five">
                                        <div class="single-block">
                                            <h3>Users</h3>
                                            <p>20</p>
                                        </div>
                                    </div>
                                    <div class="column-twenty-five">
                                        <div class="single-block">
                                            <h3>Pharmacists</h3>
                                            <p>20</p>
                                        </div>
                                    </div>
                                    <div class="column-twenty-five">
                                        <div class="single-block">
                                            <h3>Customers</h3>
                                            <p>20</p>
                                        </div>
                                    </div>
                                    <div class="column-twenty-five">
                                        <div class="single-block">
                                            <h3>Orders</h3>
                                            <p>20</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                </div>
    </div>



<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>