<?php 

function users_online() {

    if(isset($_GET['onlineusers'])){
        
        global $connection;  

        if(!$connection){

            session_start();
            include "../includes/db.php";

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;
            
            
            $query = "SELECT * FROM user_online WHERE session = '{$session}' ";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query); 
            
            if($count == NULL){ 
            
            mysqli_query($connection, "INSERT INTO user_online(session, time) VALUES ('{$session}','{$time}') ");
            
            } else {
            
            mysqli_query($connection, "UPDATE user_online SET time = '{$time}' WHERE session = '{$session}' ");
            
            }
            $user_online_query = mysqli_query($connection, "SELECT * FROM user_online WHERE time > '$time_out' ");
            echo $count_online = mysqli_num_rows($user_online_query);


        }
        
    } // GET REQUEST
    
}
users_online();





function confirm($result) {

    global $connection;   
    if(!$result){

        die("QUERY FAILED" . mysqli_error($connection));
    }

}
?>


<?php
function insertData() {

global $connection;    
$query = "SELECT * FROM categories";
$select_all_cat = mysqli_query($connection, $query);

if(!$select_all_cat){
    die("QUERY FAILED" . mysqli_error($connection));
}

if(isset($_POST['submit'])){

$the_cat_title = $_POST['cat_title'];

if($the_cat_title == "" || empty($the_cat_title)){
    echo "<h1>This field should not be empty</h1>";
}else{
    $query = "INSERT INTO categories(cat_title) VALUE ('{$the_cat_title}')";
    $cat_insert = mysqli_query($connection, $query);
    header("Location: categories.php");
    }
}

}
?>

<?php
function findAllCategories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $select_all_cat = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_all_cat)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
        }  
        ?>
 <?php } ?>


<?php
function deleteCategories() {
    global $connection;
    if(isset($_GET['delete'])){

        $cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$cat_id} ";
        $cat_delete = mysqli_query($connection, $query);
        header('Location: categories.php');
    }
    
}
?>

<?php
function updateCategories() { 
    global $connection;
     if(isset($_GET['edit'])){

    $the_cat_id = $_GET['edit'];
    
    $query = "SELECT * FROM categories WHERE cat_id = $the_cat_id ";
    $select_categories_id = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_categories_id)){
        $cat_title = $row['cat_title'];
    ?>

    <input value='<?php if(isset($cat_title)){ echo $cat_title; } ?>' type="text" class="form-control" name="cat_title">
    <label for="cat_title">Edit Category</label>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="new_category" value="Update category">
        </div>
        <?php }  } 
           
           if(isset($_POST['new_category'])){
                                           
               $cat_title = $_POST['cat_title'];   
               $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = {$the_cat_id} ";
               $update_query = mysqli_query($connection, $query);
       
       
               if(!$update_query){
       
                   die("QUERY FAILED" . mysqli_error($connection));
               }
               header("Location: categories.php");
       
           } 
         } ?>


