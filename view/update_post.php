<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
require_once('../model/usersModel.php');
if(!check_login_status()){
    header('location: login.php');
}

require_once('../model/postCategoryModel.php');

$catgories = get_all_category_data();

$get_current_user_info = get_current_user_info();

if(isset($_GET['id'])){
    $post_id = $_GET['id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Post Category</title>
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
                <h3>Update Post Category</h3>
                <img id="current_image" width="200px" src="" alt="">
                <form id="post_form" action="#" method="POST" enctype="multipart/form-data" onsubmit="updatePost()">

                <label for="">Upload New Image</label><br>
                <input type="file" name="image" id="image">
                <label for="">Post Name </label><br>
                <input type="text" name="title" id="title">
                <br>
                <label for="">Description </label>
                <br>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>
                <br>
                <label for="">Select Category</label>
                <br>
                <select name="category" id="category">
                    <?php
                        foreach($catgories as $category){
                            
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

                <input type="submit" value="Update" name="submit">

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

        showData();
        //fetch current data using ajax
        function showData(){
            let post_id = <?php echo $post_id; ?>;
            let action = 'current_data';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/postsController.php?action='+action+'&post_id='+post_id, true);

            xhttp.send();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    let data = JSON.parse(this.responseText);
                    document.getElementById('current_image').src = data.image;
                    document.getElementById('title').value = data.title;
                    document.getElementById('description').value = data.description;

                    //showing category selected item
                    let category = document.getElementById('category');
                    for (let i = 0; i < category.options.length; i++) {
                        if (category.options[i].value == data.category) {
                            category.options[i].selected = true;
                            break; 
                        }
                    }

                    //showing date
                    document.getElementById('date').value = data.date;
                }
            }
        }

        //update post data by ajax
        function updatePost(){
            event.preventDefault();


            let image = document.getElementById('image').value;
            let title = document.getElementById('title').value;
            let description = document.getElementById('description').value;
            let category = document.getElementById('category').value;
            let date = document.getElementById('date').value;
            
            if(image === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must select an image!</p>';
            }else if(title === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must fill the Post title!</p>';
            }else if(description === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must fill the Post description!</p>';
            }else if(category === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must select a category!</p>';
            }else if(date === ''){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">You must provide a date!</p>';
            }else{

                let formData = new FormData(document.getElementById('post_form'));

                formData.append('action', 'update_post');
                formData.append('post_id', <?php echo $post_id; ?>);

                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../controller/postsController.php', true);

                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('status_messages').innerHTML = this.responseText;
                        showData();

                    }
                }
                xhttp.send(formData);
                }
        }

    </script>
</body>
</html>