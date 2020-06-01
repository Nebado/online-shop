<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Admin Panel</a></li>
                    <li><a href="/admin/category">Manage Categories</a></li>
                    <li class="active">Create SubCategory</li>
                </ol>
            </div>

            <h4>Add new SubCategory</h4>

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
                        <input type="text" name="name" id="name" value="" placeholder="Name">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="categoryId">Category ID: <sup>*</sup></label>
                    <div class="controls">
                        <input type="text" name="categoryId" id="name" value="" placeholder="Category ID">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sortOrder">Sort Order <sup>*</sup></label>
                    <div class="controls">
                        <input type="text" name="sortOrder" id="sortOrder" value="" placeholder="Order">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="status">Status</label>
                    <div class="controls">
                        <select id="status" name="status">
                            <option value="1" selected="selected">Showed</option>
                            <option value="0">Hidden</option>
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


