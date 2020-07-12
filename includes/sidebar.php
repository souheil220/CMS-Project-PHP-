<div class="col-md-4">
    
<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="POST">
    <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
</form>
    <!-- /.input-group -->
</div>


<!-- Login -->
<div class="well">
    <h4>Login</h4>
    <form action="includes/login.php" method="POST">
    <div class="form-group">
        <input name="username" type="text" class="form-control" placeholder="Enter Username">
        
    </div>
    <div class="form-group">
        <input name="password" type="password" class="form-control" placeholder="Enter Password">
        
    </div>
    <span class="input-group-btn">
            <button name="login" class="btn btn-primary" type="submit">
                <span class="glyphicon glyphicon-log-in"> Login</span>
        </button>
        </span>
</form>
    <!-- /.input-group -->
</div>


<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <?php
         $query = "SELECT * FROM categories LIMIT 3";
         $select_all_categories_sidebar = mysqli_query($connection,$query);

         
    ?>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <?php
                 while($row=mysqli_fetch_assoc($select_all_categories_sidebar)){
               $cat_title=  $row['cat_title'];
               $cat_id=  $row['cat_id'];
               echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
         } 
                ?>
            
            </ul>
        </div>
       
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "widget.php"?>

</div>