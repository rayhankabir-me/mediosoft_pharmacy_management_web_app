<?php
//auth

require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/contactModel.php');

//requiring mail controller
require_once('../controller/send_mail.php');


$action = $_REQUEST['action'];
//add contact form
if($action == 'send_contact'){

    $error_message = '';

    $name = $_POST['name'];
    $contact_subject = $_POST['contact_subject'];
    $email = $_POST['email'];
    $message = $_POST['message'];

 
 
    if($name == ''){
        $error_message .= '<p id="error_message">you must enter your name!</p>';
    }else if($contact_subject == ''){
        $error_message .= '<p id="error_message">you must enter a subject!</p>';
    }else if($email == ''){
        $error_message .= '<p id="error_message">you must enter an email!</p>';
    }else if($message == ''){
        $error_message .= '<p id="error_message">you must enter message!</p>';
    }

 
 
    //data array
    $data = [
     'name' => $name,
     'contact_subject' => $contact_subject,
     'email' => $email,
     'message'   => $message
 
     ];
 
     if($error_message === ''){
 
         $result = add_contact($data);
     
         if($result === true){
            echo '<p id="success_message">thanks for submitting contacts..we will reach out soon!</p>';

            //mail send
            $subject = $contact_subject;
            $message = $message;

            $send_mail = send_mail('rayhankabir.wp@gmail.com', $subject, $message);


         }elseif ($result === false) {
            echo '<p id="error_message">contact submission failed... try again later!</p>';
         }
         
        }else{
            echo $error_message;
        }
}




//for get data action, show contact by ajax
if($action == 'get_contacts'){

    //get all contacts data
    $contacts = get_all_contacts();
    echo "<tr>";
    echo "<td>Name</td>";
    echo "<td>Subject</td>";
    echo "<td>Email</td>";
    echo "<td>Message</td>";
    echo "<td>Action</td>";
    echo "</tr>";

    foreach ($contacts as $contact) {
        ?>
         <tr>
             <td><?php echo $contact['name']; ?></td>
             <td><?php echo $contact['contact_subject']; ?></td>
             <td><?php echo $contact['email']; ?></td>
             <td><?php echo $contact['message']; ?></td>
             <td><a class="delete-btn" id="delete_btn" data-contact-id="<?php echo $contact['id']; ?>" onclick="deleteContact(event)" href="#">Delete</a></td>
         </tr>
        <?php
     }

 }


  //delete operations
  if($action == 'delete_contact'){
    $contact_id = $_REQUEST['contact_id'];
    $delete_contact = delete_contact($contact_id);
    if($delete_contact == true){
        echo '<p id="success_message">contact deleted successfully!</p>';
    }elseif ($delete_request == false) {
        echo '<p id="error_message">contact delete failed... try again!</p>';
    }

 }



 ?>