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
            
            $per_page = 10;

            if(isset($_GET['page'])){

            $page = $_GET['page'];
                
            } else {

                $page = "";
            }

            if($page == "" || $page == 1){ // This is page=1

                $page_1 = 0; // eto naman yung magbibilang simula 0 to 10 na nakalagay sa limit

            } else {

                $page_1 = ($page * $per_page) - $per_page; 

            }

            $select_query = "SELECT * FROM posts";
            $select_posts = mysqli_query($connection, $select_query);
            $count_post = mysqli_num_rows($select_posts);
            
            // $count_post = ceil($count_post / 5);




            $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
            $selectALL_post = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($selectALL_post)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_status = $row['post_status'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0 , 100);


                if($post_status !== "published"){

                    echo "";
                }else{

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
                <a href='post.php?p_id=<?php echo $post_id; ?>'>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php } } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <ul class="pager">
        <?php 

        for($i =1;  $i <= $count_post; $i++) {
            
            if($i == $page){
                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            } else {
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
           
        }

        ?>


        
        </ul>
     
        <?php include "includes/footer.php"; ?>