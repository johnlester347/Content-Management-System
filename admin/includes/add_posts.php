<?php 

if(isset($_POST['create_post'])){

    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category'];
    $post_user= $_POST['user'];
    $post_status = $_POST['status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 0;
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    $query =  "INSERT INTO posts (post_title, post_category_id, post_user, post_status, post_date, post_image, post_tags, post_content, post_comment_count)
    VALUES ('$post_title', $post_category_id, '$post_user', '$post_status', now(), '$post_image', '$post_tags', '$post_content', '$post_comment_count')";
    $insert_query = mysqli_query($connection, $query);
    confirm($insert_query);
    $the_post_id = mysqli_insert_id($connection); // Pull the last inserted id in the database
    
    echo "<p>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>View All Post</a></p>";
    
}

?>


<form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" class="form-control" name="title">
        </div>

        <div class="form-group">
        <label for="post_category">Post Category : </label>
        <select name="post_category" id="post_category">
            <?php 
           
           $query = "SELECT * FROM categories";
           $select_categories = mysqli_query($connection, $query);

           confirm($select_categories);

           while($row = mysqli_fetch_assoc($select_categories)){
               $cat_id = $row['cat_id'];
               $cat_title = $row['cat_title'];

               echo "<option value='{$cat_id}'>{$cat_title}</option>";
           }
           ?>

        </select>
        </div>

        <div class="form-group">
        <label for="Users">Users : </label>
        <select name="user" id="post_author">
            <?php 
           
           $query = "SELECT * FROM users";
           $select_users = mysqli_query($connection, $query);

           confirm($select_users);

           while($row = mysqli_fetch_assoc($select_users)){
               $db_user_id = $row['id'];
               $db_username = $row['username'];
               $db_user_firstname = $row['user_firstname'];
               $db_user_lastname = $row['user_lastname'];

               echo "<option value='{$db_username}'>{$db_username}</option>";
           }
           ?>

        </select>
        </div>  

        <!-- <div class="form-group">
            <label for="post_author">Post Author</label>
            <input type="text" class="form-control" name="author">
        </div> -->

        <div class="form-group">
        <label for="title">Select Category : </label>
        <select name="status" id="post_status">
            <option value="draft">Select Options</option>
            <option value='published'>Publish</option>
            <option value='draft'>Draft</option>
        </select>
        </div>

        <div class="form-group">
            <label for="post_image">Post Image</label>
            <input type="file" name="image">
        </div>

        <div class="form-group">
            <label for="post_tags">Post Tags</label>
            <input type="text" class="form-control" name="post_tags">
        </div>

        <div class="form-group">
            <label for="post_content">Post Content</label>
            <textarea name="post_content" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
        </div>


</form>