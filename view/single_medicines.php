<?php
//requring files
require_once('../model/medicinesModel.php');
$medicines = get_all_medicines_data();

$medicine_id = '';
if(isset($_GET['id'])){
    $medicine_id = $_GET['id'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
</head>
<body>
    <table border="1" width="100%">
    <tr>
        <td><a href="index.php"><h2>MedioSoft</h2></a></td>
        <td colspan="2">
            <a href="index.php">Home</a>
             | <a href="view/medicines.php">Medicines</a> 
             | <a href="view/blog.php">Blog</a> 
             | <a href="view/contact.php">Contact</a>
             | <a href="view/request_support_ticket.php">Request Ticket</a> 
             | <a href="view/registration.php">Register</a> 
             | <a href="view/login.php">Login</a>
        </td>
    </tr>

    <tr>
        <td>
            <br>
            <br>
            <!-- medicine details -->
            <h2>Medicine Title</h2>
            <img src="" alt="">
            <p>lorem ipsum</p>
            <p>Category: <strong>ABC</strong></p>
            <p>Company: <strong>ABC</strong></p>
            <p>Price: <strong>20.00</strong></p>
            <p>Manufacturing Date: <strong>2023-10-10</strong></p>
            <p>Expiry Date: <strong>2023-10-10</strong></p>

            <form action="">
                <label for="">Quantity: </label><input type="number">
                <input type="submit" value="Buy Now">
            </form>
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

