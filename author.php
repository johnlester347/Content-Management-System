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
            
                     
            // if(isset($_GET['p_id'])){

            //     $post_id = $_GET['p_id'];
                    
            //     }
                $query = "SELECT * FROM posts";
                $select_query = mysqli_query($connection, $query);
                $row = mysqli_fetch_assoc($select_query);
                $post_author1 = $row['post_author'];


                $query = "SELECT * FROM posts WHERE post_author = '{$post_author1}' ";
                $select_author_query = mysqli_query($connection, $query);

                if(!$select_author_query){
                    die("QUERY FAILED" . mysqli_error($connection));
                }

                while($row = mysqli_fetch_assoc($select_author_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_status = $row['post_status'];
                    $post_author = $row['post_author'];
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
                    by <a href="author.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <a href='post.php?p_id=<?php echo $post_id; ?>'>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
         
                <?php } ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

     
        <?php include "includes/footer.php"; ?>