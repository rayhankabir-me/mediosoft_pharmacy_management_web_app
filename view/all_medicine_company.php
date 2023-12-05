<?php
$page_title = 'All Medicine Company';
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
include_once('../model/medicineCompanyModel.php');
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
                                <div class="table-data">
                                    <div class="form-title">
                                        <h3>All Medicine Company</h3>
                                    </div>

                                    <div class="all-medicines">
                                        <table id="show_company">


                                        </table>
                                    </div>
                                    <div id="status_messages"></div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>





    
    <script>
        //showing company with ajax
        showCompany();
        function showCompany(){

            let action = 'get_company';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/medicineCompanyController.php?action='+action, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('show_company').innerHTML = this.responseText;
                }
            }

        }
        //delete operation using ajax
        function deleteCompany(event){
            event.preventDefault();
            alert('are you sure to delete this company name?');
            let company_id = event.target.getAttribute('data-company-id');
            company_id = parseInt(company_id);

            let action = 'delete_compnay';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/medicineCompanyController.php?action='+action+'&company_id='+company_id, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){

                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('status_messages').innerHTML = this.responseText;
                    showCompany();
                }
            }

        }
    </script>


<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>