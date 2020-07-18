<?php include "includes/header.php"?>
<?php include "includes/db.php"?>
    <!-- Navigation -->
<?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">


            

            <?php
                $per_page = 5;
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }else{
                    $page = 1;
                }

                if($page == 1){
                    $page_1  = 0;
                }else{
                    $page_1 = ($page * $per_page) - $per_page;
                }

                $select_post_count = "SELECT * FROM posts where post_status = 'published' " ;
                $find_count = mysqli_query($connection,$select_post_count);
                $count = mysqli_num_rows($find_count);

                $count = ceil($count / $per_page) ;

                $query = "SELECT * FROM posts WHERE post_status='published' LIMIT $page_1,$per_page";
                $select_all_posts_query = mysqli_query($connection,$query);
                if(mysqli_num_rows($select_all_posts_query)<=0){
                    echo"<h1 class=text-center>Sorry No Posts</h1>";
                }else
                {
                    while($row=mysqli_fetch_assoc($select_all_posts_query)){
                    $post_id=  $row['post_id'];
                    $post_title=  $row['post_title'];
                    $post_author=  $row['post_user'];
                    $query1 = "SELECT firstname,user_lastname FROM users WHERE username = '$post_author'";
                    $select_all_users = mysqli_query($connection,$query1);
                    if(!$select_all_users){
                        die("Error ".mysqli_error($select_all_users));
                    }
                    while($row1=mysqli_fetch_assoc($select_all_users)){
                        $firstName = $row1['firstname'];
                        $lastName = $row1['user_lastname'];

                    }
                    $post_date=  $row['post_date'];
                    $post_image=  $row['post_image'];
                    $post_content= substr($row['post_content'],0,300) ;
                    $post_status = $row['post_status'];


                    if($post_status!=='published'){
                       
                   // break;
                    }else{
                    ?>
                    <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id?>"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $post_author?>"><?php fandLname($post_author);?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                   
           <?php   } }   
                }?>
                
           

                




                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php"?>

        </div>
        <!-- /.row -->

        <hr>

        <ul class="pager">

                <?php
                    for($i=1;$i<=$count;$i++){
                        
                       
                        if($i==$page){
                            echo "<li><a class='active_link href='index.php?page=$i'>$i</a></li>";
                        }else{
                            echo "<li><a href='index.php?page=$i'>$i</a></li>";
                        }
                        
                    }
                ?>
        </ul>

   <?php include "includes/footer.php"?>