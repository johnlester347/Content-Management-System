<?php include "includes/admin_header.php"?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>

                </div>
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                <?php 
                                
                                $query = "SELECT * FROM posts";
                                $select_posts = mysqli_query($connection, $query);

                                $post_count = mysqli_num_rows($select_posts);

                                ?>
                                  <div class='huge'><?php echo $post_count; ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php 
                                
                                $query = "SELECT * FROM comments";
                                $select_comments = mysqli_query($connection, $query);

                                $comments_count = mysqli_num_rows($select_comments);
                                
                                ?>
                                    <div class='huge'><?php echo $comments_count; ?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php 
                                
                                $query = "SELECT * FROM users";
                                $select_users = mysqli_query($connection, $query);

                                $users_count = mysqli_num_rows($select_users);
                                
                                ?>
                                    <div class='huge'><?php echo $users_count; ?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php 
                                
                                $query = "SELECT * FROM categories";
                                $select_categories = mysqli_query($connection, $query);

                                $categories_count = mysqli_num_rows($select_categories);
                                
                                ?>
                                    <div class='huge'><?php echo $categories_count; ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
            </div>
            <!-- /.row -->
            <?php 
               
               $query = "SELECT * FROM comments WHERE comment_status = 'Approved' ";
               $select_approved_comments = mysqli_query($connection, $query);

               $approved_comments_count = mysqli_num_rows($select_approved_comments);
            
            
               $query = "SELECT * FROM posts WHERE post_status = 'published' ";
               $published_post = mysqli_query($connection, $query);

               $published_post_count = mysqli_num_rows($published_post);
            
            ?>
    
                <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Data', 'Count'],

                <?php 
                
                $element_text = ['Active Posts', 'Comments', 'Users', 'Categories', 'Comments Approved', 'Published Post'];
                $element_count = [$post_count, $comments_count, $users_count, $categories_count, $approved_comments_count, $published_post_count];
                
                for($i = 0; $i < 6; $i++){
                    echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                }

                ?>

                ]);

                var options = {
                chart: {
                title: '',
                subtitle: '',
                }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
                }

                </script>

                <div id="columnchart_material" style="width: 'auto'; height: 500px; "></div>



            
               
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Data');
      data.addColumn('number', 'Users');
      data.addColumn('number', 'Posts');
      data.addColumn('number', 'Comments');

      data.addRows([
        [1,  27.8, 20.8, 21.8],
        [2,  20.9, 29.5, 22.4],
        [3,  25.4,   27, 25.7],
        [4,  11.7, 18.8, 10.5],
        [5,  11.9, 17.6, 10.4],
        [6,   8.8, 13.6,  7.7],
        [7,   7.6, 12.3,  9.6],
        [8,  12.3, 29.2, 10.6],
        [9,  16.9, 22.9, 14.8],
        [10, 12.8, 20.9, 11.6],
        [11,  5.3,  7.9,  4.7],
        [12,  6.6,  8.4,  5.2],
        [13,  4.8,  6.3,  3.6],
        [14,  4.2,  6.2,  3.4]
      ]);

      var options = {
        chart: {
          title: '',
          subtitle: ''
        },
        width: 'auto',
        height: 500
      };

      var chart = new google.charts.Line(document.getElementById('linechart_material'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>

<div id="linechart_material" ></div>


        </div>
        <!-- /.container-fluid -->
      
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<?php include "includes/admin_footer.php"?>