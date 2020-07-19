<?php

function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim(($string)));
}


function user_online()
{
    if (isset($_GET['online_users'])) {
        global $connection;
        if (!$connection) {
            session_start();
            include("../includes/db.php");
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 5;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE user_sessions = '$session'";
            $send_query = mysqli_query($connection, $query);
            confirm($send_query);
            $count = mysqli_num_rows($send_query);


            if ($count == 0) {
                mysqli_query($connection, "INSERT INTO users_online(user_sessions,user_time) VALUES ('$session','$time')");
            } else {
                mysqli_query($connection, "UPDATE users_online SET user_time = '$time' WHERE user_sessions = '$session'");
            }

            $users_online_query  = mysqli_query($connection, "SELECT * FROM users_online WHERE user_time >'$time_out'");

            echo $count_user = mysqli_num_rows($users_online_query);
        }
    }
}


user_online();

function fandLname($post_author)
{
    global $connection;
    $query = "SELECT firstname,user_lastname FROM users WHERE username = '$post_author'";
    $select_all_users = mysqli_query($connection, $query);
    if (!$select_all_users) {
        die("Error " . mysqli_error($select_all_users));
    }
    while ($row1 = mysqli_fetch_assoc($select_all_users)) {
        $firstName = $row1['firstname'];
        $lastName = $row1['user_lastname'];
    }
    echo  $firstName . " " . $lastName;
}

function confirm($queryResult)
{
    global $connection;
    if (!$queryResult) {
        die("Error " . mysqli_error($connection));
    }
}

function countRows($table,$column,$condition)
{
    global $connection;
    $query = "SELECT * FROM $table WHERE $column = '$condition' ";
    $select_all = mysqli_query($connection, $query);
    $count = mysqli_num_rows($select_all);
    return $count;
}

function numberOfRows($tableName)
{
    global $connection;
    $query = "SELECT * FROM $tableName";
    $select_tableName_query = mysqli_query($connection, $query);
    $rowNumbers = mysqli_num_rows($select_tableName_query);

    return $rowNumbers;
}


function insert_categories()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST["cat_title"];

        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories (cat_title) ";
            $query .= "VALUE('{$cat_title}')";

            $create_category_query = mysqli_query($connection, $query);
            if (!$create_category_query) {
                die('QUERY FAILED' . mysqli_errno($connection));
            }
        }
    }
}

function findAllCategories()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $select_all_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_categories)) {
        $cat_id =  $row['cat_id'];
        $cat_title =  $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Update</a></td>";
        echo "</tr>";
    }
}

function deleteCategory()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

function updateCategory($cat_id)
{
    global $connection;
    if (isset($_POST['update_category'])) {
        $the_cat_title = $_POST['cat_title'];
        $query = "UPDATE  categories SET cat_title = '{$the_cat_title}'  WHERE cat_id = {$cat_id} ";
        $update_query = mysqli_query($connection, $query);
        if (!$update_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        }
        header("Location: categories.php");
    }
}
function findASpecificCategories()
{
    global $connection;
    if (isset($_GET['edit'])) {
        $cat_id = $_GET['edit'];
        $query = "SELECT * FROM categories WHERE cat_id= $cat_id";
        $select_categories_id = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_categories_id)) {
            $cat_id =  $row['cat_id'];
            $cat_title_edit =  $row['cat_title'];
?>

            <input value="<?php if (isset($cat_title_edit)) {
                                echo $cat_title_edit;
                            } ?>" class="form-control" type="text" name="cat_title"><?php
                                                                                }
                                                                            }
                                                                        }
