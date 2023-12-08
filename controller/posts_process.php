<?php


require_once('../model/postsModel.php');
require_once('../model/usersModel.php');
$action = $_REQUEST['action'];


//for get data action, show posts by ajax
 if($action == 'get_data'){

    //get all posts data
    $posts = get_all_posts_data();
    foreach($posts as $post){
                            
        ?>

        <div class="medicine_box column-thirty-three">
            <div class="medicine-content">
                <a href="single_posts.php?id=<?php echo $post['id']; ?>"><img width="200px" src="<?php echo $post['image']; ?>" alt=""></a>
                <div class="medicine-description">
                    <h2><a href="single_posts.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
                    
                    <p>Category: <strong><?php echo $post['category_name']; ?></strong></p>   
                    <a class="medio-btn" href="single_posts.php?id=<?php echo $post['id']; ?>">Details</a>
                </div>

            </div>
        </div>



        <?php
    }

 }

//for get data action, show posts by ajax
 if($action == 'get_data_for_homepage'){

    //get all posts data
    $posts = get_all_posts_data();
    foreach($posts as $post){
                            
        ?>

        <div class="medicine_box column-twenty-five">
            <div class="medicine-content">
                <a href="single_posts.php?id=<?php echo $post['id']; ?>"><img width="200px" src="<?php echo $post['image']; ?>" alt=""></a>
                <div class="medicine-description">
                    <h2><a href="single_posts.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
                    
                    <p>Category: <strong><?php echo $post['category_name']; ?></strong></p>   
                    <a class="medio-btn" href="single_posts.php?id=<?php echo $post['id']; ?>">Details</a>
                </div>

            </div>
        </div>



        <?php
    }

 }

 //start
 //for search post action, search post by ajax
 if($action == 'search_post'){

    $post_name = $_REQUEST['post_name'];
    //get all posts data by post name
    $posts = get_post_data_by_name($post_name);

    if(isset($posts['no_item'])){
        echo "<p>".$posts['no_item']."</p>";
    }else{
        foreach($posts as $post){
                            
            ?>
            <div class="medicine_box column-thirty-three">
                <div class="medicine-content">
                    <a href="single_posts.php?id=<?php echo $post['id']; ?>"><img width="200px" src="<?php echo $post['image']; ?>" alt=""></a>
                    <div class="medicine-description">
                        <h2><a href="single_posts.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
                        
                        <p>Category: <strong><?php echo $post['category_name']; ?></strong></p>   
                        <a class="medio-btn" href="single_posts.php?id=<?php echo $post['id']; ?>">Details</a>
                    </div>
    
                </div>
            </div>

                

            <?php
        }
    }
 }

// to be contd...

 //filter by medicine category
 if($action == "post_filter"){

    $category = $_REQUEST['category'];

    //get all medicines data by category id
    $posts = get_post_data_by_category($category);

    if(isset($posts['no_item'])){
        echo "<p>".$posts['no_item']."</p>";
    }else{
        foreach($posts as $post){
                            
            ?>
            <div class="medicine_box column-thirty-three">
                <div class="medicine-content">
                    <a href="single_posts.php?id=<?php echo $post['id']; ?>"><img width="200px" src="<?php echo $post['image']; ?>" alt=""></a>
                    <div class="medicine-description">
                        <h2><a href="single_posts.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
                        
                        <p>Category: <strong><?php echo $post['category_name']; ?></strong></p>   
                        <a class="medio-btn" href="single_posts.php?id=<?php echo $post['id']; ?>">Details</a>
                    </div>
    
                </div>
            </div>


            <?php
        }
    }
 }


?>
