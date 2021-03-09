<table class="table table-bordered table-hover">

<thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Repsponse to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
</thead>

<tbody>
    <tr>

    <?php 

    $query = "SELECT * FROM comments";
    $show_all_comments = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($show_all_comments)){
        $show_comment_id = $row['comment_id'];
        $show_comment_post_id = $row['comment_post_id'];
        $show_comment_author = $row['comment_author'];
        $show_comment_email = $row['comment_email'];
        $show_comment_content = $row['comment_content'];
        $show_comment_status = $row['comment_status'];
        $show_comment_date = $row['comment_date'];

        echo "<tr>";
        echo "<td>$show_comment_id</td>";
        echo "<td>$show_comment_author</td>";
        echo "<td>$show_comment_content</td>";
        echo "<td>$show_comment_email</td>";
        echo "<td>$show_comment_status</td>";

$query = "SELECT * FROM posts WHERE post_id = {$show_comment_post_id} ";
$insertInto_comment = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($insertInto_comment)){
    $post_title = $row['post_title'];


        echo "<td><a href='../post.php?p_id={$show_comment_post_id}'>$post_title</a></td>";


}

        echo "<td>$show_comment_date</td>";
        echo "<td><a class='btn btn-success' href='comments.php?approve={$show_comment_id}'>Approve</a></td>";
        echo "<td><a class='btn btn-warning' href='comments.php?unapprove={$show_comment_id}'>Unapprove</a></td>";
        echo "<td><a class='btn btn-info' href='comments.php?source=edit_comment&p_id={$show_comment_id}'>Edit</a></td>";
        echo "<td><a class='btn btn-danger' href='comments.php?delete={$show_comment_id}'>Delete</a></td>";
        echo "</tr>";

        
    ?>

    <?php } ?>
<?php 

if(isset($_GET['approve'])){

    $show_comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$show_comment_id} ";
    $comment_update_approve = mysqli_query($connection, $query);
    header('Location: comments.php');
} 

?>

<?php 

if(isset($_GET['unapprove'])){

    $show_comment_id = $_GET['unapprove'];
    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$show_comment_id} ";
    $comment_update_approve = mysqli_query($connection, $query);
    header('Location: comments.php');
} 

?>

<?php
        
        if(isset($_GET['delete'])){

            $show_comment_id = $_GET['delete'];
            $query = "DELETE FROM comments WHERE comment_id = {$show_comment_id} ";
            $comment_delete = mysqli_query($connection, $query);
            header('Location: comments.php');
        } 

        if(isset($_GET['delete'])){

        $show_comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = {$show_comment_id} ";
        $comment_delete = mysqli_query($connection, $query);
        header('Location: comments.php');
        } 
?>


    </tr>
</tbody>
</table>