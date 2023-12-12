<?php
$page_title = "Update User - MedioSoft";
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');

$get_current_user_info = get_current_user_info();

if(isset($_REQUEST['id'])){
    $user_id = $_REQUEST['id'];
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
                                    <h3>Profile Photo</h3>
                                    <img id="current_image" width="200px" src="" alt="">
                                </div>

                                <div class="medio-form">
                                    <form id="user_form" action="#" method="POST" enctype="multipart/form-data" onsubmit="updateUser(event)">
                                        <label for="profile_photo">Upload New Photo</label>
                                        <input type="file" name="profile_photo" id="profile_photo">

                                        <label for="email">Email: </label>
                                        <input type="email" name="email" id="email">

                                        <label for="full_name">Full Name: </label>
                                        <input type="text" name="full_name" id="full_name">

                                        <label for="password">Password: </label>
                                        <input type="password" name="password" id="password">

                                        <label for="c_password">Confirm Password: </label>
                                        <input type="password" name="c_password" id="c_password">

                                        <div class="checkbox-container">
                                            <fieldset>
                                            <legend>Gender</legend>
                                                <input type="radio" name="gender" value="male" id=""><label for=""> Male</label>
                                                <input type="radio" name="gender" value="female" id=""><label for=""> Female</label>
                                                <input type="radio" name="gender" value="other" id=""><label for=""> Other</label>
                                            </fieldset>
                                        </div>

                                        <fieldset>
                                        <legend>Date of Birth</legend>
                                        <input type="date" name="date_of_birth" id="date_of_birth">
                                        </fieldset>
                                        <label for="user_type">User Type</label>
                                        <select name="user_type" id="user_type">
                                            <option value="Customer">Customer</option>
                                            <option value="Pharmacist">Pharmacist</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                        <label for="user_status">User Status</label>
                                        <select name="user_status" id="user_status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>

                                        <input type="submit" value="Submit" name="submit">
                                    </form>
                                </div>
                                <div id="status_messages">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<script>
        showData();
        //fetch current data using ajax
        function showData(){
            let user_id = <?php echo $user_id;?>;
            let action = 'current_data';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/userController.php?action='+action+'&user_id='+user_id, true);

            xhttp.send();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    
                    let data = JSON.parse(this.responseText);

                    document.getElementById('current_image').src = data.profile_photo;

                    document.getElementById('email').value = data.email;
                    document.getElementById('full_name').value = data.full_name;
                    document.getElementById('date_of_birth').value = data.date_of_birth;
                    document.getElementById('user_type').value = data.user_type;
                    document.getElementById('user_status').value = data.user_status;

                    let gender = document.getElementsByName('gender');
                    //showing the radio button
                    for (var i = 0; i < gender.length; i++) {
                        if (gender[i].value == data.gender) {
                            gender[i].checked = true;
                            break; 
                        }
                    }
                }
            }

        }



        //update user data by ajax
        function updateUser(event){
            event.preventDefault();
            let user_id = <?php echo $user_id;?>;

            let profile_photo = document.getElementById('profile_photo').value;

            let email = document.getElementById('email').value;
            let full_name = document.getElementById('full_name').value;
            let password = document.getElementById('password').value;
            let c_password = document.getElementById('c_password').value;

            let date_of_birth = document.getElementById('date_of_birth').value;
            let user_type = document.getElementById('user_type').value;

            //declaring gender
            let genders = document.getElementsByName('gender');
            let genderCheck = false;
            for (let i = 0; i < genders.length; i++) {
                if (genders[i].checked) {
                    genderCheck = true;
                    break;
                }
            }
            if(profile_photo == ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must upload new photo!</p>';
            }else if(email === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must enter an email!</p>';
            }else if(full_name === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must enter full name!</p>';
            }else if(password === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must enter password!</p>';
            }else if(c_password === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must enter confirm password!</p>';
            }else if(password != c_password){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">password and confirm password do not match!</p>';
            }else if(!genderCheck){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must enter gender!</p>';
            }else if(date_of_birth===''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must enter data of birth!</p>';
            }else if(user_type === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must enter user typee!</p>';
            }else{

                let formData = new FormData(document.getElementById('user_form'));

                formData.append('action', 'edit_user');
                formData.append('user_id', user_id);

                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../controller/userController.php', true);




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