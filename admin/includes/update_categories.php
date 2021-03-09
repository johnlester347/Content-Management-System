<form action="categories.php" method="post">

<?php 

if(isset($_GET['edit'])){

$cat_id = $_GET['edit'];

$query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
$select_categories_id = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_categories_id)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
?>

<input value='<?php if(isset($cat_id)){ echo $cat_id; } ?>' type="text" class="form-control" name="cat_id">
<input value='<?php if(isset($cat_title)){ echo $cat_title; } ?>' type="text" class="form-control" name="cat_title">


    <?php }  } ?>

    <?php 
    

    if(isset($_POST['new_category'])){
        
        $the_cat_id = $_POST['cat_id'];   
        $the_cat_title = $_POST['cat_title'];   
        $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$the_cat_id} ";
        $update_query = mysqli_query($connection, $query);
        header("Location: categories.php");

        if(!$update_query){

            die("QUERY FAILED" . mysqli_error($connection));
        }

    }
    
    ?>  
    <label for="cat_title">Edit Category</label>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="new_category" value="Update category">
    </div>
    
</form>