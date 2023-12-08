<?php
$page_title = "Add User - MedioSoft";
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
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
                                    <h3>Add User</h3>
                                </div>

                                <div class="medio-form">
                                    <form id="user_form" action="#" method="POST" enctype="multipart/form-data" onsubmit="addUser()">
                                        <label for="username">User Name: </label>
                                        <input type="text" name="username" id="username">

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

                                        <select name="user_type" id="user_type">
                                            <option value="Customer">Customer</option>
                                            <option value="Pharmacist">Pharmacist</option>
                                            <option value="Admin">Admin</option>
                                        </select>

                                        <input type="submit" value="Submit" name="submit">
                                        <input type="submit" value="Reset" name="reset">
                                    </form>

                                </div>
                                <div id="status_messages"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    

    <script>
    function addUser() {
        event.preventDefault();

        let username = document.getElementById('username').value;
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

        if(username === ''){
            document.getElementById('status_messages').innerHTML = '<p id="error_message">You must enter user name!</p>';
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
        formData.append('action', 'add_user');

        let xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../controller/userController.php', true);

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