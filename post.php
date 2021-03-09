<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
         
            <?php

            if(isset($_GET['p_id'])){

                $post_id = $_GET['p_id'];
                    
            }else{
                $post_id = "";
            }

            $query = "UPDATE posts SET post_view_counts = post_view_counts + 1 WHERE post_id = '{$post_id}' ";
            $update_view_count_query = mysqli_query($connection, $query);
            if(!$update_view_count_query){
                die("QUERY FAILED" . mysqli_error($connection));
            }


            $query = "SELECT * FROM posts WHERE post_id = '{$post_id}' ";
            $selectALL_post = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($selectALL_post)){
                $post_title = $row['post_title'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_status = $row['post_status'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0 , 100);


               ?>

                <h1 class="page-header">
                    Welcome
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                     <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="post_author.php?author=<?php echo $post_user ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_user ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
               
                <hr>

               <!-- Blog Comments -->
               <?php
                    
                    if(isset($_POST['new_post'])){
                        $post_id = $_GET['p_id'];
                        $comment_content = $_POST['comment_content'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_date = date('d-m-y');  
                        
                        if(!empty($comment_content) && !empty($comment_author) && !empty($comment_email)){

                            $query =  "INSERT INTO comments(comment_post_id, comment_content, comment_author, comment_email, comment_date, comment_status) VALUES ($post_id, '{$comment_content}', '{$comment_author}', '{$comment_email}', now(), 'Pending' )";
                            $insert_comment = mysqli_query($connection, $query);
     
                            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = {$post_id} ";
                            $update_comment_query = mysqli_query($connection, $query);
     
                            if(!$insert_comment){
                             die("QUERY FAILED" . mysqli_error($connection));
                             }

                        } else {
                            echo "<script>alert('Field cannot be empty')</script>";
                        }
  
                    }
                    ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                        <form action="" method="post" role="form">
                            <div class="form-group">
                              <label for="Author">Author</label>
                              <input type="text" class="form-control" name="comment_author" >
                            </div>
                            <div class="form-group">
                              <label for="Email">Email</label>
                              <input type="email" class="form-control" name="comment_email" >
                            </div>
                            <div class="form-group">
                            <label for="Comment">Your Comment</label>
                             <textarea name="comment_content" class="form-control" rows="3" ></textarea>
                            </div>
                        <button type="submit" class="btn btn-primary" name="new_post">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->


<?php 

$query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} AND comment_status = 'Approved' ORDER BY comment_id DESC ";
$select_comment_query = mysqli_query($connection, $query);

if(!$select_comment_query){

die("QUERY FAILED" . mysqli_error($connection));
}

while($row = mysqli_fetch_assoc($select_comment_query)){

$comment_author = $row['comment_author'];
$comment_date = $row['comment_date'];
$comment_content = $row['comment_content'];



?>
 

                <div class="media">
                  <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo "Posted on " . $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

                <?php } ?>

                

                <!-- Comment -->
                


          
            <?php } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

     
        <?php include "includes/footer.php"; ?>