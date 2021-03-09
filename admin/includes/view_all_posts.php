<?php 

include "delete_modal.php";




if(isset($_POST['checkBoxArray'])) {

    foreach($_POST['checkBoxArray'] as $postValueId ){
        $postValueId;
        $bulk_options = $_POST['bulk_options'];
        switch($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_published_status = mysqli_query($connection,$query);
                confirm($update_to_published_status);
                break;
                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                    $update_to_published_status = mysqli_query($connection,$query);
                    confirm($update_to_published_status);
                    break;
                    case 'delete':
                        $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                        $update_to_published_status = mysqli_query($connection,$query);
                        confirm($update_to_published_status);
                        break;
                        case 'clone':
                            $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                            $clone_query = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($clone_query)){
                                $post_id = $row['post_id'];
                                $post_tags = $row['post_tags'];
                                $post_comment = $row['post_comment_count'];
                                $post_status = $row['post_status'];
                                $post_category_id = $row['post_category_id'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];
                            }
                            
                            $query =  "INSERT INTO posts (post_title, post_category_id, post_author, post_status, post_date, post_image, post_tags, post_content, post_comment_count)
                            VALUES ('$post_title', $post_category_id, '$post_author', '$post_status', now(), '$post_image', '$post_tags', '$post_content', '$post_comment')";
                            $insert_query = mysqli_query($connection, $query);
                            confirm($insert_query);
                            break;
    }
  

}
}

?>



<form action="" method="post">

<table class="table table-bordered table-hover">

<div id="bulkOptionContainer" class="col-xs-4" style="padding: 0px;">

<select class="form-control" name="bulk_options" id="">
<option value="">Select Options</option>
<option value="published">Publish</option>
<option value="draft">Draft</option>
<option value="delete">Delete</option>
<option value="clone">Clone</option>
</select>

</div>

<div class="col-xs-4">
<input type="submit" name="submit" class="btn btn-success" value="Apply">
<a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
</div>


<thead>
    <tr>
        <th><input id="selectAllBoxes" type="checkbox"></th>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Images</th>
        <th>Tags</th>
        <th>Content</th>
        <th>Comment Count</th>
        <th>Date</th>
        <th>View Post</th>       
        <th>Update</th>
        <th>Delete</th>
        <th>Post Views</th>
    </tr>
</thead>

<tbody>
    <tr>

    <?php 

    $query = "SELECT * FROM posts ORDER BY post_id DESC";
    $show_all_data = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($show_all_data)){
        $show_id = $row['post_id'];
        $show_tags = $row['post_tags'];
        $show_comment = $row['post_comment_count'];
        $show_status = $row['post_status'];
        $show_category = $row['post_category_id'];
        $show_title = $row['post_title'];
        $show_author = $row['post_author'];
        $show_user= $row['post_user'];
        $show_date = $row['post_date'];
        $show_image = $row['post_image'];
        $show_content = $row['post_content'];
        echo "<tr>";
        ?>
        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $show_id; ?>'></td>
        <?php 
        
        echo "<td>$show_id</td>";

        if(!empty($show_author)){

            echo "<td>$show_author</td>";

        } else if(!empty($show_user)){

            echo "<td>$show_user</td>";

        }

        echo "<td>$show_title</td>";

        $query = "SELECT * FROM categories WHERE cat_id = $show_category ";
        $select_categories_id = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_categories_id)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<td>$cat_title</td>";
        }

        echo "<td>$show_status</td>";
        echo "<td><img width='100' src='../images/$show_image' alt='images'></td>";
        echo "<td>$show_tags</td>";
        echo "<td>$show_content</td>";


        $query = "SELECT * FROM posts WHERE post_id = '{$show_id}' ";
        $post_view_comment_query = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($post_view_comment_query);
        $post_view_comment = $row['post_comment_count'];

        echo "<td><a href='posts.php?reset_comment={$show_id}'>{$post_view_comment}</a></td>";
         
        echo "<td>$show_date</td>";
        echo "<td><a class='btn btn-link' href='../post.php?p_id={$show_id}'>View Post</a></td>";
        echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$show_id}'>Edit</a></td>";
        echo "<td><a rel='{$show_id}' href='javascript:void(0)' class='btn btn-danger delete_link'>Delete</a></td>";
        // echo "<td><a class='btn btn-danger' href='posts.php?delete={$show_id}'>Delete</a></td>";

        $query = "SELECT * FROM posts WHERE post_id = '{$show_id}' ";
        $post_view_query = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($post_view_query);
        $post_view_count = $row['post_view_counts'];

        echo "<td><a href='posts.php?view={$show_id}'>{$post_view_count}</a></td>";
        echo "</tr>";

        
    ?>

    <?php } ?>

    
<?php

    if(isset($_GET['reset_comment'])){

        $post_view_comment = $_GET['reset_comment'];
        $post_comment_query = "UPDATE posts SET post_comment_count = 0 WHERE post_id = {$post_view_comment} ";
        $update_post_view_comment = mysqli_query($connection, $post_comment_query);

        $comment_query = "SELECT * FROM comments";
        $show_all_comments = mysqli_query($connection, $comment_query);
        $row = mysqli_fetch_assoc($show_all_comments);
        $select_comment_id = $row['comment_id'];

        $delete_comment_query = "DELETE FROM comments WHERE comment_post_id = '{$post_view_comment}' ";
        $delete_comment_id = mysqli_query($connection, $delete_comment_query);
        header('Location: posts.php');
    } 


    if(isset($_GET['view'])){

        $post_view = $_GET['view'];
        $query = "UPDATE posts SET post_view_counts = 0 WHERE post_id = {$post_view} ";
        $update_post_view_counts = mysqli_query($connection, $query);
        header('Location: posts.php');
    } 


        if(isset($_GET['delete'])){

        $post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$post_id} ";
        $cat_delete = mysqli_query($connection, $query);
        header('Location: posts.php');
    } 
?>

    </tr>
</tbody>
</table>
</form>

<script>

$(document).ready(function(){

    $(".delete_link").on('click', function(){

        var id = $(this).attr("rel");
        var delete_url = "posts.php?delete="+ id +"";

        $(".delete_modal_link").attr("href", delete_url);

        $("#myModal").modal("show");

    });


});


</script>
