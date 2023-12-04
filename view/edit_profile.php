<?php
$page_title = "Edit Profile";
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');

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
                            <div class="form-container">
                                <div class="existing-photo">
                                    <h3>Profile Photo</h3>
                                    <img id="current_image" width="200px" src="" alt="">
                                </div>

                                <div class="medio-form">
                                    <form action="#" method="post" onsubmit="udpateUser(event)" id="user_form">
                                        <label for="profile_photo">Upload New Photo</label>
                                        <input type="file" name="profile_photo" id="profile_photo">
                                        <label for="email">Email: </label>
                                        <input type="email" name="email" id="email" value="">
                                        <label for="full_name">Full Name: </label>
                                        <input type="text" name="full_name" id="full_name" value="">

                                        <fieldset>
                                        <legend>Gender</legend>
                                            <div class="checkbox-container">
                                                <input type="radio" name="gender" value="male" id="male"><label for=""> Male</label>
                                                <input type="radio" name="gender" value="female" id="female"><label for=""> Female</label>
                                                <input type="radio" name="gender" value="other" id="other"><label for=""> Other</label>
                                            </div>
                                        </fieldset>

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
                    </div>
                </div>
            </div>


<script>
        showData();
        //fetch current data using ajax
        function showData(){
            let user_id = <?php echo $get_current_user_info['id'];?>;
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
        function udpateUser(event){
            event.preventDefault();
            let user_id = <?php echo $get_current_user_info['id'];?>;

            let profile_photo = document.getElementById('profile_photo').value;
            let email = document.getElementById('email').value;
            let full_name = document.getElementById('full_name').value;
            let date_of_birth = document.getElementById('date_of_birth').value;



            if(profile_photo === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must select an image!</p>';
            }else if(email === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must fill email!</p>';
            }else if(full_name === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must fill your full name!</p>';
            }else if(date_of_birth === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must fill data of birth!</p>';
            }else{

                // let formData = new FormData(document.getElementById('user_form'));

                // formData.append('action', 'update_user');
                // formData.append('user_id', );

                let formData = new FormData();

                formData.append('profile_photo', document.getElementById('profile_photo').files[0]);
                formData.append('email', document.getElementById('email').value);
                formData.append('full_name', document.getElementById('full_name').value);
                formData.append('gender', document.querySelector('input[name="gender"]:checked').value);
                formData.append('date_of_birth', document.getElementById('date_of_birth').value);
                formData.append('action', 'update_user');
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