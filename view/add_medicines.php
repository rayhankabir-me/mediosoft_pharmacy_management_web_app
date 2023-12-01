<?php
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


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Medicine</title>
</head>
<body>

    <table border="1" width="100%">
    <tr>
        <td><a href="index.php"><h2>MedioSoft</h2></a></td>
        <td colspan="2">
            Welcome back! <strong><?php echo $get_current_user_info['full_name']; ?></strong>
             | Notifications 
             | <a href="../index.php">Visit Site</a>  
             | <a href="../controller/logout.php">Logout</a>
        </td>
    </tr>

    <tr>
        <td>
        <?php echo get_sidebar();?>
        </td>
        <td colspan="2">
            <br>
            <br>
                <h3>Add Medicine</h3>
                <form id="medicine_form" action="#" method="POST" enctype="multipart/form-data" onsubmit="addMedicine()">

                <label for="">Upload Medicine Image</label><br>
                <input type="file" name="image_url" id="image_url"><br>
                <label for="">Medicine Name </label><br>
                <input type="text" name="medicine_title" id="medicine_title">
                <br>
                <label for="">Description </label>
                <br>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>
                <br>
                <label for="">Select Category</label>
                <br>
                <select name="category_id" id="category_id">
                    <?php
                        foreach($catgories as $category){
                            
                            ?>
                                <option value="<?php echo $category['id']; ?>"><?php echo $category['category_title']; ?></option>
                            <?php
                        }
                    ?>
                </select>
                <br>
                <label for="">Select Company</label>
                <br>
                <select name="company_id" id="company_id">
                <?php
                        foreach($companies as $company){
                            
                            ?>
                                <option value="<?php echo $company['id']; ?>"><?php echo $company['company_name']; ?></option>
                            <?php
                        }
                    ?>
                </select>
                <br>
                <label for="">Medicine Price</label>
                <br>
                <input type="text" name="medicine_price" id="medicine_price"><br>
                <label for="">Medicine Quantity</label>
                <br>
                <input type="number" name="medicine_quanity" id="medicine_quanity">
                <br>
                <label for="">Manufacturing Data</label>
                <br>
                <input type="date" name="manufacturing_date" id="manufacturing_date">
                <br>
                <label for="">Expire Date</label>
                <br>
                <input type="date" name="expire_date" id="expire_date">
                <br>

                <input type="submit" value="Submit" name="submit">
                <input type="submit" value="Reset" name="reset">
                </form>

                <div id="status_messages"></div>
            <br>
            <br>

        </td>
    </tr>
    <tr>
        <td colspan="3">Copyright &copy; 2023 MedioSoft. All rights are reserved.</td>
    </tr>

    </table>
    

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
                document.getElementById('medicine_form').reset();
            }
        }

        xhttp.send(formData);
        }


    }
</script>


</body>
</html>