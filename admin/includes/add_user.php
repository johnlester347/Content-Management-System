<?php 

if(isset($_POST['create_user'])){

    $username = $_POST['username'];
    $user_password = $_POST['password'];
    $user_firstname = $_POST['firstname'];
    $user_lastname = $_POST['lastname'];
    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];
    $user_email = $_POST['email'];
    $user_role = $_POST['user_role'];

    
    move_uploaded_file($user_image_temp, "../images/$user_image");

    $password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12)); 
    
    $query =  "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_image, user_email, user_role)
    VALUES ('$username', '$password', '$user_firstname', '$user_lastname', '$user_image', '$user_email', '$user_role') ";
    $user_insert_query = mysqli_query($connection, $query);
    confirm($user_insert_query);
    echo "<h4>Successfully added: <a href='./users.php'>View Users</a></h4>";
    
}

?>


<form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="user_firstname">Firstname</label>
            <input type="text" class="form-control" name="firstname">
        </div>

        <div class="form-group">
            <label for="user_lastname">Lastname</label>
            <input type="text" class="form-control" name="lastname">
        </div>

        <div class="form-group">
            <select name="user_role" id="">

          <option value="Subscriber">Select Options</option>
          <option value="Admin">Admin</option>
          <option value="Subscriber">Subscriber</option>

            </select>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username">
        </div>

        <div class="form-group">
            <label for="user_email">Email</label>
            <input type="email" class="form-control" name="email">
        </div>

        <div class="form-group">
            <label for="user_password">Password</label>
            <input type="password" class="form-control" name="password">
        </div>

        <div class="form-group">
            <label for="user_image">User Profile</label>
            <input type="file" name="image">
        </div>


        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="create_user" value="Add user">
        </div>


</form>