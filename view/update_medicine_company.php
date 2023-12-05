<?php
$page_title = "Update Medicine Company";
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
require_once('../model/usersModel.php');
if(!check_login_status()){
    header('location: login.php');
}

require_once('../model/medicineCompanyModel.php');


$get_current_user_info = get_current_user_info();

$company_id = '';
if(isset($_GET['id'])){
    $company_id = $_GET['id'];
}


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
                            <div class="form-container">
                                <div class="form-title">
                                    <h3>Update Medicine Company</h3>
                                </div>

                                <div class="medio-form">
                                    <form action="#" method="post" onsubmit="updateCompany()">

                                        <label for="company_name">Company Name </label><input type="text" name="company_name" id="company_name" value="">

                                        <label for="description">Short Description </label><textarea name="description" id="description" cols="30" rows="10"></textarea>

                                        <input type="submit" value="Submit" name="submit">
                                    </form>
                                </div>
                                <div id="status_messages"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    
    <script>

        showData();
        //fetch current data using ajax
        function showData(){
            let company_id = <?php echo $company_id; ?>;
            let action = 'current_data';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/medicineCompanyController.php?action='+action+'&company_id='+company_id, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    let data = JSON.parse(this.responseText);
                    document.getElementById('company_name').value = data.company_name;
                    document.getElementById('description').value = data.description;
                }
            }


        }


        //update company data by ajax
        function updateCompany(){
            event.preventDefault();
            let company_id = <?php echo $company_id; ?>;
            let company_name = document.getElementById('company_name').value;
            let description = document.getElementById('description').value;

            if(company_name == ''){
                document.getElementById('status_messages').innerHTML = "<p id='error_message'>you must fill category title..!</p>";
            }else if(description == ''){
                document.getElementById('status_messages').innerHTML = "<p id='error_message'>you must fill description..!</p>";
            }else{

                let action = 'update_company';

                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../controller/medicineCompanyController.php', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('action=' + action + '&company_name='+company_name + '&description='+description + '&company_id='+company_id);
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('status_messages').innerHTML = this.responseText;
                        showData();
                    }
                }

            }


        }
    </script>


<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>