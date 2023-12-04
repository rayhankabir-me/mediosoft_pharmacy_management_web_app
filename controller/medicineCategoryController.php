<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/medicineCategoryModel.php');
$action = $_REQUEST['action'];

//adding medicine category crud
if($action == 'add_category'){

    $error_message = '';

    $category_title = $_REQUEST['category_title'];
    $description = $_REQUEST['description'];
    $added_by = $_REQUEST['added_by'];


    if($category_title == ''){
        $error_message .= '<p id="error_message">you must fill category name!</p>';
    }
    if($description == ''){
        $error_message .= '<p id="error_message">you must fill category decription!</p>';
    }

    //data array
   $data = [
    'category_title' => $category_title,
    'description' => $description,
    'added_by' => $added_by,
    ];

     if($error_message === ''){

         $result = add_category($data);
     
         if($result === true){
             echo '<p id="success_message">Category created successfully!</p>';
         }elseif ($result === false) {
             echo '<p id="error_message">Category created failed... try again!</p>';
         }
         
    }else{
        echo $error_message;
    }
 
    
 }

 //show all category operations
 if($action == 'get_category'){
    $categories = get_all_category_data();

    echo "<tr>";
    echo "<td>Category Name</td>";
    echo "<td>Short Description</td>";
    echo "<td>Action</td>";
    echo "</tr>";

    foreach ($categories as $category) {
        ?>
         <tr>
             <td><?php echo $category['category_title']; ?></td>
             <td><?php echo $category['description']; ?></td>
             <td><a class="edit-btn" href="../view/update_medicine_category.php?id=<?php echo $category['id']; ?>">Edit</a> | <a class="delete-btn" id="delete_btn" data-category-id="<?php echo $category['id']; ?>" onclick="deleteCategory(event)" href="#">Delete</a></td>
         </tr>
        <?php
     }
 }


 //delete operations
 if($action == 'delete_category'){
    $category_id = $_REQUEST['category_id'];
    $delete_category = delete_category($category_id);
    if($delete_category == true){
        echo '<p id="success_message">category deleted successfully!</p>';
    }elseif ($delete_category == false) {
        echo '<p id="error_message">category delete failed... try again!</p>';
    }

 }


 //current data in udpate field
if($action == 'current_data'){
    $category_id=  $_REQUEST['category_id'];
    $category_data = get_category_data($category_id);

    echo json_encode($category_data);
}




//update operations
if($action == 'update_category'){

    $error_message = '';

    $category_id = $_REQUEST['category_id'];
    $category_title = $_REQUEST['category_title'];
    $description = $_REQUEST['description'];
 
    if($category_title == ''){
        $error_message .= '<p id="error_message">you must fill category title...!</p>';
    }
    if($description == ''){
        $error_message .= '<p id="error_message">you must fill category description..!</p>';
    }
 
    //data array
    $data = [
     'category_title' => $category_title,
     'description' => $description,
 
     ];
 
     if($error_message === ''){
 
         $result = update_category($category_id, $data);
 
         if($result === true){
             echo '<p id="success_message">Category udated successfully!</p>';
         }elseif ($result === false) {
             echo '<p id="error_message">Category updatd failed... try again!</p>';
         }
         
     }else{
         echo $error_message;
         }

   

}



?>