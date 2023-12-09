<?php
$page_title = "Request for Medicine - MedioSoft";
include_once('../view/component/dashboard_sidebar.php');




?>

<!-- including header -->
<?php include_once('../view/component/frontend_header.php'); ?>

<section class="banner-section">
    <div class="container">
        <div class="banner-title">
            <h2>Request for Medicine</h2>
        </div>
    </div>
</section>
<section class="main-section">
    <div class="container">
        <div class="form-container">

            <div class="medio-form">
                <form action="#" method="post" onsubmit="makeRequest()">
                    <label for="">Medicine Name</label>
                    <input type="text" name="medicine_name" id="medicine_name">
                    <label for="">Which Category (eg. Capsule, Tablet, Injection)</label>
                    <input type="text" name="medicine_category" id="medicine_category">
                    <label for="">Which Company (eg. ACI, Chemist, Biopharma)</label>
                    <input type="text" name="company_name" id="company_name">
                    <label for="">Of Which Country</label>
                    <select name="medicine_country" id="medicine_country">
                        <option value="bangladeshi">Bangladeshi</option>
                        <option value="other">Other Country</option>
                    </select>
                    <label for="name">Your Name</label>
                    <input type="text" name="name" id="name">
                    <label for="email">Enter Your Email</label>
                    <input type="email" name="email" id="email">
                    <label for="">Message (Optional)</label>

                    <textarea name="message" id="message" cols="20" rows="10"></textarea>

                    <input type="submit" value="Request">
                    
                    <div id="status_messages"></div>
                </form>
            </div>
            <div id="status_messages"></div>
        </div>
    </div>
</section>



    <!-- javascript validation -->
    <script>
        function makeRequest(){
            event.preventDefault();
            let medicine_name = document.getElementById('medicine_name').value;
            let medicine_category = document.getElementById('medicine_category').value;
            let company_name = document.getElementById('company_name').value;
            let medicine_country = document.getElementById('medicine_country').value;
            let name = document.getElementById('name').value;
            let email = document.getElementById('email').value;
            let message = document.getElementById('message').value;

            if(medicine_name === ""){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must enter medicine name!</p>';
            }else if(medicine_category === ""){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must enter medicine category!</p>';
            }else if(company_name === ""){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must enter company name!</p>';
            }else if(medicine_country === ""){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must select medicine country!</p>';
            }else if(name === ""){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must enter your name!</p>';
            }
            else if(email === ""){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must enter your email!</p>';
            }else{

                let action = 'make_request';
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../controller/requestController.php', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('action=' + action + '&medicine_name='+medicine_name + '&medicine_category='+medicine_category + '&company_name='+company_name + '&medicine_country='+medicine_country + '&name='+name + '&email='+email + '&message='+message);
                xhttp.onreadystatechange = function(){

                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('status_messages').innerHTML = this.responseText;
                        document.getElementById('medicine_name').value = '';
                        document.getElementById('medicine_category').value = '';
                        document.getElementById('company_name').value = '';
                        document.getElementById('name').value = '';
                        document.getElementById('email').value = '';
                        document.getElementById('message').value = '';
                    }
                }
            }
        }
        



    </script>
    
<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>