<div class="col-md-4">

<?php 

if(isset($_POST['submit'])){

    $search = $_POST['search'];
    
    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
    
    $searchResult = mysqli_query($connection, $query);
    
    if(!$searchResult){
        die("ERRORR" . mysqli_error($connection));
    }
    
    $count = mysqli_num_rows($searchResult);
    
    if($count == 0){
    
        echo "<h1>NO RESULT</h1>";
    }else{
        echo "<h1> RESULT FOUND</h1>";
    }
    
    }


?>


<!--Login Well -->
<div class="well">
    <h4>Login</h4>
    <form action="includes/login.php" method="post" >

        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Enter your username" required="">
        </div>

        <div class="input-group">
            <input type="password" class="form-control" name="password" placeholder="Enter your password" required="">
            <span class="input-group-btn">
            <button name="submit" class="btn btn-primary" type="submit">Submit</button>
                <span class="input-group-btn"></span>
        </span>
        </div>

    </form>

</div>


<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
    <div class="input-group">
        <input type="text" name="search" class="form-control">
        <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">

            <?php

            $query = "SELECT * FROM categories ";  
            $selectALL_cat = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($selectALL_cat)){
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];

                echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
            
            }  
            
            ?>
  
            </ul>
        </div>

        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "widget.php"; ?>