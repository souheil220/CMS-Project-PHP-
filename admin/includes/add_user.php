<?php
    if(isset($_POST['add_user'])){
       
        $username = $_POST['username'];
        $user_role = $_POST['user_role'];
        $firstName = $_POST['firstName'];
        $user_lastName = $_POST['user_lastName'];
        $avatar = $_FILES['user_image']['name'];
        $avatar_temp = $_FILES['user_image']['tmp_name'];
        $user_email = $_POST['user_email'];
        $password = $_POST['password'];

        move_uploaded_file($avatar_temp,"../images/$avatar");

        $query = "INSERT INTO users (username ,user_role,firstname,user_lastname,user_image,user_email,user_password) ";
        $query.= "VALUES ('{$username}' ,'{$user_role}','{$firstName}','{$user_lastName}','{$avatar}','{$user_email}','{$password}' ) ";
        $create_user_query = mysqli_query($connection,$query);
        confirm($create_user_query);
       
    }
?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
      <select name="user_role" id="user_role">
      <option value='subscriber'>Select Option</option>
          <option value='admin'>Admin</option>
          <option value='subscriber'>Subscriber</option>
      </select>
    </div>

    <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" class="form-control" name="firstName">
    </div>

    <div class="form-group">
        <label for="user_lastName">Last Name</label>
        <input type="text" class="form-control" name="user_lastName">
    </div>

    <div class="form-group">
        <label for="user_image">Avatar</label>
        <input type="file" name="user_image">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id=""></input> 
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="add_user" value="Add User">
    </div>
</form>