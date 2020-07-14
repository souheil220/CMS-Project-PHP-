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
                        Welcome To Admin
                        <small> <?php echo $_SESSION['username'] ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->




            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php
                                    $postNumbers = numberOfRows('posts');
                                    echo "<div class='huge'>$postNumbers</div>";

                                    ?>



                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $commentNumbers = numberOfRows('comments');
                                    echo "<div class='huge'>$commentNumbers</div>";
                                    ?>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $userNumber = numberOfRows('users');
                                    echo "<div class='huge'>$userNumber</div>";
                                    ?>
                                    <div> User(s)</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $categoriesNumbers = numberOfRows('categories');
                                    echo "<div class='huge'>$categoriesNumbers</div>";

                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <?php
                $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
                $select_all_drafted_posts = mysqli_query($connection,$query);
                $post_draft_count = mysqli_num_rows($select_all_drafted_posts);
                
                $query = "SELECT * FROM posts WHERE post_status = 'published' ";
                $select_all_published_posts = mysqli_query($connection,$query);
                $post_published_count = mysqli_num_rows($select_all_published_posts);
                
                $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
                $select_all_unapproved_comments = mysqli_query($connection,$query);
                $unapproved_comment_count = mysqli_num_rows($select_all_unapproved_comments);
                
                $query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
                $select_all_subscriber_users = mysqli_query($connection,$query);
                $subscriber_user_count = mysqli_num_rows($select_all_subscriber_users);


            
            ?>



            <!-- /.row -->
            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['data', 'count'],

                            <?php
                            $element_text = ["Posts","Published Posts","Drafted Pots", "Comments","Pending Comments", "Users", "Subscribers", "Categories"];
                            $element_count = [$postNumbers,$post_published_count,$post_draft_count , $commentNumbers,$unapproved_comment_count, $userNumber,$subscriber_user_count, $categoriesNumbers];

                            for ($i = 0; $i < sizeof($element_text); $i++) {
                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]},],";
                            }

                            ?>

                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>