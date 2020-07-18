<?php
    if(isset($_POST['create_post'])){
       
        $post_title =escape( $_POST['title']);
        $post_category_id = escape($_POST['post_category']);
        $post_user =escape( $_POST['users']);
        $post_status = escape($_POST['post_status']);
        $post_image =escape( $_FILES['image']['name']);
        $post_image_temp = escape($_FILES['image']['tmp_name']);
        $post_tags = escape($_POST['post_tags']);
        $post_content =escape( $_POST['post_content']);
        $post_date = date('d-m-y');
        $post_comment_count = 0;

        move_uploaded_file($post_image_temp,"../images/$post_image");

        $query = "INSERT INTO posts (post_title ,post_category_id,post_user,post_status,post_image,post_tags,post_content,post_date,post_comment_count) ";
        $query.= "VALUES ('{$post_title}' ,{$post_category_id},'{$post_user}','{$post_status}','{$post_image}','{$post_tags}','{$post_content}',now(),'{$post_comment_count}' ) ";
        $create_post_query = mysqli_query($connection,$query);
        confirm($create_post_query);
        $post_id = mysqli_insert_id($connection);
        echo "<div class='alert alert-success' >Post Created: <a href='../post.php?p_id=$post_id'>View Post</a></div>";
    }
?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        
    <label for="category">Category</label><br>
      <select name="post_category" id="post_category">
          <?php
          
               $query = "SELECT * FROM categories ";
               $select_categories = mysqli_query($connection, $query);
               confirm($select_categories);
               while ($row = mysqli_fetch_assoc($select_categories)) {
                   $cat_id =  $row['cat_id'];
                   $cat_title_edit =  $row['cat_title'];

                   echo "<option value='$cat_id'>$cat_title_edit</option>";
                }
          ?>
          
      </select>
    </div>
    <div class="form-group">

    <label for="users">Users</label><br>
      <select name="users" id="users">
          <?php
          
               $query = "SELECT * FROM users ";
               $select_users = mysqli_query($connection, $query);
               confirm($select_users);
               while ($row = mysqli_fetch_assoc($select_users)) {
                   $username =  $row['username'];

                   echo "<option value='$username'>$username</option>";
                }
          ?>
          
      </select>
    </div>
    <!-- <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div> -->

    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select name="post_status" id="post_status">
            <option value="draft">Select Option</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="posy_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea> 
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>