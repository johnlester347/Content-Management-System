<?php 

if(isset($_GET['p_id'])){
    
    $the_user_id =  ($_GET['p_id']);
    
    $query = "SELECT * FROM users WHERE id = $the_user_id ";
    $select_users_by_id = mysqli_query($connection,$query); 
    confirm($select_users_by_id); 
}

    // Showing post in the table post form to edit
    while($row = mysqli_fetch_assoc($select_users_by_id)){
        $id = $row['id'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $db_firstname = $row['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_email = $row['user_email'];
        $db_image = $row['user_image'];
        $db_role = $row['user_role'];



    } 

    // Updating post
    if(isset($_POST['update_user'])){

        $username = $_POST['username'];
        $user_password = $_POST['password'];
        $user_firstname = $_POST['firstname'];
        $user_lastname = $_POST['lastname'];
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        $user_email = $_POST['email'];
        $user_role = $_POST['user_role'];

        move_uploaded_file($user_image_temp, "../images/$user_image"); // Moving the temporary image to permanent locations
        
        if(empty($user_image)){

            $query = "SELECT * FROM users WHERE id = {$the_user_id} ";
            $image_query = mysqli_query($connection, $query);

            $row = mysqli_fetch_assoc($image_query);
            $user_image = $row['user_image'];
            
        }

        

        // $query = "SELECT randSalt FROM users";
        // $select_query = mysqli_query($connection, $query);

        // $row = mysqli_fetch_assoc($select_query);
        // $salt = $row['randSalt'];

        // $hashPassword = crypt($user_password, $salt);

        $password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12)); 

        $query = "UPDATE users SET username = '{$username}', user_password = '{$password}', user_firstname =  '{$user_firstname}', user_lastname = '{$user_lastname}', user_image = '{$user_image}', user_email = '{$user_email}', user_role = '{$user_role}' WHERE id = {$the_user_id} ";
        $update_query = mysqli_query($connection, $query);

        echo "<h2 class='text-center'>Update Successful</h2>";
        echo "<p>User Updated. <a href='../admin/users.php'>View User?</a></p>";
        
        confirm($update_query);
  
    }

?>

<form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="user_firstname">Firstname</label>
            <input value="<?php echo  $db_firstname; ?>" type="text" class="form-control" name="firstname">
        </div>

        <div class="form-group">
            <label for="user_lastname">Lastname</label>
            <input value="<?php echo  $db_lastname; ?>" type="text" class="form-control" name="lastname">
        </div>

        <div class="form-group">
            <select name="user_role" id="">
            <option value="<?php echo $db_role; ?>"><?php echo $db_role; ?></option>
            <?php 
                
            if($db_role == 'Admin') {
        
            echo "<option value='Subscriber'>Subscriber</option>";
        
            } else {
        
            echo "<option value='Admin'>Admin</option>";
        
            }

            ?>
            </select>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input value="<?php echo  $db_username; ?>" type="text" class="form-control" name="username">
        </div>

        <div class="form-group">
            <label for="user_email">Email</label>
            <input value="<?php echo  $db_email; ?>" type="email" class="form-control" name="email">
        </div>

        <div class="form-group">
            <label for="user_password">Password</label>
            <input value="<?php echo  $db_password; ?>" type="text" class="form-control" name="password">
        </div>

        <div class="form-group">
            <label for="user_image">User Profile</label>
            <input type="file" name="image">
            <img width="100" src="../images/<?php echo $db_image; ?>" alt="">
        </div>


        <div class="form-group">
            <input  type="submit" class="btn btn-primary" name="update_user" value="Update user">
        </div>


</form>