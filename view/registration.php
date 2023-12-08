<?php
$page_title = "User Registration - MedioSoft";


?>

<!-- including header -->
<?php include_once('../view/component/frontend_header.php'); ?>

<section class="banner-section">
    <div class="container">
        <div class="banner-title">
            <h2>User Registration</h2>
        </div>
    </div>
</section>


<section class="main-section">
    <div class="container">
        <div class="form-container">

            <div class="medio-form">
                <form action="#" method="POST" id="registration_form" enctype="multipart/form-data" onsubmit="registerUser()">


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
                            <input type="radio" name="gender" value="male" id="male"><label for=""> Male</label>
                            <input type="radio" name="gender" value="female" id="female"><label for=""> Female</label>
                            <input type="radio" name="gender" value="other" id="other"><label for=""> Other</label>
                        </fieldset>
                    </div>

                    <fieldset>
                    <legend>Date of Birth</legend>
                    <input type="date" name="date_of_birth" id="date_of_birth">
                    </fieldset>




                    <input type="submit" value="Submit" name="submit">

                </form>
            </div>
            <div id="status_messages">
                
            </div>
        </div>
    </div>
</section>


<script>
        function registerUser() {
        event.preventDefault();

        let username = document.getElementById('username').value;
        let email = document.getElementById('email').value;
        let full_name = document.getElementById('full_name').value;
        let password = document.getElementById('password').value;
        let c_password = document.getElementById('c_password').value;

        //declaring gender
        let genders = document.getElementsByName('gender');
        let genderCheck = false;
        for (let i = 0; i < genders.length; i++) {
            if (genders[i].checked) {
                genderCheck = true;
                break;
            }
        }

        let date_of_birth = document.getElementById('date_of_birth').value;


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
        }else{
        let formData = new FormData(document.getElementById('registration_form'));

        formData.append('action', 'user_registration');

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