<?php
include_once('../view/component/dashboard_sidebar.php');
include_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
include_once('../model/postsModel.php');
include_once('../model/medicineCategoryModel.php');
include_once('../model/medicineCompanyModel.php');
include_once('../model/medicinesModel.php');
$get_current_user_info = get_current_user_info();

$get_current_user_type = get_current_user_type();

//total users
$total_users = count_total_users();

//total pharmacists
$total_pharmacists = count_total_pharmacists();

//total customers
$total_customers = count_total_customers();

//count total posts
$total_posts = count_total_posts();

//count total medicine category
$total_medicine_category = count_total_medicine_category();

//count total medicine company
$total_medicine_company = count_total_medicine_company();

//count total medicines
$total_medicines = count_total_medicines();
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
                                            <p><?php echo $total_medicines; ?></p>
                                        </div>
                                    </div>
                                    <div class="column-twenty-five">
                                        <div class="single-block">
                                            <h3>Medicines Category</h3>
                                            <p><?php echo $total_medicine_category; ?></p>
                                        </div>
                                    </div>
                                    <div class="column-twenty-five">
                                        <div class="single-block">
                                            <h3>Medicines Company</h3>
                                            <p><?php echo $total_medicine_company; ?></p>
                                        </div>
                                    </div>
                                    <div class="column-twenty-five">
                                        <div class="single-block">
                                            <h3>Posts</h3>
                                            <p><?php echo $total_posts; ?></p>
                                        </div>
                                    </div>
                                    <div class="column-twenty-five">
                                        <div class="single-block">
                                            <h3>Total Users</h3>
                                            <p><?php echo $total_users; ?></p>
                                        </div>
                                    </div>
                                    <div class="column-twenty-five">
                                        <div class="single-block">
                                            <h3>Pharmacists</h3>
                                            <p><?php echo $total_pharmacists; ?></p>
                                        </div>
                                    </div>
                                    <div class="column-twenty-five">
                                        <div class="single-block">
                                            <h3>Customers</h3>
                                            <p><?php echo $total_customers; ?></p>
                                        </div>
                                    </div>
                                    <div class="column-twenty-five">
                                        <div class="single-block">
                                            <h3>Orders</h3>
                                            <p>0</p>
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