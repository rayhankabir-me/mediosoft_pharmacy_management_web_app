<?php

$page_title = 'All Medicines - MedioSoft';
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
include_once('../model/medicinesModel.php');
$medicines = get_all_medicines_data();
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
                                    <h3>All Medicines</h3>
                                </div>

                                <div class="all-medicines">
                                    <table class="table" id="show_medicine" width="100%">


                                    </table>
                                </div>
                                <div id="status_messages"></div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>


    
    <script>
            showMedicines();
            //fetching medicines data using ajax
            function showMedicines(){

                let action = 'get_data';
                let xhttp = new XMLHttpRequest();
                xhttp.open('GET', '../controller/medicinesController.php?action='+action, true);

                xhttp.send();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('show_medicine').innerHTML = this.responseText;
                    }
                }

            }

        //delete operation using ajax
        function deleteMedicine(event){
            event.preventDefault();
            alert('are you sure to delete this medicine?');
            let medicine_id = event.target.getAttribute('data-medicine-id');
            medicine_id = parseInt(medicine_id);

            let action = 'delete_medicine';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/medicinesController.php?action='+action+'&medicine_id='+medicine_id, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){

                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('status_messages').innerHTML = this.responseText;
                    showMedicines();
                }
            }

        }
    </script>
<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>