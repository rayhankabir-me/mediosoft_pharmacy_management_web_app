<?php
$page_title = "Update Medicine - MedioSoft";
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
require_once('../model/usersModel.php');
if(!check_login_status()){
    header('location: login.php');
}

require_once('../model/medicineCategoryModel.php');
require_once('../model/medicineCompanyModel.php');

$catgories = get_all_category_data();
$companies = get_all_company_data();


$get_current_user_info = get_current_user_info();

$medicine_id = '';
if(isset($_GET['id'])){
    $medicine_id = $_GET['id'];
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
                                <div class="existing-photo">
                                    <h3>Update Medicine</h3>
                                    <img id="current_image" width="200px" src="" alt="">
                                </div>

                                <div class="medio-form">
                                    <form id="medicine_form" action="#" method="POST" enctype="multipart/form-data" onsubmit="updateMedicine()">

                                        <label for="image_url">Upload New Image</label>
                                        <input type="file" name="image_url" id="image_url">
                                        <label for="medicine_title">Medicine Name </label>
                                        <input type="text" name="medicine_title" id="medicine_title">

                                        <label for="description">Description </label>

                                        <textarea name="description" id="description"></textarea>

                                        <label for="category_id">Select Category</label>

                                        <select name="category_id" id="category_id">
                                            <?php
                                                foreach($catgories as $category){
                                                    
                                                    ?>
                                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['category_title']; ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>

                                        <label for="">Select Company</label>

                                        <select name="company_id" id="company_id">
                                        <?php
                                                foreach($companies as $company){
                                                    
                                                    ?>
                                                        <option value="<?php echo $company['id']; ?>"><?php echo $company['company_name']; ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>

                                        <label for="medicine_price">Medicine Price</label>

                                        <input type="text" name="medicine_price" id="medicine_price">
                                        <label for="medicine_quanity">Medicine Quantity</label>

                                        <input type="number" name="medicine_quanity" id="medicine_quanity">

                                        <label for="manufacturing_date">Manufacturing Data</label>

                                        <input type="date" name="manufacturing_date" id="manufacturing_date">

                                        <label for="expire_date">Expire Date</label>

                                        <input type="date" name="expire_date" id="expire_date">


                                        <input type="submit" value="Update" name="submit">

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
            let medicine_id = <?php echo $medicine_id; ?>;
            let action = 'current_data';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/medicinesController.php?action='+action+'&medicine_id='+medicine_id, true);

            xhttp.send();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    let data = JSON.parse(this.responseText);
                    document.getElementById('current_image').src = data[0].image_url;
                    document.getElementById('medicine_title').value = data[0].medicine_title;
                    document.getElementById('description').value = data[0].description;

                    //showing category selected item
                    let category_id = document.getElementById('category_id');
                    for (let i = 0; i < category_id.options.length; i++) {
                        if (category_id.options[i].value == data[0].category_id) {
                            category_id.options[i].selected = true;
                            break; 
                        }
                    }

                    //showing company selected item
                    let company_id = document.getElementById('company_id');
                    for(let i = 0; i<company_id.options.length; i++){
                        if(company_id.options[i].value == data[0].company_id){
                            company_id.options[i].selected = true;
                            break;
                        }
                    }

                    //showing medicine price
                    document.getElementById('medicine_price').value = data[0].medicine_price;
                    //showing medicine quantiy
                    document.getElementById('medicine_quanity').value = data[0].medicine_quanity;

                    //showing manufacturing date
                    document.getElementById('manufacturing_date').value = data[0].manufacturing_date;
                    
                    //showing expire date
                    document.getElementById('expire_date').value = data[0].expire_date;

                }
            }


        }


        //update medicine data by ajax
        function updateMedicine(){
            event.preventDefault();
            let medicine_id = <?php echo $medicine_id; ?>;

            let image_url = document.getElementById('image_url').value;
            let medicine_title = document.getElementById('medicine_title').value;
            let description = document.getElementById('description').value;
            let category_id = document.getElementById('category_id').value;
            let company_id = document.getElementById('company_id').value;
            let medicine_price = document.getElementById('medicine_price').value;
            let medicine_quanity = document.getElementById('medicine_quanity').value;
            let manufacturing_date = document.getElementById('manufacturing_date').value;
            let expire_date = document.getElementById('expire_date').value;

            if(image_url === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must select an image!</p>';
            }else if(medicine_title === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must fill medicine title!</p>';
            }else if(description === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must fill medicine description!</p>';
            }else if(category_id === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must select medicine category!</p>';
            }else if(company_id === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must select medicine company!</p>';
            }else if(medicine_price === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must fill medicine price!</p>';
            }else if(medicine_quanity===''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must fill medicine quantity!</p>';
            }else if(manufacturing_date === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must provide manufacturing date!</p>';
            }else if(expire_date === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must fill expire date!</p>';
            }else{

                let formData = new FormData(document.getElementById('medicine_form'));

                formData.append('action', 'update_medicine');
                formData.append('medicine_id', <?php echo $medicine_id; ?>);

                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../controller/medicinesController.php', true);

                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('status_messages').innerHTML = this.responseText;
                        showData();

                    }
                }

                xhttp.send(formData);
                }



        }



    </script>
<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>