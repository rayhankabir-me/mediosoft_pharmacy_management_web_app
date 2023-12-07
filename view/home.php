<?php
$page_title = 'Home - MedioSoft Pharmacy';

//requiring pages opitons
require_once('../model/pagesoptionsModel.php');
$all_data = get_all_current_data();
?>
<!-- including header -->
<?php include_once('../view/component/frontend_header.php'); ?>



<section class="banner_section">
    <div class="container">
        <div class="row">
            <div class="column-fifty display-flex align-items-center">
                <div class="banner-info">
                    <h2><?php echo $all_data[0]['banner_title'];?></h2>
                    <p><?php echo $all_data[0]['banner_description'];?></p>
                    <a class="medio-btn" href="<?php echo $all_data[0]['button_url'];?>"><?php echo $all_data[0]['btn_text'];?></a>
                </div>
            </div>
            <div class="column-fifty">
                <div class="banner-img">
                    <img src="../assets/image/medicine-banner.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="medicines_loop">
    <div class="container">
        <h1>Our Latest Medicine</h1>
        <!-- all medicines box -->
        <div class="row" id="all_medicines_box">
    </div>
</section>

<!-- showing posts -->
<section class="medicines_loop">
    <div class="container">
        <h1>Our Latest Posts</h1>
        <!-- all posts box -->
        <div class="row" id="all_posts_box">
    </div>
</section>

<script>
        showMedicines();
            //fetching medicines data using ajax
            function showMedicines(){

                let action = 'get_data_for_homepage';
                let xhttp = new XMLHttpRequest();
                xhttp.open('GET', '../controller/medicines_process.php?action='+action, true);

                xhttp.send();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('all_medicines_box').innerHTML = this.responseText;
                    }
                }

            }


            //showing posts
            showPosts();
            //fetching posts data using ajax
            function showPosts(){

                let action = 'get_data_for_homepage';
                let xhttp = new XMLHttpRequest();
                xhttp.open('GET', '../controller/posts_process.php?action='+action, true);

                xhttp.send();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('all_posts_box').innerHTML = this.responseText;
                    }
                }

            }
</script>


<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>