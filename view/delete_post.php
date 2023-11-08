<?php
include_once('../controller/functions.php');
require_once('../model/postsModel.php');



$post_id = '';
if(isset($_GET['id'])){
    $post_id = $_GET['id'];
}

$delete_post = delete_post($post_id);
if($delete_post == true){
    $_SESSION['notify_status'] = 'Post Deleted Successfully!';
    header('location: all_posts.php');
}elseif ($delete_post == false) {
    $_SESSION['notify_status'] = 'Post delete failed!';
}

?>