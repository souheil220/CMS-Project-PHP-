<?php
    if(isset($_POST['create_post'])){
       
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category'];
        $post_author = $_POST['author'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        $post_comment_count = 4;

        move_uploaded_file($post_image_temp,"../images/$post_image");

        $query = "INSERT INTO posts (post_title ,post_category_id,post_author,post_status,post_image,post_tags,post_content,post_date,post_comment_count) ";
        $query.= "VALUES ('{$post_title}' ,{$post_category_id},'{$post_author}','{$post_status}','{$post_image}','{$post_tags}','{$post_content}',now(),'{$post_comment_count}' ) ";
        $create_post_query = mysqli_query($connection,$query);
        confirm($create_post_query);
       
    }
?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
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
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="author">Post Status</label>
        <input type="text" class="form-control" name="post_status">
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
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea> 
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>