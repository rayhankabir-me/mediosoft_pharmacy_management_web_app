<?php

//auth
include_once('../view/component/dashboard_sidebar.php');

require_once('../model/usersModel.php');
require_once('../controller/functions.php');

$action = $_REQUEST['action'];

  //current data in udpate field
  if($action == 'current_data'){
    $user_id=  $_REQUEST['user_id'];
    $users_data = get_user($user_id);

    echo json_encode($users_data);

}

// update user data operations using ajax

if($action == 'update_user'){

    $user_id = $_REQUEST['user_id'];

    $error_message = '';
    $profile_photo = $_FILES['profile_photo'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];


    if($profile_photo == ''){
        $error_message .= '<p id="error_message">you must select an image!</p>';
    }
    if($email == ''){
        $error_message .= '<p id="error_message">you must fill your email!</p>';
    }
    if($full_name == ''){
        $error_message .= '<p id="error_message">you must fill full name!</p>';
    }
    if($date_of_birth == ''){
        $error_message .= '<p id="error_message">you must fill date of birth!</p>';
    }
 
    // file info
    $source = $profile_photo['tmp_name'];
    $destination = '../assets/image/users/'.$profile_photo['name'];
 
 
    //data array
    $data = [
     'profile_photo' => $destination,
     'email' => $email,
     'full_name' => $full_name,
     'gender' => $gender,
     'date_of_birth'   => $date_of_birth,
 
     ];
 
     if($error_message === ''){
 
         $result = edit_profile($user_id, $data);
     
         if($result === true){
             
             if (!file_exists($destination)) {
                 if(move_uploaded_file($source, $destination)){
                 }
             }
             echo '<p id="success_message">profile udpated successfully!</p>';
         }elseif ($result === false) {
            echo '<p id="error_message">profile updated failed... try again!</p>';
         }
         
        }else{
            echo $error_message;
        }
}

//change password using ajax
if($action == 'change_password'){
    $user_id = $_REQUEST['user_id'];

    $error_message = '';
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $c_password = $_POST['c_password'];

    if($password == ''){
        $error_message .= '<p id="error_message">your must enter your current password!</p>';
    }else if($new_password == ''){
        $error_message .= '<p id="error_message">you must enter new password!</p>';
    }else if($c_password == ''){
        $error_message .= '<p id="error_message">you must enter confirm password!</p>';
    }else if($new_password !== $c_password){
        $error_message .= '<p id="error_message">new password and confirm password don not match!</p>';
    }else if(password_validation($new_password) === false){
        $error_message .= '<p id="error_message">your password format is wrong!</p>';
    }
    else if($password !== get_password($user_id)){
        $error_message .= '<p id="error_message">your password don not match the current password!</p>';
    }

 
     if($error_message === ''){

        
        
         $result = update_password($user_id, $new_password);
     
         if($result === true){
            
             echo '<p id="success_message">password changed successfully!</p>';
         }elseif ($result === false) {
            echo '<p id="error_message">password change failed... try again!</p>';
         }
         
        }else{
            echo $error_message;
        }

}


//showing all users table
if($action == 'get_data'){
        //get all users data
        $users = get_all_users();
        echo "<tr>";
        echo "<td>Profile Photo</td>";
        echo "<td>User Name</td>";
        echo "<td>Full Name</td>";
        echo "<td>Email</td>";
        echo "<td>User Type</td>";
        echo "<td>User Status</td>";
        echo "<td>Action</td>";
        echo "</tr>";
    
        foreach ($users as $user) {
            ?>
             <tr>
                 <td><img width="85px" src="<?php echo $user['profile_photo']; ?>" alt=""></td>
                 <td><?php echo $user['user_name']; ?></td>
                 <td><?php echo $user['full_name']; ?></td>
                 <td><?php echo $user['email']; ?></td>
                 <td><?php echo $user['user_type']; ?></td>
                 <td><?php echo ($user['user_status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                 <td><a class="edit-btn" href="../view/update_user.php?id=<?php echo $user['id']; ?>">Edit</a> | <a class="delete-btn" id="delete_btn" data-user-id="<?php echo $user['id']; ?>" onclick="deleteUser(event)" href="#">Delete</a></td>
             </tr>
            <?php
         }
}


  //delete operations
  if($action == 'delete_user'){
    $user_id = $_REQUEST['user_id'];
    $delete_user = delete_user($user_id);
    if($delete_user == true){
        echo '<p id="success_message">user deleted successfully!</p>';
    }elseif ($delete_user == false) {
        echo '<p id="error_message">user delete failed... try again!</p>';
    }

 }

//adding user
 if($action == 'add_user'){
    $error_message = '';
    
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];
    $full_name = $_REQUEST['full_name'];
    $password = $_REQUEST['password'];
    $c_password = $_REQUEST['c_password'];
 
    if(isset($_REQUEST['gender'])){
        $gender = $_REQUEST['gender'];
    }
 
    $date_of_birth = $_REQUEST['date_of_birth'];
    $user_type = $_REQUEST['user_type'];
 
    if($username == ''){
        $error_message .= "Your must fill User Name!";
    }elseif (username_validation($username) === false) {
        $error_message .= "Invalid User Name Format!";
    }elseif (user_name_exists($username) == true) {
     $error_message .= "This User Name Already Exists. Try Another!";
    }else if($full_name == ''){
        $error_message .= "Your must fill Full Name!";
    }else if($email == ''){
        $error_message .= "Your must fill Email!";
    }else if(email_validation($email) === false){
        $error_message .= "Invalid Email Format!";
    }else if($password == ''){
        $error_message .= "Your must fill Password!";
    }else if(password_validation($password) === false){
        $error_message .= "Wrong Password Format!";
    }else if($c_password !== $password){
        $error_message .= "Passwords Doesn't Match!";
    }else if($gender == ''){
        $error_message .= "Your must fill Gender!";
    }else if($date_of_birth == ''){
        $error_message .= "You must fill Date of Birth! <br>";
    }

 
 
    //data array
    $submited_data = [
     'username' => $username,
     'email' => $email,
     'full_name' => $full_name,
     'password' => $password,
     'gender' => $gender,
     'date_of_birth' => $date_of_birth,
     'user_type' => $user_type
     ];
 
     if($error_message === ''){
 
        $result = add_user($submited_data);
     
        if($result === true){
            echo '<p id="success_message">user added successfully!</p>';
        }elseif ($result === false) {
           echo '<p id="error_message">user added failed... try again!</p>';
        }
         
        }else{
            echo $error_message;
        }
 }




 // edit user data operations using ajax

if($action == 'edit_user'){

    $user_id = $_REQUEST['user_id'];

    $error_message = '';

    $profile_photo = $_FILES['profile_photo'];
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];
    $full_name = $_REQUEST['full_name'];
    $password = $_REQUEST['password'];
    $c_password = $_REQUEST['c_password'];
 
    if(isset($_REQUEST['gender'])){
        $gender = $_REQUEST['gender'];
    }
 
    $date_of_birth = $_REQUEST['date_of_birth'];
    $user_type = $_REQUEST['user_type'];
    $user_status = $_REQUEST['user_status'];
    
    if($profile_photo == ''){
        $error_message .= "<p id='error_message'>Your must upload a profile photo!</p>";
    }else if($username == ''){
        $error_message .= "<p id='error_message'>Your must fill User Name!</p>";
    }elseif (username_validation($username) === false) {
        $error_message .= "<p id='error_message'>Invalid User Name Format!</p>";
    }elseif (user_name_exists($username) == true) {
     $error_message .= "<p id='error_message'>This User Name Already Exists. Try Another!</p>";
    }else if($full_name == ''){
        $error_message .= "<p id='error_message'>Your must fill Full Name!</p>";
    }else if($email == ''){
        $error_message .= "<p id='error_message'>Your must fill Email!</p>";
    }else if(email_validation($email) === false){
        $error_message .= "<p id='error_message'>Invalid Email Format!</p>";
    }else if($password == ''){
        $error_message .= "<p id='error_message'>Your must fill Password!</p>";
    }else if(password_validation($password) === false){
        $error_message .= "<p id='error_message'>Wrong Password Format!</p>";
    }else if($c_password !== $password){
        $error_message .= "<p id='error_message'>Passwords Doesn't Match!</p>";
    }else if($gender == ''){
        $error_message .= "<p id='error_message'>Your must fill Gender!</p>";
    }else if($date_of_birth == ''){
        $error_message .= "<p id='error_message'>You must fill Date of Birth! </p>";
    }

 

 
    // file info
    $source = $profile_photo['tmp_name'];
    $destination = '../assets/image/users/'.$profile_photo['name'];

    //data array
    $submited_data = [
        'profile_photo' => $destination,
        'username' => $username,
        'email' => $email,
        'full_name' => $full_name,
        'password' => $password,
        'gender' => $gender,
        'date_of_birth' => $date_of_birth,
        'user_type' => $user_type,
        'user_status' => $user_status
    ];
 
 
     if($error_message === ''){
 
         $result = update_user($user_id, $submited_data);
     
         if($result === true){
             
             if (!file_exists($destination)) {
                 if(move_uploaded_file($source, $destination)){
                 }
             }
             echo '<p id="success_message">user udpated successfully!</p>';
         }elseif ($result === false) {
            echo '<p id="error_message">user updated failed... try again!</p>';
         }
         
        }else{
            echo $error_message;
        }
}



//registering user
if($action == 'user_registration'){
    $error_message = '';
    
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];
    $full_name = $_REQUEST['full_name'];
    $password = $_REQUEST['password'];
    $c_password = $_REQUEST['c_password'];
 
    if(isset($_REQUEST['gender'])){
        $gender = $_REQUEST['gender'];
    }
 
    $date_of_birth = $_REQUEST['date_of_birth'];

 
    if($username == ''){
        $error_message .= "Your must fill User Name!";
    }elseif (username_validation($username) === false) {
        $error_message .= "Invalid User Name Format!";
    }elseif (user_name_exists($username) == true) {
     $error_message .= "This User Name Already Exists. Try Another!";
    }else if($full_name == ''){
        $error_message .= "Your must fill Full Name!";
    }else if($email == ''){
        $error_message .= "Your must fill Email!";
    }else if(email_validation($email) === false){
        $error_message .= "Invalid Email Format!";
    }else if($password == ''){
        $error_message .= "Your must fill Password!";
    }else if($c_password !== $password){
        $error_message .= "Passwords Doesn't Match!";
    }else if(password_validation($password) === false){
        $error_message .= "Wrong Password Format!";
    }else if($gender == ''){
        $error_message .= "Your must fill Gender!";
    }else if($date_of_birth == ''){
        $error_message .= "You must fill Date of Birth!";
    }

 
 
   //data array
   $submited_data = [
    'user_name' => $username,
    'full_name' => $full_name,
    'email' => $email,
    'gender' => $gender,
    'date_of_birth' => $date_of_birth,
    'password' => $password,
    'user_type' => 'Customer'
    ];
 
     if($error_message === ''){
 
        $result = create_user($submited_data);
     
        if($result === true){
            echo '<p id="success_message">registration successfully..<a class="medio-btn" href="../view/login.php">Login Now</a></p>';
        }elseif ($result === false) {
           echo '<p id="error_message">user registration failed... try again!</p>';
        }
         
        }else{
            echo "<p id='error_message'>".$error_message."</p>";
        }
 }

 if($action == 'user_login'){


        $error_message = '';
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
    
        if($username == ''){
            $error_message .= "<p id='error_message'>Your must fill User Name! </p>";
    
        }else if($password == ''){
            $error_message .= "<p id='error_message'>Your must fill Password! </p>";
        }


        if($error_message === ''){
    
            $login = user_login($username, $password);
            $user_data = get_user_type($username);
            $user_type = $user_data->fetch_assoc();
            if ($login == true){
                session_start();
                $_SESSION["user_login"] = $username;
    
                if (isset($_POST["remember_me"])) {
                    $cookie_name = "remember_user";
                    $cookie_value = $username;
                    $cookie_expire = time() + 30 * 24 * 60 * 60;
                    setcookie($cookie_name, $cookie_value, $cookie_expire, "/");
                }
                echo 1;
    
            }else{
                    echo "<p id='error_message'>Invalid login details! Try Again!</p>";
                } 
        }else{
            echo $error_message;
        }
    
    
    
        
    
        
   
 }


?>