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
if($action == 'get_request'){

    //get all requests data
    $requests = get_all_requests();
    echo "<tr>";
    echo "<td>Medicine Name</td>";
    echo "<td>Category Name</td>";
    echo "<td>Company Name</td>";
    echo "<td>Medicine Country</td>";
    echo "<td>Name</td>";
    echo "<td>Email</td>";
    echo "<td>Message</td>";
    echo "<td>Action</td>";
    echo "</tr>";

    foreach ($requests as $request) {
        ?>
         <tr>
             <td><?php echo $request['medicine_name']; ?></td>
             <td><?php echo $request['medicine_category']; ?></td>
             <td><?php echo $request['company_name']; ?></td>
             <td><?php echo $request['medicine_country']; ?></td>
             <td><?php echo $request['name']; ?></td>
             <td><?php echo $request['email']; ?></td>
             <td><?php echo $request['message']; ?></td>
             <td><a class="delete-btn" id="delete_btn" data-request-id="<?php echo $request['id']; ?>" onclick="deleteRequest(event)" href="#">Delete</a></td>
         </tr>
        <?php
     }

 }


  //delete operations
  if($action == 'delete_request'){
    $request_id = $_REQUEST['request_id'];
    $delete_request = delete_request($request_id);
    if($delete_request == true){
        echo '<p id="success_message">request deleted successfully!</p>';
    }elseif ($delete_request == false) {
        echo '<p id="error_message">request delete failed... try again!</p>';
    }

 }



 ?>