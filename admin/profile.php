<?php include "includes/admin_header.php"?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"?>

    <?php 
        
        if(isset($_SESSION['username'])) {
            
            $username_session = $_SESSION['username'];
            $query = "SELECT * FROM users WHERE username = '{$username_session}' ";
            $select_user_profile = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_user_profile)){
                $id = $row['id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
       

            }

        } 

        ?>


    <?php 
           $username_session_new = $_SESSION['username'];
           $query = "SELECT * FROM users WHERE username = '$username_session_new' ";
           $select_user = mysqli_query($connection, $query);

           while($row = mysqli_fetch_assoc($select_user)){
               $id = $row['id'];
               $username = $row['username'];
               $user_password = $row['user_password'];
               $user_firstname = $row['user_firstname'];
               $user_lastname = $row['user_lastname'];
               $user_email = $row['user_email'];
               $user_image = $row['user_image'];

      
           }
            
        ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome to Admin
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
<?php
        if(isset($_POST['update_user'])){
            $username = $_POST['username'];
            $user_password = $_POST['password'];
            $user_firstname = $_POST['firstname'];
            $user_lastname = $_POST['lastname'];
            $user_image = $_FILES['image']['name'];
            $user_image_temp = $_FILES['image']['tmp_name'];
            $user_email = $_POST['email'];

            move_uploaded_file($user_image_temp, "../images/$user_image");
            
            if(empty($user_image)){

                $query = "SELECT * FROM users WHERE username = '{$username_session}' ";
                $image_query = mysqli_query($connection, $query);
    
                while($row = mysqli_fetch_assoc($image_query)){
                    $user_image = $row['user_image'];
                }
            }

            if(empty($user_password)){

                echo "<script>alert('Password cannot be empty'); </script>";
            } else {
                $password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12)); 
            
                $query = "UPDATE users SET username = '{$username}', user_password = '{$password}', ";
                $query .= "user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', ";
                $query .= "user_image = '{$user_image}', user_email = '{$user_email}' WHERE username = '{$username_session}' ";
                $update_user = mysqli_query($connection, $query);
                confirm($update_user);
                
                echo "<p>User Updated. <a href='../admin/users.php'>View User?</a></p>";
            }

            
        }

        ?>
                   

                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="user_firstname">Firstname</label>
                            <input value="<?php echo  $user_firstname; ?>" type="text" class="form-control"
                                name="firstname">
                        </div>

                        <div class="form-group">
                            <label for="user_lastname">Lastname</label>
                            <input value="<?php echo  $user_lastname; ?>" type="text" class="form-control"
                                name="lastname">
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input value="<?php echo  $username; ?>" type="text" class="form-control" name="username">
                        </div>

                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input value="<?php echo  $user_email; ?>" type="email" class="form-control" name="email">
                        </div>

                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="password" class="form-control" placeholder="Password is not showing for security purpose"
                                name="password">
                        </div>

                        <div class="form-group">
                            <label for="user_image">User Profile</label>
                            <input type="file" name="image">
                            <img width="100" src="../images/<?php echo $user_image; ?>" alt="">
                        </div>


                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_user" value="Update Profile">
                        </div>


                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<?php include "includes/admin_footer.php"?>