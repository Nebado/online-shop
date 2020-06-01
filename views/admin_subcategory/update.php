<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Admin Panel</a></li>
                    <li><a href="/admin/category">Manage Categories</a></li>
                    <li class="active">Edit SubCategory</li>
                </ol>
            </div>

            <h4>Edit the SubCategory</h4>

            <br/>
            <?php if(isset($errors) && (is_array($errors))): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li style="color: red;"> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <form class="form-horizontal" action="" method="post">
                <div class="control-group">
                    <label class="control-label" for="name">Name <sup>*</sup></label>
                    <div class="controls">
                        <input type="text" name="name" id="name" value="<?php echo $subcategory['name'];?>" placeholder="Name">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sortOrder">Sort Order <sup>*</sup></label>
                    <div class="controls">
                        <input type="text" name="sortOrder" id="sortOrder" value="<?php echo $subcategory['sort_order'];?>" placeholder="Order">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="categoryId">Category ID: <sup>*</sup></label>
                    <div class="controls">
                        <input type="text" name="categoryId" id="sortOrder" value="<?php echo $subcategory['category_id'];?>" placeholder="Order">
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="status">Status</label>
                    <div class="controls">
                        <select id="status" name="status">
                            <option value="1" <?php if ($subcategory['status'] == 1) echo ' selected="selected"'; ?>>Showed</option>
                            <option value="0" <?php if ($subcategory['status'] == 0) echo ' selected="selected"'; ?>>Hidden</option>
                        </select>
                    </div>
                </div>
                <br/><br/>
                <input type="submit" name="submit" class="btn btn-default" value="Save" />    
                <br/><br/>
            </form>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>