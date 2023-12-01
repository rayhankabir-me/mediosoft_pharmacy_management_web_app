<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/medicinesModel.php');


$action = $_REQUEST['action'];

if($action == 'add_medicine'){

    $error_message = '';
    $image_url = $_FILES['image_url'];
    $medicine_title = $_POST['medicine_title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $company_id = $_POST['company_id'];
    $medicine_price = $_POST['medicine_price'];
    $medicine_quanity = $_POST['medicine_quanity'];
    $manufacturing_date = $_POST['manufacturing_date'];
    $expire_date = $_POST['expire_date'];
    $added_by = $_POST['added_by'];

 
 
    if($image_url == ''){
        $error_message .= '<p id="error_message">you must select an image!</p>';
    }
    if($medicine_title == ''){
        $error_message .= '<p id="error_message">you must fill medicine title!</p>';
    }
    if($description == ''){
        $error_message .= '<p id="error_message">you must fill medicine description!</p>';
    }
    if($category_id == ''){
        $error_message .= '<p id="error_message">you must select a category!</p>';
    }
    if($company_id == ''){
        $error_message .= '<p id="error_message">you must select a company!</p>';
    }
    if($medicine_price == ''){
        $error_message .= '<p id="error_message">you must fill medicine price!</p>';
    }
    if($medicine_quanity == ''){
        $error_message .= '<p id="error_message">you must fill medicine quantity!</p>';
    }
    if($manufacturing_date == ''){
        $error_message .= '<p id="error_message">you must full manufacturing date!</p>';
    }
    if($expire_date == ''){
        $error_message .= '<p id="error_message">you must full expire date!</p>';
    }
 
    // file info
    $source = $image_url['tmp_name'];
    $destination = '../assets/image/medicines/'.$image_url['name'];
 
 
    //data array
    $data = [
     'image_url' => $destination,
     'medicine_title' => $medicine_title,
     'description' => $description,
     'category_id'   => $category_id,
     'company_id'   => $company_id,
     'medicine_price'   => $medicine_price,
     'medicine_quanity'   => $medicine_quanity,
     'added_by'       => $added_by,
     'manufacturing_date'   => $manufacturing_date,
     'expire_date'       => $expire_date,
 
     ];
 
     if($error_message === ''){
 
         $result = add_medicine($data);
     
         if($result === true){
             
             if (!file_exists($destination)) {
                 if(move_uploaded_file($source, $destination)){
                 }
             }
             echo '<p id="success_message">medicine added successfully!</p>';
         }elseif ($result === false) {
            echo '<p id="error_message">medicine added failed... try again!</p>';
         }
         
        }else{
            echo $error_message;
        }
}

//for get data action, show medicines by ajax
if($action == 'get_data'){

    //get all medicines data
    $medicines = get_all_medicines_data();
    echo "<tr>";
    echo "<td>Image</td>";
    echo "<td>Medicine Name</td>";
    echo "<td>Category</td>";
    echo "<td>Company</td>";
    echo "<td>Price</td>";
    echo "<td>Quantity</td>";
    echo "<td>Expire Date</td>";
    echo "<td>Added By</td>";
    echo "<td>Action</td>";
    echo "</tr>";

    foreach ($medicines as $medicine) {
        ?>
         <tr>
             <td><img width="100px" src="<?php echo $medicine['image_url']; ?>" alt=""></td>
             <td><?php echo $medicine['medicine_title']; ?></td>
             <td><?php echo $medicine['category_title']; ?></td>
             <td><?php echo $medicine['company_name']; ?></td>
             <td><?php echo $medicine['medicine_price']; ?></td>
             <td><?php echo $medicine['medicine_quanity']; ?></td>
             <td><?php echo $medicine['expire_date']; ?></td>
             <td><?php echo $medicine['full_name']; ?></td>
             <td><a href="../view/update_medicine.php?id=<?php echo $medicine['id']; ?>">Edit</a> | <a id="delete_btn" data-medicine-id="<?php echo $medicine['id']; ?>" onclick="deleteMedicine(event)" href="#">Delete</a></td>
         </tr>
        <?php
     }

 }

  //delete operations
  if($action == 'delete_medicine'){
    $medicine_id = $_REQUEST['medicine_id'];
    $delete_medicine = delete_medicine($medicine_id);
    if($delete_medicine == true){
        echo '<p id="success_message">medicine deleted successfully!</p>';
    }elseif ($delete_medicine == false) {
        echo '<p id="error_message">medicine delete failed... try again!</p>';
    }

 }








?>