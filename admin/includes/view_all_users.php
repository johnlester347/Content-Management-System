<table class="table table-bordered table-hover">

<thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Image</th>
        <th>User Role</th>
        <th>Admin</th>
        <th>Subscriber</th>
        <th>Update</th>
        <th>Delete</th>
        <!-- <th>Rand Salt</th> -->
    </tr>
</thead>

<tbody>
    <tr>

    <?php 

    $query = "SELECT * FROM users";
    $show_users = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($show_users)){
        $id = $row['id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];



        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$username</td>";

        // $query = "SELECT * FROM categories WHERE cat_id = $show_category ";
        // $select_categories_id = mysqli_query($connection, $query);
        // while($row = mysqli_fetch_assoc($select_categories_id)){
        //     $cat_id = $row['cat_id'];
        //     $cat_title = $row['cat_title'];

        //     echo "<td>$cat_title</td>";
        // }

        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td>$user_email</td>";
        echo "<td><img width='100' src='../images/$user_image' alt='images' </td>";
        echo "<td>$user_role</td>";
        echo "<td><a class='btn btn-primary' href='users.php?change_to_admin={$id}'>Admin</a></td>";
        echo "<td><a class='btn btn-primary' href='users.php?change_to_sub={$id}'>Subscriber</a></td>";
        echo "<td><a class='btn btn-info' href='users.php?source=edit_user&p_id={$id}'>Edit</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this message?');  \" class='btn btn-danger' href='users.php?delete={$id}'>Delete</a></td>";
        echo "</tr>";

        
    ?>

    <?php } ?>

<?php
        if(isset($_GET['change_to_admin'])) {
            $id = $_GET['change_to_admin'];
            $query = "UPDATE users SET user_role = 'Admin' WHERE id = '{$id}' ";
            $update_user_admin = mysqli_query($connection, $query);

            if(!$update_user_admin){
                die("QUERY FAILED" . mysqli_error($connection));
            }
            header('Location: users.php');
            
        }

        if(isset($_GET['change_to_sub'])) {
            $id = $_GET['change_to_sub'];
            $query = "UPDATE users SET user_role = 'Subscriber' WHERE id = '{$id}' ";
            $update_user_admin = mysqli_query($connection, $query);

            if(!$update_user_admin){
                die("QUERY FAILED" . mysqli_error($connection));
            }
            header('Location: users.php');

            
        }

        if(isset($_GET['delete'])){
            if(isset($_SESSION['user_role'])){

                if($_SESSION['user_role'] == 'Admin'){

                    $id = mysqli_real_escape_string($connection,  $_GET['delete']);
                    $query = "DELETE FROM users WHERE id = {$id} ";
                    $user_delete = mysqli_query($connection, $query);
                    header('Location: users.php');
                    
                }
              
            }
        
    } 

?>


    </tr>
</tbody>
</table>