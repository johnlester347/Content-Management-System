<?php 

if(isset($_GET['edit'])){

    $cat_id = $_GET['edit'];

    $query = "SELECT * FROM posts WHERE post_id = $post_id ";
    $select_categories_id = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_categories_id)){
        $post_id = $row['post_id'];

    ?>
<form action="posts.php" method="post">
    <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" class="form-control" name="title">
        </div>

        <div class="form-group">
            <label for="post_category">Post Category Id</label>
            <input type="text" class="form-control" name="post_category_id">
        </div>

        <div class="form-group">
            <label for="post_author">Post Author</label>
            <input type="text" class="form-control" name="author">
        </div>

        <div class="form-group">
            <label for="post_status">Post Status</label>
            <input type="text" class="form-control" name="status">
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
            <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
        </div>

</form>
        <?php }  } ?>

        <?php 
        

        if(isset($_POST['update_post'])){

            $post_title = $_POST['title'];   
            $post_id = $_POST['post_category_id']; 
            $post_author = $_POST['author'];
            $post_status = $_POST['status'];
            $post_image = $_POST['image'];
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];

            $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = '{$post_id}', post_author = '{$post_author}', post_status = '{$post_status}', post_image = '{$post_image}', post_tags = '{$post_tags}', post_content = '{$post_content}' 
            ";
            $update_query = mysqli_query($connection, $query);

            if(!$update_query){

                die("QUERY FAILED" . mysqli_error($connection));
            }

        }

?>

//
<?php 

if(isset($_GET['edit'])){

    $cat_id = $_GET['edit'];

    $query = "SELECT * FROM posts WHERE post_id = $post_id ";
    $select_categories_id = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_categories_id)){
        $post_id = $row['post_id'];

    ?>
<form action="posts.php" method="post">
    <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" class="form-control" name="title">
        </div>

        <div class="form-group">
            <label for="post_category">Post Category Id</label>
            <input type="text" class="form-control" name="post_category_id">
        </div>

        <div class="form-group">
            <label for="post_author">Post Author</label>
            <input type="text" class="form-control" name="author">
        </div>

        <div class="form-group">
            <label for="post_status">Post Status</label>
            <input type="text" class="form-control" name="status">
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
            <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
        </div>

</form>
        <?php }  } ?>

        <?php 
        

        if(isset($_POST['update_post'])){

            $post_title = $_POST['title'];   
            $post_id = $_POST['post_category_id']; 
            $post_author = $_POST['author'];
            $post_status = $_POST['status'];
            $post_image = $_POST['image'];
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];

            $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = '{$post_id}', post_author = '{$post_author}', post_status = '{$post_status}', post_image = '{$post_image}', post_tags = '{$post_tags}', post_content = '{$post_content}' 
            ";
            $update_query = mysqli_query($connection, $query);

            if(!$update_query){

                die("QUERY FAILED" . mysqli_error($connection));
            }

        }

?>