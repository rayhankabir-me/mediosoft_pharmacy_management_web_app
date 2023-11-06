<?php


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
             | <a href="registration.php">Register</a> 
             | <a href="login.php">Login</a>
        </td>
    </tr>

    <tr>
        <td>
            <ul>
                <li><a href="">Add Medicine</a></li>
                <li><a href="">Add User</a></li>
                <li><a href="">Add Medicine</a></li>
                <li><a href="">Add Medicine</a></li>
                <li><a href="">Add Medicine</a></li>
                <li><a href="">Add Medicine</a></li>
                <li><a href="">Add Medicine</a></li>
                <li><a href="">Add Medicine</a></li>
                <li><a href="">Add Medicine</a></li>
            </ul>
        </td>
        <td colspan="2">
            <br>
            <br>
                <h3>Total Medicines</h3>
                <form action="#" method="post">


                <label for="">User Name: </label><input type="text" name="username" id="">
                <hr>
                <label for="">Email: </label><input type="email" name="email" id="">
                <hr>
                <label for="">Full Name: </label><input type="text" name="full_name" id="">
                <hr>
                <label for="">Password: </label><input type="password" name="password" id="">
                <hr>
                <label for="">Confirm Password: </label><input type="password" name="c_password" id="">
                <hr>
                <fieldset>
                <legend>Gender</legend>
                <input type="radio" name="gender" value="male" id=""><label for=""> Male</label>
                <input type="radio" name="gender" value="female" id=""><label for=""> Female</label>
                <input type="radio" name="gender" value="other" id=""><label for=""> Other</label>
                </fieldset>
                <br>
                <fieldset>
                <legend>Date of Birth</legend>
                <input type="date" name="date_of_birth" id="">
                </fieldset>

                <p><?php if(isset($error_message)){echo $error_message;} ?></p>
                <p><?php if(isset($success_message)){echo $success_message;} ?></p>

                <br>
                <input type="submit" value="Submit" name="submit">
                <input type="submit" value="Reset" name="reset">
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