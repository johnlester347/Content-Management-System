<?php

//Showing Database
$query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
$select_query = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_query)){
$show_all_data_in_database = $row['all database'];

}

//Showing Data and passing two conditions
$query = "SELECT * FROM posts WHERE post_category_id = $post_category_id AND post_status = 'published' ";

//Inserting data in the database
$query =  "INSERT INTO posts (post_title) VALUE ('$post_title')"; // remember dapat sa VALUES ay walang space sa bawat variable 
$insert_query = mysqli_query($connection, $query);

$count = mysqli_num_rows($searchResult);

// Deleting from database
if(isset($_GET['delete'])){

    $post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$post_id} ";
    $cat_delete = mysqli_query($connection, $query);
    header('Location: posts.php');
} 

// Upadting from database
$query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = {$post_id} ";
$update_comment_query = mysqli_query($connection, $query);

$query = "UPDATE posts SET post_title = '{$post_title}' WHERE post_id = {$the_post_id} ";
$update_query = mysqli_query($connection, $query);

// Sessions
session_start(); 
$_SESSION['username'] = $db_username; // $db_username is from database $row['username'];

// Clearing data or cancel the session after visiting the dashboard in Sessions using logout
session_start(); 
$_SESSION['username'] = null;

// For refeshing the page and redirecting to another page
ob_start();
header("Location: index.php");



// This when image is empty after you click the button
if(empty($post_image)){

    $query = "SELECT * FROM posts WHERE post_id = {$the_post_id} ";
    $image_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($image_query)){
        $post_image = $row['post_image'];
    }
}

//Showing how many users are online
$session = session_id(); // this will gonna have the id of any users.. If i have firefox i gonna have different id and chrome
$time = time(); 
$time_out_in_seconds = 60; // Kung ilang oras or seconds mo gusto yung user na mark as offline 
$time_out = $time - $time_out_in_seconds;


$query = "SELECT * FROM user_online WHERE session = '{$session}' ";
$send_query = mysqli_query($connection, $query);
$count = mysqli_num_rows($send_query); // Count of how many users in the database

if($count == NULL){ // Kapag wala pa sya sa database or it means new user then add so that we can keep track of the time and session of that user

mysqli_query($connection, "INSERT INTO user_online(session, time) VALUES ('{$session}','{$time}') ");

} else { // else kapag si user nasa db na or not new then update with the new time and session

mysqli_query($connection, "UPDATE user_online SET time = '{$time}' WHERE session = '{$session}' ");

}
$user_online_query = mysqli_query($connection, "SELECT * FROM user_online WHERE time > '$time_out' "); // I seselect nya yung user na ang time is mas mababa sa 60 seconds
$count_online = mysqli_num_rows($user_online_query); // Then kung ilan yung users na online using mysql num rows holding in variable and show using echo

// autocomplete="off" this is going to off the auto suggestion on the input box




?>

Try while loop kung paulit ulit parin pag hindi nakalabas yung }

When you are using loop always break ?> the loop if you want to add a html inside the loop
Pwede ka mag add ng isang pieces lang ng form code inside the loop and pwede din buong form.. Pag naka loop everytime na i click mo yun like link palagi mababago lahat ng data na nasa loop na yun.

Select query with like search - sidebar.php

mysli_num_row(); - binibilang kung ilan rows meron ang isang table.

if($cat_title == "" || empty($cat_title)){
echo
}

<?php ob_start();  ?> para gumana yung header("Location: index.php"); always use it in line 1 it will basically refresh the page

when you use if(isset($_POST[]) always convert into a variable so that you can use it.

<form action="" method="" enctype"multipart/form-data"> this is different because you are sending images or photo

$post_image = $_FILES['images']['name']; 
$post_image_temp = $_FILES['images']['tmp_name'];  this is for sending the data from form to database this is different because you are not using $_POST

move_uploaded_file($post_image_temp, "../images/$post_images") you are sending the temporary image to the location that we want example in cms in images and also it will uploaded in the database 

$post_date = date('d-m-y');  
you are sending the date to the database using this function date there are many function date in the php net but you need to include now() function in the $query for this to work

'{$post_status}' you need to include sigle quotes if the variable is character if not pwede kahit walang sigle quotes 

<a href='posts.php?source=edit_post&p_id={$post_id}>Edit</a>
From posts.php using switch case to direct you to edit_post if the case is correct and use the if isset get to include the p_id

Pwede mo din gamitin yung 
$post_id = $_GET['p_id'];
Sa ibang if isset example na define mo na sya sa if isset sa taas then pwede mo na sya gamitin sa ibang if isset.

$username = mysqli_real_escape_string($connection, $username);
To clean the text from sql injection 

$db_username = $row['username']; galing to sa while loop magagamit mo yung session para syang cookies everytime na mag login sya pwede mo sya gamitin kahit saan sa site mo basta naka include yung session_start();
Then yung ni loop mo na galing sa db ipasok mo sa session
$_SESSION['username'] = $db_username;

$post_id = mysqli_insert_id($connection); 
this is going to pull the last created id inside the database magagamit mo to kunwari walang id na naka include sa url and nag add ka ng post item pero may $post_id na naka echo need mo i pull yung last created id na yun and assign that into the same variable na ginamit mo sa echo

$query = " SELECT randSalt FROM users";

onClick="\javascript: return confirm('are you sure you want to delete this message?');  "\
This is a pop up message
