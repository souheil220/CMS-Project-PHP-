<?php
if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postId) {
        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status = 'published' WHERE post_id = $postId";
                $update_to_published = mysqli_query($connection, $query);
                confirm($update_to_published);
                break;

            case 'draft':
                $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = $postId";
                $update_to_draft = mysqli_query($connection, $query);
                confirm($update_to_draft);
                break;

            case 'clone':
                $query = "SELECT * FROM  posts  WHERE post_id = $postId";
                $select_post_query = mysqli_query($connection, $query);
                confirm($select_post_query);

                while($row = mysqli_fetch_array($select_post_query)){
                    $post_category_id = $row['post_category_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_status = $row['post_status'];
                }
                $query = "INSERT INTO posts(post_category_id ,post_title ,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";
                $query.= "VALUES ('$post_category_id', '$post_title', '$post_author','$post_date','$post_image','$post_content','$post_tags','$post_comment_count','$post_status' )";
                $clone_query = mysqli_query($connection,$query);
                confirm($clone_query);
                break;

            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = $postId";
                $delete_post = mysqli_query($connection, $query);
                confirm($delete_post);
                break;

            default:
                break;
        }
    }
}
?>

<form action="" method="POST">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4" style="padding:0%">
            <select class="form-control" name="bulk_options" id="">
                <option>Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="clone">Clone</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="?source=add_post" class="btn btn-primary">Add New</a>
        </div>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Views Number</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM posts  ORDER BY post_id DESC";
            $select_all_posts = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts)) {
                $post_id =  $row['post_id'];
                $post_title =  $row['post_title'];
                $post_author =  $row['post_author'];
                $post_date =  $row['post_date'];
                $post_image =  $row['post_image'];
                $post_category_id =  $row['post_category_id'];
                $post_tags =  $row['post_tags'];
                $post_status =  $row['post_status'];
                $post_comment_count =  $row['post_comment_count'];
                $post_views_counts =  $row['post_views_counts'];
                echo "<tr>";
            ?>
                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>
            <?php
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td>{$post_title}</td>";

                $query = "SELECT * FROM categories WHERE cat_id= $post_category_id";
                $select_categories_id = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_categories_id)) {
                    $cat_id =  $row['cat_id'];
                    $cat_title =  $row['cat_title'];
                    echo "<td>{$cat_title}</td>";
                }
                echo "<td>{$post_status}</td>";
                echo "<td><img width=100 class='img-responsive' src='../images/{$post_image}' alt=''></td>";
                echo "<td>{$post_tags}</td>";
                echo "<td>{$post_comment_count}</td>";
                echo "<td>{$post_views_counts}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                echo "<td><a href='?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a onClick=\" javaScript: return confirm('Are you sure you want to delete ?');\" href='?delete={$post_id}'>Delete</a></td>";
                echo "</tr>";
            }



            ?>



        </tbody>
    </table>
</form>
<?php
if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts where  post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection, $query);

    confirm($delete_query);
    header("Location: posts.php");
}
?>