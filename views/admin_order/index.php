<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Admin Panel</a></li>
                    <li class="active">Manage Orders</li>
                </ol>
            </div>

            <h4>List of Orders</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID Order:</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($ordersList as $order): ?>
                    <tr>
                        <td><?php echo $order['id'];?></td>
                        <td><?php echo $order['user_name'];?></td>
                        <td><?php echo $order['date'];?></td>
                        <td><?php echo $order['status'];?></td>
                        <td><a href="/admin/order/view/<?php echo $order['id'];?>" title="View">View</a></td>
                        <td><a href="/admin/order/update/<?php echo $order['id'];?>" title="Edit">Edit</a></td>
                        <td><a href="/admin/order/delete/<?php echo $order['id'];?>" title="Edit">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
