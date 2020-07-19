<?php
        if(isset($_GET['p_id'])){
            $the_post_id = $_GET['p_id'];
        }

         $query = "SELECT * FROM posts WHERE post_id= $the_post_id";
         $select_posts_by_id = mysqli_query($connection, $query);
     
         while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
            $post_id = $row['post_id'];
            $post_title =  $row['post_title'];
            $post_content=  $row['post_content'];
            $post_author =  $row['post_user'];
            $post_date =  $row['post_date'];
            $post_image =  $row['post_image'];
            $post_category_id =  $row['post_category_id'];
            $post_tags =  $row['post_tags'];
            $post_status =  $row['post_status'];
            $post_comment_count =  $row['post_comment_count'];}

            if (isset($_POST['update_post'])){
                $post_title =  $_POST['post_title'];
                $post_content=  $_POST['post_content'];
                $post_author =  $_POST['users'];
                $post_image =  $_FILES['image']['name'];
                $post_image_temp =  $_FILES['image']['tmp_name'];
                $post_category_id =  $_POST['post_category'];
                $post_tags =  $_POST['post_tags'];
                $post_status =  $_POST['post_status'];
                move_uploaded_file($post_image_temp,"../images/$post_image");

                if(empty($post_image)){
                    $query = "SELECT * FROM posts WHERE post_id= $the_post_id";
                    $select_image = mysqli_query($connection,$query);
                    confirm($select_image);
                    while($row= mysqli_fetch_array($select_image)){
                        $post_image = $row['post_image'];
                    }
                    
                }

                $query = "UPDATE posts SET ";
                $query.= "post_title = '{$post_title}', ";
                $query.= "post_category_id = '{$post_category_id}', ";
                $query.= "post_date = now(), ";
                $query.= "post_user = '{$post_author}', ";
                $query.= "post_status = '{$post_status}', ";
                $query.= "post_tags = '{$post_tags}', ";
                $query.= "post_content = '{$post_content}', ";
                $query.= "post_image = '{$post_image}' ";
                $query.= "WHERE post_id = {$post_id} ";

                $update_user = mysqli_query($connection,$query);

                confirm($update_user);

                echo "<div class='alert alert-success' >Post Edited: <a href='posts.php'>View Posts</a></div>";
            }
              
?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title?>" type="text" class="form-control" name="post_title">
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
                if($cat_id == $post_category_id){
                    echo "<option selected value='$cat_id'>$cat_title_edit</option>";
                }else{
                    echo "<option value='$cat_id'>$cat_title_edit</option>";
                }
                  
                }
          ?>
          
      </select>
    </div>


    <div class="form-group">

    <label for="users">Users</label><br>
      <select name="users" id="users">
    <?php echo "<option value='$post_author'>$post_author</option>";?>
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
        <input value="<?php echo $post_author?>" type="text" class="form-control" name="post_author">
    </div> -->

    <div class="form-group">
        <select name="post_status" id="post_status">
            <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
            <?php
            if ($post_status == 'published') {
                echo "<option value='draft'>draft</option>";
            } else {
                echo "<option value='published'>published</option>";
            }
            ?>


        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label><br>
        <img width="100" src="../images/<?php echo $post_image?>" >
        <input type="file" name="image">
      
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="posy_content">Post Content</label>
        <textarea  class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $post_content?></textarea> 
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>