<?php 

if(isset($_GET['p_id'])){
    
    $the_comment_id =  ($_GET['p_id']);
    
    $query = "SELECT * FROM comments WHERE comment_id = $the_comment_id ";
    $select_comment_by_id = mysqli_query($connection,$query); 
    confirm($select_comment_by_id); 
}

    // Showing post in the table post form to edit
    while($row = mysqli_fetch_assoc($select_comment_by_id)){
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
        $comment_email = $row['comment_email'];
    } 

    // Updating post
    if(isset($_POST['update_comment'])){

   
        $comment_author = $_POST['author']; 
        $comment_content = $_POST['content'];
        $comment_email = $_POST['email'];


        $query = "UPDATE comments SET comment_author = '{$comment_author}', comment_content = '{$comment_content}',  comment_email = '{$comment_email}' WHERE comment_id  = {$the_comment_id} ";
        $update_query = mysqli_query($connection, $query);

        echo "<h2 class='text-center'>Update Successful</h2>";
        
        confirm($update_query);
  
    }


?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="author">Comment Author</label>
        <input value='<?php  echo $comment_author;  ?>' type="text" class="form-control" name="author">
    </div>


    <div class="form-group">
        <label for="content">Comment Content</label>
        <input value='<?php  echo $comment_content;  ?>' type="text" class="form-control" name="content">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input value='<?php  echo $comment_email;  ?>' type="text" class="form-control" name="email">
    </div>

    <div class="form-group">
        <label for="status">Comment Status: <?php  echo $comment_status;  ?></label>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_comment" value="Update Comment">
    </div>

</form>
