<?php
$page_title = "Blog - MedioSoft";
//requring files
require_once('../model/postsModel.php');
require_once('../model/postCategoryModel.php');
$posts = get_all_posts_data();
$post_category_data = get_all_category_data();

?>


<!-- including header -->
<?php include_once('../view/component/frontend_header.php'); ?>


<section class="banner-section">
    <div class="container">
        <div class="banner-title">
            <h2>Blog</h2>
        </div>
    </div>
</section>

<div class="main-section">
                <div class="container">
                    <div class="row">
                        <div class="column-twenty-five">
                            <div class="medicine-sidebar">
                                <!-- search medincine -->
                                <div class="form-title">
                                    <h3>Search Post</h3>
                                </div>
                                <div class="medio-form">
                                <form action="#" method="GET" onsubmit="searchPost()">
                                    <input type="text" name="post_name" id="post_name" placeholder="Post Name">
                                    <input type="submit" value="Search Post">
                                    <div id="status_messages"></div>
                                </form>
                                </div>


                                <!-- filter by category -->
                                <div class="form-title">
                                    <h3>Filter By Category</h3>
                                </div>
                                <div class="medio-form">
                                    <form action="#" method="GET" onsubmit="filterByCategory()">
                                        <select name="post_category" id="post_category">
                                            <?php 
                                            foreach($post_category_data as $data){
                                                ?>
                                                    <option value="<?php echo $data['id']; ?>"><?php echo $data['category_name']; ?></option>
                                                <?php
                                            }
                                            ?>

                                        </select>
                                        <input type="submit" value="Filter">

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="column-seventy-seven">
                            <!-- all posts box -->
                            <div class="row" id="all_posts_box">

                            </div>
                        </div>
                    </div>
                </div>
    </div>






    <script>

            showPosts();
            //fetching posts data using ajax
            function showPosts(){

                let action = 'get_data';
                let xhttp = new XMLHttpRequest();
                xhttp.open('GET', '../controller/posts_process.php?action='+action, true);

                xhttp.send();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('all_posts_box').innerHTML = this.responseText;
                    }
                }

            }

            //search posts
            function searchPost(){
                event.preventDefault();
                let action = 'search_post';
                let post_name = document.getElementById('post_name').value;
                if(post_name == ""){
                    document.getElementById('status_messages').innerHTML = '<p id="error_message">you must type something...!</p>';
                }else{
                let xhttp = new XMLHttpRequest();
                xhttp.open('GET', '../controller/posts_process.php?action='+action+'&post_name='+post_name, true);
                xhttp.send();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('all_posts_box').innerHTML = this.responseText;
                        document.getElementById('status_messages').innerHTML = '';
                    }
                }
                }
            }
            
            //this sec
            //filter post by category
            function filterByCategory(){

                event.preventDefault();
                let action = 'post_filter';
                let category = document.getElementById('post_category').value;
                category = parseInt(category);
                let xhttp = new XMLHttpRequest();
                xhttp.open('GET', '../controller/posts_process.php?action='+action + '&category='+category, true);
                xhttp.send();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('all_posts_box').innerHTML = this.responseText;
                        document.getElementById('status_messages').innerHTML = '';
                    }
                }

            }

    </script>
    
<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>
