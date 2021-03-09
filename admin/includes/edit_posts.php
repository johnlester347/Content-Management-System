<?php 

if(isset($_GET['p_id'])){
    
    $the_post_id =  ($_GET['p_id']);
    
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
    $select_posts_by_id = mysqli_query($connection,$query); 
    confirm($select_posts_by_id); 
}

    // Showing post in the table post form to edit
    while($row = mysqli_fetch_assoc($select_posts_by_id)){
        $post_id            = $row['post_id'];
        $post_user         = $row['post_user'];
        $post_title         = $row['post_title'];
        $post_category_id   = $row['post_category_id'];
        $post_status        = $row['post_status'];
        $post_image         = $row['post_image'];
        $post_content       = $row['post_content'];
        $post_tags          = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date          = $row['post_date'];

    } 

    // Updating post
    if(isset($_POST['update_post'])){

        $post_title = $_POST['title'];   
        $post_id = $_POST['post_category']; 
        $post_user = $_POST['user'];
        $post_status = $_POST['status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['tags'];
        $post_content = $_POST['content'];

        move_uploaded_file($post_image_temp, "../images/$post_image"); // Moving the temporary image to permanent locations
        
        if(empty($post_image)){

            $query = "SELECT * FROM posts WHERE post_id = {$the_post_id} ";
            $image_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($image_query)){
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = '{$post_id}', post_date   =  now(), post_user = '{$post_user}', post_status = '{$post_status}', post_image = '{$post_image}', post_tags = '{$post_tags}', post_content = '{$post_content}' 
        WHERE post_id = {$the_post_id} ";
        $update_query = mysqli_query($connection, $query);

        echo "<p>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>View All Post</a></p>";
        
        confirm($update_query);
  
    }


?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value='<?php  echo $post_title;  ?>' type="text" class="form-control" name="title">
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
        <?php echo "<option value='{$post_user}'>--$post_user--</option>"; ?>
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

    <div class="form-group">
    <label for="title">Select Category : </label>
        <select name="status" id="post_status">
            <?php 
           
           $query = "SELECT * FROM posts ";
           $select_posts = mysqli_query($connection, $query);

           confirm($select_posts);

           if($post_status == 'published'){
            echo "<option value='published'>Published</option>";
            echo "<option value='draft'>Draft</option>";
           }else if($post_status !== 'published'){
            echo "<option value='draft'>Draft</option>";
            echo "<option value='published'>Publish</option>";
           }
           ?>

        </select>
    </div>
    
    <div class="form-group">
        <img width='100' src="../images/<?php echo $post_image; ?>"></img>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value='<?php  echo $post_tags;  ?>' type="text" class="form-control" name="tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="content" id="" cols="30" rows="10"
            class="form-control"><?php  echo $post_content;  ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>

</form>
