<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Admin Panel</a></li>
                    <li><a href="/admin/order">Manage Orders</a></li>
                    <li class="active">View Product</li>
                </ol>
            </div>
            
            <h4>View the order</h4>
            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID Order:</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Comment</th>
                    <th>UserID:</th>
                    <th>Date</th>
                    <th>Products</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php if ($order): ?>
                    <tr>
                        <td><?php echo $order['id'];?></td>
                        <td><?php echo $order['user_name'];?></td>
                        <td><?php echo $order['user_phone'];?></td>
                        <td><?php echo $order['user_comment'];?></td>
                        <td><?php echo $order['user_id'];?></td>
                        <td><?php echo $order['date'];?></td>
                        <td><?php echo $order['products'];?></td>
                        <td><?php echo $order['status'];?></td>
                        <td><a href="/admin/order/update/<?php echo $order['id'];?>" title="Edit">Edit</a></td>
                        <td><a href="/admin/order/delete/<?php echo $order['id'];?>" title="Edit">Delete</a></td>
                    </tr>
                <?php endif; ?>
            </table>
            <br/><br/>
            <h5>Products:</h5>
                    <table class="table-bordered table-striped table">
                        <tr>
                            <th>ID Product:</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo $product['id'];?></td>
                                <td><?php echo $product['name'];?></td>
                                <td><?php echo $product['code'];?></td>
                                <td><?php echo $product['title'];?></td>
                                <td><?php echo $product['price'];?></td>
                                <td><?php echo $quantity[$product['id']];?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="5" style="text-align:right"><strong>TOTAL PRICE: </strong></td>
                            <td style="display:block"> <strong> $<?php echo $totalPrice; ?> </strong></td>
                        </tr>
                    </table>
                <br/><br/>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>


