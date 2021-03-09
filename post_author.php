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
                $post_user = $_GET['author'];
                    
            }else{
                $post_id = "";
            }

            $query = "SELECT * FROM posts WHERE post_user = '{$post_user}' ";
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
                   All post by <?php echo $post_user ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>
            <?php } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

     
        <?php include "includes/footer.php"; ?>