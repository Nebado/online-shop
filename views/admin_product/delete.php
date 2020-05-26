<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Admin Panel</a></li>
                    <li><a href="/admin/product">Manage Products</a></li>
                    <li class="active">Delete Product</li>
                </ol>
            </div>

            <h4>Delete the product # <?php echo $id; ?></h4>

            <br/>

            <p>Are sure that delete this product?</p>
            <form method="post">
                <input type="submit" name="submit" value="Delete" />
            </form>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

