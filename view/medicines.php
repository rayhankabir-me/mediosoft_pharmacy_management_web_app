<?php
//requring files
require_once('../model/medicinesModel.php');
$medicines = get_all_medicines_data();



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <title>MedioSoft - Medicines</title>
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
        <!-- sidebar -->
        <td>
            <h3>Search Medicine</h3>
            <form action="">
                <input type="text" name="" id="" placeholder="Medicine Name">
                <input type="submit" value="Search Medicine">
            </form>

            <h3>Filter By Category</h3>
                <form action="">
                    <select name="category" id="">
                        <option value="">Category One</option>
                        <option value="">Category Two</option>
                        <option value="">Category Three</option>
                    </select>
                    <input type="submit" value="Filter">

                </form>
            <h3>Filter By Company</h3>
                <form action="">
                <select name="company" id="">
                    <option value="">Company One</option>
                    <option value="">Company Two</option>
                    <option value="">Category Three</option>
                </select>
                <input type="submit" value="Filter">
                </form>
        </td>
        <td colspan="2">
            <br>
            <br>
                <table border="1">


                    <?php
                        foreach($medicines as $medicine){
                            
                            ?>
                                <tr>
                                    <td><img width="120px" src="<?php echo $medicine['image_url']; ?>" alt=""></td>
                                    <td><h2><a href="single_medicines.php?id=<?php echo $medicine['id']; ?>">Napa Extra 500mg 1 Box</a></h2></td>
                                    
                                    <td><p>Category: <strong><?php echo $medicine['category_title']; ?></strong></p></td>   
                                    <td><p>Company: <strong><?php echo $medicine['company_name']; ?></strong></p></td>
                                    <td><p>Price: <strong><?php echo $medicine['medicine_price']; ?></strong></p></td>
                                    <td><a href="single_medicines.php?id=<?php echo $medicine['id']; ?>">Details</a></td>


                                </tr>
                            <?php
                        }
                    ?>



                </table>
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

