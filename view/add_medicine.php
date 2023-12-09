<?php
$page_title = "Add Medicine";
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/usersModel.php');
require_once('../model/medicineCategoryModel.php');
require_once('../model/medicineCompanyModel.php');
$get_current_user_info = get_current_user_info();
//get current user id
$user_id = get_current_user_id();

//get all medicine category data
$catgories = get_all_medicine_category_data();

//get all medicine company data
$companies = get_all_medicine_company_data();


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
                                    <h3>Add Medicine</h3>
                                </div>

                                <div class="medio-form">
                                    <form id="medicine_form" action="#" method="POST" enctype="multipart/form-data" onsubmit="addMedicine()">

                                        <label for="">Upload Medicine Image</label>
                                        <input type="file" name="image_url" id="image_url">
                                        <label for="">Medicine Name </label>
                                        <input type="text" name="medicine_title" id="medicine_title">

                                        <label for="">Description </label>

                                        <textarea name="description" id="description" cols="30" rows="10"></textarea>

                                        <label for="">Select Category</label>

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

                                        <label for="">Medicine Price</label>

                                        <input type="text" name="medicine_price" id="medicine_price">
                                        <label for="">Medicine Quantity</label>

                                        <input type="number" name="medicine_quanity" id="medicine_quanity">

                                        <label for="">Manufacturing Data</label>

                                        <input type="date" name="manufacturing_date" id="manufacturing_date">

                                        <label for="">Expire Date</label>

                                        <input type="date" name="expire_date" id="expire_date">


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
    function addMedicine() {
        event.preventDefault();

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
        formData.append('added_by', <?php echo $user_id; ?>);
        formData.append('action', 'add_medicine');

        let xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../controller/medicinesController.php', true);

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('status_messages').innerHTML = this.responseText;
       
            }
        }

        xhttp.send(formData);
        }


    }
</script>


<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>