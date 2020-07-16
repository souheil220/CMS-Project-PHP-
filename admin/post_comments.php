<?php include "includes/admin_header.php" ?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navbar.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to comments
                        <small>Author</small>
                    </h1>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Comment Id</th>
                                <th>Comment Post Id</th>
                                <th>Author</th>
                                <th>Comment</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>In Response To</th>
                                <th>Date</th>
                                <th>Approve</th>
                                <th>Unapprove</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $query = "SELECT * FROM comments WHERE comment_post_id = " . mysqli_real_escape_string($connection, $_GET['p_id']) . " ";
                            $select_all_comments = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($select_all_comments)) {
                                $comment_id =  $row['comment_id'];
                                $comment_post_id =  $row['comment_post_id'];
                                $comment_author =  $row['comment_author'];
                                $comment_date =  $row['comment_date'];
                                $comment_email =  $row['comment_email'];
                                $comment_content =  $row['comment_content'];
                                $comment_status =  $row['comment_status'];


                                echo "<tr>";
                                echo "<td>{$comment_id}</td>";
                                echo "<td>{$comment_post_id}</td>";
                                echo "<td>{$comment_author}</td>";

                                //  $query = "SELECT * FROM categories WHERE cat_id= $post_category_id";
                                //  $select_categories_id = mysqli_query($connection, $query);

                                //  while ($row = mysqli_fetch_assoc($select_categories_id)) {
                                //  $cat_id =  $row['cat_id'];
                                //  $cat_title =  $row['cat_title'];
                                //  echo "<td>{$cat_title}</td>";
                                //  } 
                                echo "<td>{$comment_content}</td>";
                                echo "<td>{$comment_email}</td>";
                                echo "<td>{$comment_status}</td>";

                                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                                $select_post_id_query = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                                    $post_id = $row['post_id'];
                                    $post_title = $row['post_title'];

                                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                                }



                                echo "<td>{$comment_date}</td>";
                                echo "<td><a href='?approve=$comment_id&p_id=".$_GET['p_id']."'>Approve</a></td>";
                                echo "<td><a href='?unapproved=$comment_id&p_id=".$_GET['p_id']."'>Unapproved</a></td>";
                                echo "<td><a href='?delete=$comment_id&p_id=".$_GET['p_id']."'>Delete</a></td>";
                                echo "</tr>";
                            }



                            ?>



                        </tbody>
                    </table>
                    <?php

                    if (isset($_GET['unapproved'])) {
                        $the_comment_id = $_GET['unapproved'];
                        $query = "UPDATE comments SET  comment_status = 'Unapproved' WHERE comment_id = $the_comment_id ";
                        $unapproved_comment_query = mysqli_query($connection, $query);

                        confirm($unapproved_comment_query);
                        header("Location: post_comments.php?p_id=".$_GET['p_id']."");
                    }

                    if (isset($_GET['approve'])) {
                        $the_comment_id = $_GET['approve'];
                        $query = "UPDATE comments SET  comment_status = 'Approved' WHERE comment_id = $the_comment_id";
                        $approved_comment_query = mysqli_query($connection, $query);

                        confirm($approved_comment_query);
                        header("Location: post_comments.php?p_id=".$_GET['p_id']."");
                    }


                    if (isset($_GET['delete'])) {
                        $the_comment_id = $_GET['delete'];
                        $query = "DELETE FROM comments where  comment_id = {$the_comment_id} ";
                        $delete_query = mysqli_query($connection, $query);

                        confirm($delete_query);
                        header("Location: post_comments.php?p_id=". $_GET['p_id']."");
                    }
                    ?>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>