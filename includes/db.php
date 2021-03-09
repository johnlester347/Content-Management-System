<?php 

$connection = mysqli_connect("localhost", "root", "", "cms");

if(!$connection){

   die("Connection FAILED" . mysqli_error($connection));
}


?>