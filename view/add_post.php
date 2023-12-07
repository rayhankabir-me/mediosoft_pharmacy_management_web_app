<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/usersModel.php');
require_once('../model/postCategoryModel.php');
$get_current_user_info = get_current_user_info();

//get current user id
$user_id = get_current_user_id();

//get all post category data
$category_data = get_all_category_data();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Post</title>
</head>
<body>

    <table border="1" width="100%">
    <tr>
        <td><a href="index.php"><h2>MedioSoft</h2></a></td>
        <td colspan="2">
            Welcome back! <strong><?php echo $get_current_user_info['full_name']; ?></strong>
             | Notifications 
             | <a href="../index.php">Visit Site</a>  
             | <a href="../controller/logout.php">Logout</a>
        </td>
    </tr>

    <tr>
        <td>
        <?php echo get_sidebar();?>
        </td>
        <td colspan="2">
            <br>
            <br>
                <h3>Add Post</h3>
                <form id="post_form" action="#" method="POST" enctype="multipart/form-data" onsubmit="addPost()">

                <label for="">Upload Post Image</label>
                <input type="file" name="image" id="image">
                <label for="">Post Title </label><br>
                <input type="text" name="title" id="title">
                <br>
                <label for="">Description </label>
                <br>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>
                <br>
                <label for="">Select a Category</label>
                <br>
                <select name="category" id="category">
                    <?php
                        foreach($category_data as $category){
                            
                            ?>
                                <option value="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></option>
                            <?php
                        }
                    ?>
                </select>
                <br>
                <label for="">Date</label>
                <br>
                <input type="date" name="date" id="date">
                <br>

                <input type="submit" value="Submit" name="submit">

                </form>

                <div id="status_messages"></div>
            <br>
            <br>

        </td>
    </tr>
    <tr>
        <td colspan="3">Copyright &copy; 2023 MedioSoft. All rights are reserved.</td>
    </tr>

    </table>
    
    <script>
    function addPost() {
        event.preventDefault();

        let image = document.getElementById('image').value;
        let title = document.getElementById('title').value;
        let description = document.getElementById('description').value;
        let category = document.getElementById('category').value;
        let date = document.getElementById('date').value;

        if(image === ''){
            document.getElementById('status_messages').innerHTML = '<p id="error_message">You must select an image!</p>';
        }else if(title === ''){
            document.getElementById('status_messages').innerHTML = '<p id="error_message">You must fill Post title!</p>';
        }else if(description === ''){
            document.getElementById('status_messages').innerHTML = '<p id="error_message">You must fill the description!</p>';
        }else if(category === ''){
            document.getElementById('status_messages').innerHTML = '<p id="error_message">You must select a category!</p>';
        }else if(date === ''){
            document.getElementById('status_messages').innerHTML = '<p id="error_message">You must provide the Post date!</p>';
        }else{
        let formData = new FormData(document.getElementById('post_form'));
        formData.append('added_by', <?php echo $user_id; ?>);
        formData.append('action', 'add_post');

        let xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../controller/postsController.php', true);

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('status_messages').innerHTML = this.responseText;

            }
        }
        xhttp.send(formData);
        }
    }
</script>

</body>
</html>