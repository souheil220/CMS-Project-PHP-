<?php
        if(isset($_GET['u_id'])){
            $the_user_id = $_GET['u_id'];
        }

         $query = "SELECT * FROM users WHERE user_id= $the_user_id";
         $select_users_by_id = mysqli_query($connection, $query);
     
         while ($row = mysqli_fetch_assoc($select_users_by_id)) {
           
            $username =  $row['username'];
            $firstName=  $row['firstname'];
            $lastName =  $row['user_lastname'];
            $role =  $row['user_role'];
            $avatar =  $row['user_image'];
            $user_email =  $row['user_email'];
            $user_role =  $row['user_role'];
           }

            if (isset($_POST['update_user'])){
                $username = $_POST['username'];
                $user_role = $_POST['user_role'];
                $firstName = $_POST['firstName'];
                $user_lastName = $_POST['user_lastName'];
                $avatar = $_FILES['user_image']['name'];
                $avatar_temp = $_FILES['user_image']['tmp_name'];
                $user_email = $_POST['user_email'];
                $password = $_POST['password'];

                if(empty($avatar)){
                    $query = "SELECT * FROM users WHERE user_id= $the_user_id";
                    $select_image = mysqli_query($connection,$query);
                    confirm($select_image);
                    while($row= mysqli_fetch_array($select_image)){
                        $avatar = $row['user_image'];
                    }
                    
                }

                $query = "UPDATE users SET ";
                $query.= "username = '{$username}', ";
                $query.= "user_role = '{$user_role}', ";
                $query.= "firstname = '{$firstName}', ";
                $query.= "user_lastname = '{$user_lastName}', ";
                $query.= "user_image = '{$avatar}', ";
                $query.= "user_email = '{$user_email}', ";
                $query.= "user_password = '{$password}' ";
                $query.= "WHERE user_id = {$the_user_id} ";

                $update_post = mysqli_query($connection,$query);

                confirm($update_post);
            }
              
?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">User Name</label>
        <input value="<?php echo $username ?>" type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
      <select name="user_role" id="user_role">
      <option value="subscriber"><?php echo $role?></option>
      <?php
            if($role == 'admin'){
                echo "<option value='subscriber'>Subscriber</option>";
            }else{
                echo "<option value='admin'>Admin</option>";
            }
      ?>
          
          
      </select>
    </div>

    <div class="form-group">
        <label for="firstName">First Name</label>
        <input value="<?php echo $firstName?>" type="text" class="form-control" name="firstName">
    </div>

    <div class="form-group">
        <label for="user_lastName">Last Name</label>
        <input value="<?php echo $lastName?>" type="text" class="form-control" name="user_lastName">
    </div>

    <div class="form-group">
        <label for="user_image">Avatar</label><br>
        <img width="100" src="../images/<?php echo $avatar?>" alt="">
        <input type="file" name="user_image">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input value="<?php echo $user_email?>" type="text" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id=""></input> 
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update">
    </div>
</form>