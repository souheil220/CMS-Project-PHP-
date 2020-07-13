<?php

function confirm($queryResult)
{
    global $connection;
    if(!$queryResult){
        die("Error ".mysqli_error($connection));
    }
}

function numberOfRows($tableName){
    global $connection;
    $query = "SELECT * FROM $tableName";
    $select_tableName_query = mysqli_query($connection,$query);
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
