<?php
require_once('../controller/check_session_cookie.php');
check_session_cookie();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - MedioSoft</title>
</head>
<body>

    <table border="1" width="100%">
    <tr>
        <td><a href="index.php"><h2>MedioSoft</h2></a></td>
        <td colspan="2">
            <a href="index.php">Home</a>
             | <a href="medicines.php">Medicines</a> 
             | <a href="blog.php">Blog</a> 
             | <a href="contact.php">Contact</a> 
             | <a href="../controller/logout.php">Logout</a>
        </td>
    </tr>

    <tr>
        <td>
            <ul>
                <li><a href="">Dashboard</a></li>
                <li><a href="">Orders History</a></li>
                <li><a href="">Contact History</a></li>
                <li><a href="">View Profile</a></li>
                <li><a href="">Edit Profile</a></li>
                <li><a href="">Change Profile Photo</a></li>
                <li><a href="">Change Password</a></li>
  
            </ul>
        </td>
        <td colspan="2">
            <br>
            <br>
                <h3>Total Order - 20</h3>

            <br>
            <br>

        </td>
    </tr>
    <tr>
        <td colspan="3">Copyright &copy; 2023 MedioSoft. All rights are reserved.</td>
    </tr>

    </table>
    
</body>
</html>