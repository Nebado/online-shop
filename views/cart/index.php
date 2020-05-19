<?php include ROOT . '/views/layouts/header.php'; ?>

<div id="mainBody">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div id="sidebar" class="span3">
                <div class="well well-small">
                    <a id="myCart" href="/cart/">
                        <img src="/template/themes/images/ico-cart.png" alt="cart">
                        <span id="cart-count">
                            <?php echo $totalQuantity; ?>
                        </span> Items in your cart 
                        <span class="badge badge-warning pull-right">
                            $<?php echo $totalPrice; ?>
                        </span>
                    </a>
                </div>
                <ul id="sideManu" class="nav nav-tabs nav-stacked">
                    <?php foreach ($categories as $category): ?>
                        <li class="<?php if ($category['id'] == 1) echo 'subMenu open'; ?>">
                            <a href="/catalog/category-<?php echo $category['id'];?>">
                                <?php echo $category['name']; ?>
                            </a>
                            <?php if ($category['id'] == 1): ?>
                                <ul>
                                    <li><a href="/catalog/category-<?php echo $category['id'];?>">All</a></li>
                                    <?php if (isset($subCategories) && is_array($subCategories)): ?>
                                        <?php foreach ($subCategories as $subCategory): ?>
                                            <li>
                                                <a href="/catalog/category-<?php echo $category['id']."-".$subCategory['id'];?>">
                                                    <i class="icon-chevron-right"></i>
                                                        <?php echo $subCategory['name']; ?> 
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <br/>
                <div class="thumbnail">
                    <img src="/template/themes/images/products/panasonic.jpg" alt="Bootshop panasonoc New camera"/>
                    <div class="caption">
                        <h5>Panasonic</h5>
                        <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">$222.00</a></h4>
                    </div>
                </div><br/>
                <div class="thumbnail">
                    <img src="/template/themes/images/products/kindle.png" title="Bootshop New Kindel" alt="Bootshop Kindel">
                    <div class="caption">
                        <h5>Kindle</h5>
                        <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">$222.00</a></h4>
                    </div>
                </div><br/>
                <div class="thumbnail">
                    <img src="/template/themes/images/payment_methods.png" title="Bootshop Payment Methods" alt="Payments Methods">
                    <div class="caption">
                        <h5>Payment Methods</h5>
                    </div>
                </div>
            </div>
            <!-- Sidebar end -->
            <div class="span9">
                <ul class="breadcrumb">
                    <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                    <li class="active"> SHOPPING CART</li>
                </ul>
                <h3>  SHOPPING CART [ <small><?php echo Cart::countItems();?> Item(s) </small>]<a href="/catalog/category-1/" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
                <hr class="soft"/>
                <table class="table table-bordered">
                    <tr><th> I AM ALREADY REGISTERED  </th></tr>
                    <tr> 
                        <td>
                            <form class="form-horizontal" action="/login/" method="post">
                                <div class="control-group">
                                    <label class="control-label" for="inputEmail">Email</label>
                                    <div class="controls">
                                        <input type="text" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputPassword1">Password</label>
                                    <div class="controls">
                                        <input type="password" id="inputPassword1" placeholder="Password">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" class="btn">Sign in</button> OR <a href="/register/" class="btn">Register Now!</a>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <a href="forgetpass.html" style="text-decoration:underline">Forgot password ?</a>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                </table>
                <?php if ($productsInCart != false): ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Quantity/Update</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td> <img width="60" src="<?php echo $product['image'];?>" alt=""/></td>
                                    <td><?php echo $product['title'];?><br/>Color : black, Material : metal</td>
                                    <td>
                                        <div class="input-append">
                                            <input class="span1" style="max-width:34px" placeholder="1" id="appendedInputButtons" value="<?php echo $_SESSION['products'][$product['id']];?>" size="16" type="text">
                                            <a href="/cart/delete/<?php echo $product['id'];?>">
                                                <button class="btn" type="button">
                                                    <i class="icon-minus"></i>
                                                </button>
                                            </a>   
                                            <a href="/cart/add/<?php echo $product['id'];?>">
                                                <button class="btn" type="button">
                                                    <i class="icon-plus"></i>
                                                </button>
                                            </a>
                                            <a href="/cart/deleteProduct/<?php echo $product['id'];?>">
                                                <button class="btn btn-danger" type="button">
                                                    <i class="icon-remove icon-white"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                    <td>$<?php echo $product['price'];?></td>
                                    <td>$<?php echo $_SESSION['products'][$product['id']] * $product['price'];?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4" style="text-align:right"><strong>TOTAL PRICE: </strong></td>
                                <td class="label label-important" style="display:block"> <strong> $<?php echo $totalPrice; ?> </strong></td>
                            </tr>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h3>No Products In Cart</h3>
                <?php endif; ?>
                <a href="/catalog/category-1/" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
                <a href="/cart/checkout/" class="btn btn-large pull-right"><i class="icon-arrow-right right"></i> Next </a>
            </div>
        </div>
    </div>
</div>
<!-- MainBody End ============================= -->

<?php include ROOT . '/views/layouts/footer.php'; ?>