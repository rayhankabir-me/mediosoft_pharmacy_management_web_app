<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/medicineCompanyModel.php');
$action = $_REQUEST['action'];

//adding medicine company operations
if($action == 'add_company'){

    $error_message = '';

    $company_name = $_REQUEST['company_name'];
    $description = $_REQUEST['description'];
    $added_by = $_REQUEST['added_by'];


    if($company_name == ''){
        $error_message .= '<p id="error_message">you must fill company name!</p>';
    }
    if($description == ''){
        $error_message .= '<p id="error_message">you must fill category decription!</p>';
    }

    //data array
   $data = [
    'company_name' => $company_name,
    'description' => $description,
    'added_by' => $added_by,
    ];

     if($error_message === ''){

         $result = add_company($data);
     
         if($result === true){
             echo '<p id="success_message">Category created successfully!</p>';
         }elseif ($result === false) {
             echo '<p id="error_message">Category created failed... try again!</p>';
         }
         
    }else{
        echo $error_message;
    }
 
    
 }

 //show all company data
 if($action == 'get_company'){
    $companies = get_all_company_data();

    echo "<tr>";
    echo "<td>Company Name</td>";
    echo "<td>Short Description</td>";
    echo "<td>Action</td>";
    echo "</tr>";

    foreach ($companies as $company) {
        ?>
         <tr>
             <td><?php echo $company['company_name']; ?></td>
             <td><?php echo $company['description']; ?></td>
             <td><a class="edit-btn" href="../view/update_medicine_company.php?id=<?php echo $company['id']; ?>">Edit</a> | <a class="delete-btn" id="delete_btn" data-company-id="<?php echo $company['id']; ?>" onclick="deleteCompany(event)" href="#">Delete</a></td>
         </tr>
        <?php
     }
 }


 //delete operations
 if($action == 'delete_compnay'){
    $company_id = $_REQUEST['company_id'];
    $delete_category = delete_compnay($company_id);
    if($delete_category == true){
        echo '<p id="success_message">company deleted successfully!</p>';
    }elseif ($delete_category == false) {
        echo '<p id="error_message">company delete failed... try again!</p>';
    }

 }


 //current data in udpate field
if($action == 'current_data'){
    $company_id=  $_REQUEST['company_id'];
    $category_data = get_company_data($company_id);

    echo json_encode($category_data);
}




//update operations
if($action == 'update_company'){

    $error_message = '';

    $company_id = $_REQUEST['company_id'];
    $company_name = $_REQUEST['company_name'];
    $description = $_REQUEST['description'];
 
    if($company_name == ''){
        $error_message .= '<p id="error_message">you must fill company name...!</p>';
    }
    if($description == ''){
        $error_message .= '<p id="error_message">you must fill company description..!</p>';
    }
 
    //data array
    $data = [
     'company_name' => $company_name,
     'description' => $description,
 
     ];
 
     if($error_message === ''){
 
         $result = update_company($company_id, $data);
 
         if($result === true){
             echo '<p id="success_message">Company udated successfully!</p>';
         }elseif ($result === false) {
             echo '<p id="error_message">Company updatd failed... try again!</p>';
         }
         
     }else{
         echo $error_message;
         }

   

}



?>