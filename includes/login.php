<?php include "db.php" ?>
<?php session_start()?>
<?php
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $pass = $_POST["password"];

    $username = mysqli_real_escape_string($connection, $username);
    $pass = mysqli_real_escape_string($connection, $pass);

    $query = "SELECT * FROM users WHERE username = '$username' ";
    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {
        die('Error : ' . mysqli_errno($connection));
    }

    while ($row = mysqli_fetch_array($select_user_query)) {
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_pass = $row['user_password'];
        $firstName = $row['firstname'];
        $lastName = $row['user_lastname'];
        $role = $row['user_role'];
    }


    $pass = crypt($pass, $db_pass);



    if ($username !== $db_username || $pass !== $db_pass) {

          header("Location: ../index.php");

    } else {

        $_SESSION['username'] = $db_username;
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['role'] = $role;
        if ($_SESSION['role'] === 'admin') {

            header("Location: ../admin");
        } else {
            header("Location: ../index.php");
        }
    }
}
?>