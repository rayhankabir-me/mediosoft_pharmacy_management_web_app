<?php
include_once('../controller/functions.php');
require_once('../model/postCategoryModel.php');



$category_id = '';
if(isset($_GET['id'])){
    $category_id = $_GET['id'];
}

$delete_category = delete_category($category_id);
if($delete_category == true){
    $_SESSION['notify_status'] = 'Category Deleted Successfully!';
    header('location: all_category.php');
}elseif ($delete_category == false) {
    $_SESSION['notify_status'] = 'Category delete failed!';
}

?>