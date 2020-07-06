<form action="" method="POST">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>
        <?php findASpecificCategories() ?>
        <?php updateCategory($cat_id);?>


    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>