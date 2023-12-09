<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/postsModel.php');


$action = $_REQUEST['action'];

if($action == 'add_post'){

    $error_message = '';
    $image = $_FILES['image'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category']; //category or category_id
    $added_by = $_POST['added_by'];
    $date = $_POST['date'];
 
    if($image == ''){
        $error_message .= '<p id="error_message">You must select an image!</p>';
    }
    if($title == ''){
        $error_message .= '<p id="error_message">You must fill the the title!</p>';
    }
    if($description == ''){
        $error_message .= '<p id="error_message">You must fill a post description!</p>';
    }
    if($category == ''){
        $error_message .= '<p id="error_message">You must select a category!</p>';
    }
    if($added_by == ''){
        $error_message .= '<p id="error_message">You must select a category!</p>';
    }
    if($date == ''){
        $error_message .= '<p id="error_message">You must fill the date!</p>';
    }
    
    // file info
    $source = $image['tmp_name'];
    $destination = '../assets/image/posts/'.$image['name'];
 
    //data array
    $data = [
     'image' => $destination,
     'title' => $title,
     'description' => $description,
     'category' => $category,
     'added_by' => $added_by,
     'date'   => $date,
    
     ];
 
     if($error_message === ''){
 
         $result = add_post($data);
     
         if($result === true){
             
             if (!file_exists($destination)) {
                 if(move_uploaded_file($source, $destination)){
                 }
             }
             echo '<p id="success_message">Post added successfully!</p>';
         }elseif ($result === false) {
            echo '<p id="error_message">Post addition failed... try again!</p>';
         }
         
        }else{
            echo $error_message;
        }
}

//for get data action, show post by ajax
if($action == 'get_data'){

    //get all posts data
    $posts = get_all_posts_data();

    // echo "<pre>";
    // echo print_r($posts);
    // echo "<pre>";

    // echo var_dump($posts[0]['image']);

    echo "<tr>";
    echo "<td>Image</td>";
    echo "<td>Title</td>";
    echo "<td>Description</td>";
    echo "<td>Category</td>";
    echo "<td>Added By</td>";
    echo "<td>Date</td>";
    echo "<td>Action</td>";
    echo "</tr>";

    foreach ($posts as $post) {
        ?>
         <tr>
             <td><img width="100px" src="<?php echo $post['image']; ?>" alt=""></td>
             <td><?php echo $post['title']; ?></td>
             <td><?php echo $post['description']; ?></td> 
             <td><?php echo $post['category_name']; ?></td>
             <td><?php echo $post['full_name']; ?></td>
             <td><?php echo $post['date']; ?></td>

             <td><a class="edit-btn" href="../view/update_post.php?id=<?php echo $post['id']; ?>">Edit</a> | <a class="delete-btn" id="delete_btn" data-post-id="<?php echo $post['id']; ?>" onclick="deletePost(event)" href="#">Delete</a></td>
         </tr>
        <?php
     }

 
 }

 //categrory title or category or category id? line 94

  //delete operations
  if($action == 'delete_post'){
    $post_id = $_REQUEST['post_id'];
    $delete_post = delete_post($post_id);
    if($delete_post == true){
        echo '<p id="success_message">Post has been deleted successfully!</p>';
    }elseif ($delete_post == false) {
        echo '<p id="error_message">Post deletion failed... try again!</p>';
    }
 }

  //current data in udpate field
if($action == 'current_data'){
    $post_id=  $_REQUEST['post_id'];
    $post_data = get_post_data($post_id);


    echo json_encode($post_data);
}

//update post operations using ajax

if($action == 'update_post'){

    $post_id = $_REQUEST['post_id'];

    $error_message = '';
    $image = $_FILES['image'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $date = $_POST['date'];
 
    if($image == ''){
        $error_message .= '<p id="error_message">You must select an image!</p>';
    }
    if($title == ''){
        $error_message .= '<p id="error_message">You must fill the Post title!</p>';
    }
    if($description == ''){
        $error_message .= '<p id="error_message">You must fill the description!</p>';
    }
    if($category == ''){
        $error_message .= '<p id="error_message">You must select a category!</p>';
    }
    if($date == ''){
        $error_message .= '<p id="error_message">You must fill the date!</p>';
    }
 
    // file info
    $source = $image['tmp_name'];
    $destination = '../assets/image/posts/'.$image['name'];
  
    //data array
    $data = [
     'image' => $destination,
     'title' => $title,
     'description' => $description,
     'category' => $category,
     'date' => $date,
 
     ];
 
     if($error_message === ''){
 
         $result = update_post($post_id, $data);
     
         if($result === true){
             
             if (!file_exists($destination)) {
                 if(move_uploaded_file($source, $destination)){
                 }
             }
             echo '<p id="success_message">Post has been udpated successfully!</p>';
         }elseif ($result === false) {
            echo '<p id="error_message">Failed to update the post... Please try again!</p>';
         }
         
        }else{
            echo $error_message;
        }
}





?>