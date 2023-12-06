<?php
//auth

require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/requestModel.php');


$action = $_REQUEST['action'];

if($action == 'make_request'){

    $error_message = '';
    $medicine_name = $_POST['medicine_name'];
    $medicine_category = $_POST['medicine_category'];
    $company_name = $_POST['company_name'];
    $medicine_country = $_POST['medicine_country'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

 
 
    if($medicine_name == ''){
        $error_message .= '<p id="error_message">you must enter medicine name!</p>';
    }else if($medicine_category == ''){
        $error_message .= '<p id="error_message">you must enter medicine category!</p>';
    }else if($company_name == ''){
        $error_message .= '<p id="error_message">you must enter medicine company!</p>';
    }else if($medicine_country == ''){
        $error_message .= '<p id="error_message">you must enter medicine country!</p>';
    }else if($name == ''){
        $error_message .= '<p id="error_message">you must enter your name!</p>';
    }else if($email == ''){
        $error_message .= '<p id="error_message">you must enter your email!</p>';
    } 

 
 
    //data array
    $data = [
     'medicine_name' => $medicine_name,
     'medicine_category' => $medicine_category,
     'company_name' => $company_name,
     'medicine_country'   => $medicine_country,
     'name'   => $name,
     'email'   => $email,
     'message'   => $message,
 
     ];
 
     if($error_message === ''){
 
         $result = add_request($data);
     
         if($result === true){
             echo '<p id="success_message">thanks for submitting request, medicines from abroad usually takes time...you will inform you via email when it will be available!</p>';
         }elseif ($result === false) {
            echo '<p id="error_message">request submission failed... try again later!</p>';
         }
         
        }else{
            echo $error_message;
        }
}

//for get data action, show request by ajax
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
    echo "<td>Added By</td>";
    echo "<td>Action</td>";
    echo "</tr>";

    foreach ($medicines as $medicine) {
        ?>
         <tr>
             <td><img width="80px" src="<?php echo $medicine['image_url']; ?>" alt=""></td>
             <td><?php echo $medicine['medicine_title']; ?></td>
             <td><?php echo $medicine['category_title']; ?></td>
             <td><?php echo $medicine['company_name']; ?></td>
             <td><?php echo $medicine['medicine_price']; ?></td>
             <td><?php echo $medicine['medicine_quanity']; ?></td>
             <td><?php echo $medicine['full_name']; ?></td>
             <td><a class="edit-btn" href="../view/update_medicine.php?id=<?php echo $medicine['id']; ?>">Edit</a> | <a class="delete-btn" id="delete_btn" data-medicine-id="<?php echo $medicine['id']; ?>" onclick="deleteMedicine(event)" href="#">Delete</a></td>
         </tr>
        <?php
     }

 }