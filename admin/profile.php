<?php include "includes/admin_header.php" ?>

<?php
    if(isset($_SESSION['username'])){
            $user= $_SESSION['username'];
            $query = "SELECT * FROM users WHERE username = '$user' ";
            $select_user_profile_query = mysqli_query($connection,$query);

            while ($row = mysqli_fetch_array($select_user_profile_query)) {
                $user_id =  $row['user_id'];
                $username =  $row['username'];
                $firstName =  $row['firstname'];
                $lastName =  $row['user_lastname'];
                $user_email =  $row['user_email'];
                $user_image =  $row['user_image'];
                $role =  $row['user_role'];
            }
    }
?>

<?php 
    if (isset($_POST['update_user'])) {
        $username = $_POST['username'];
        $firstName = $_POST['firstName'];
        $user_lastName = $_POST['user_lastName'];
        $avatar = $_FILES['user_image']['name'];
        $avatar_temp = $_FILES['user_image']['tmp_name'];
        $user_email = $_POST['user_email'];
        $password = $_POST['password'];
    
        if (empty($avatar)) {
            $query = "SELECT * FROM users WHERE username= '$user'";
            $select_image = mysqli_query($connection, $query);
            confirm($select_image);
            while ($row = mysqli_fetch_array($select_image)) {
                $avatar = $row['user_image'];
            }
        }
    
        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "firstname = '{$firstName}', ";
        $query .= "user_lastname = '{$user_lastName}', ";
        $query .= "user_image = '{$avatar}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$password}' ";
        $query .= "WHERE username = '{$user}' ";
    
        $update_post = mysqli_query($connection, $query);

        $_SESSION['username'] = $username;
    
        confirm($update_post);
    }
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navbar.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small>Author</small>
                    </h1>
                    <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">User Name</label>
        <input value="<?php echo $username ?>" type="text" class="form-control" name="username">
    </div>

    
    <div class="form-group">
        <label for="firstName">First Name</label>
        <input value="<?php echo $firstName ?>" type="text" class="form-control" name="firstName">
    </div>

    <div class="form-group">
        <label for="user_lastName">Last Name</label>
        <input value="<?php echo $lastName ?>" type="text" class="form-control" name="user_lastName">
    </div>

    <div class="form-group">
        <label for="user_image">Avatar</label><br>
        <img width="100" src="../images/<?php echo $user_image ?>" alt="">
        <input type="file" name="user_image">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input value="<?php echo $user_email ?>" type="text" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input autocomplete="off" type="password" class="form-control" name="password" id=""></input>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update Profile">
    </div>
</form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>