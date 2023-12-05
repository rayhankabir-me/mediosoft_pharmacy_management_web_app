<?php
$page_title = "Medicines - MedioSoft";
//requring files
require_once('../model/medicinesModel.php');
require_once('../model/medicineCategoryModel.php');
require_once('../model/medicineCompanyModel.php');
$medicines = get_all_medicines_data();
$medicine_category_data = get_all_medicine_category_data();
$medicine_company_data = get_all_medicine_company_data();



?>




<!-- including header -->
<?php include_once('../view/component/frontend_header.php'); ?>

<div class="main-section">
                <div class="container">
                    <div class="row">
                        <div class="column-thirty-three">
                            <div class="dashboard-sidebar">
                                <!-- search medincine -->
                                <h3>Search Medicine</h3>
                                <form action="#" method="GET" onsubmit="searchMedicine()">
                                    <input type="text" name="medicine_name" id="medicine_name" placeholder="Medicine Name">
                                    <input type="submit" value="Search Medicine">
                                    <div id="status_messages"></div>
                                </form>

                                <!-- filter by category -->
                                <h3>Filter By Category</h3>
                                <form action="#" method="GET" onsubmit="filterByCategory()">
                                    <select name="medicine_category" id="medicine_category">
                                        <?php 
                                        foreach($medicine_category_data as $data){
                                            ?>
                                                <option value="<?php echo $data['id']; ?>"><?php echo $data['category_title']; ?></option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                    <input type="submit" value="Filter">

                                </form>


                                <!-- filter by company  -->
                                <h3>Filter By Company</h3>
                                <form action="#" method="GET" onsubmit="filterByCompany()">
                                    <select name="medicine_company" id="medicine_company">
                                        <?php 
                                        foreach($medicine_company_data as $data){
                                            ?>
                                                <option value="<?php echo $data['id']; ?>"><?php echo $data['company_name']; ?></option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                <input type="submit" value="Filter">
                                </form>
                            </div>
                        </div>
                        <div class="column-sixty-six">
                            <!-- all medicines box -->
                            <div id="all_medicines_box">

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
                xhttp.open('GET', '../controller/medicines_process.php?action='+action, true);

                xhttp.send();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('all_medicines_box').innerHTML = this.responseText;
                    }
                }

            }

            //search medicines
            function searchMedicine(){
                event.preventDefault();
                let action = 'search_medicine';
                let medicine_name = document.getElementById('medicine_name').value;
                if(medicine_name == ""){
                    document.getElementById('status_messages').innerHTML = '<p id="error_message">you must type something...!</p>';
                }else{
                let xhttp = new XMLHttpRequest();
                xhttp.open('GET', '../controller/medicines_process.php?action='+action+'&medicine_name='+medicine_name, true);
                xhttp.send();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('all_medicines_box').innerHTML = this.responseText;
                        document.getElementById('status_messages').innerHTML = '';
                    }
                }
                }

            }

            //filter medicine by category
            function filterByCategory(){

                event.preventDefault();
                let action = 'category_filter';
                let category_id = document.getElementById('medicine_category').value;
                category_id = parseInt(category_id);
                let xhttp = new XMLHttpRequest();
                xhttp.open('GET', '../controller/medicines_process.php?action='+action + '&category_id='+category_id, true);
                xhttp.send();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('all_medicines_box').innerHTML = this.responseText;
                        document.getElementById('status_messages').innerHTML = '';
                    }
                }

            }

            //filter medicine by company
            function filterByCompany(){

            event.preventDefault();
            let action = 'company_filter';
            let company_id = document.getElementById('medicine_company').value;
            company_id = parseInt(company_id);
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/medicines_process.php?action='+action + '&company_id='+company_id, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('all_medicines_box').innerHTML = this.responseText;
                    document.getElementById('status_messages').innerHTML = '';
                }
            }

            }
    </script>
<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>

