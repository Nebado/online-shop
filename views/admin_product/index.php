<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Admin Panel</a></li>
                    <li class="active">Manage Products</li>
                </ol>
            </div>

            <a href="/admin/product/create" class="btn btn-default back"><i class="fa fa-plus"></i>Add product</a>

            <h4>List of Products</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID Product:</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($productsList as $product): ?>
                    <tr>
                        <td><?php echo $product['id'];?></td>
                        <td><?php echo $product['code'];?></td>
                        <td><?php echo $product['name'];?></td>
                        <td><?php echo $product['price'];?></td>
                        <td><a href="/admin/product/update/<?php echo $product['id'];?>" title="Edit">Edit</a></td>
                        <td><a href="/admin/product/delete/<?php echo $product['id'];?>" title="Edit">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
