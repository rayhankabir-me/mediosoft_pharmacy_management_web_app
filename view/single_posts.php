<?php

require_once('../model/postsModel.php');

if(isset($_GET['id'])){
    $post_id = $_GET['id'];
}

$posts = get_all_posts_data_by($post_id);

$page_title = $posts[0]['title']." - MedioSoft";



?>

<!-- including header -->
<?php include_once('../view/component/frontend_header.php'); ?>

<section class="banner-section">
    <div class="container">
        <div class="banner-title">
            <h2><?php echo $posts[0]['title'];?></h2>
        </div>
    </div>
</section>


<section class="main-section">
    <div class="container">
        <div class="row">
            <div class="column-fifty">
                <div class="medicine-img-desc">
                    <img src="<?php echo $posts[0]['image'];?>" alt="">
                    <div class="medicine-desc">
                        <p><strong>Post Description: </strong><?php echo $posts[0]['description']; ?></p>
                    </div>
                    <div class="medicine-extra-info">
                        <p>Category: <strong><?php echo $posts[0]['category_name']; ?></strong></p>
                        <p>Post Date: <strong><?php echo $posts[0]['date']; ?></strong></p>
                        <p>Post Author: <strong><?php echo $posts[0]['full_name']; ?></strong></p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>

