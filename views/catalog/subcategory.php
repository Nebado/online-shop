<?php include ROOT . '/views/layouts/header.php'; ?>

<?php
use \App\models\Category;
use \App\models\Product;

?>

<!-- Main -->
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
                        <li class="subMenu<?php if ($category['id'] == $categoryId) echo 'open';?>">
                            <a href="#">
                                <?php echo $category['name']; ?>
                            </a>
                            <ul>
                                <li><a href="/catalog/category-<?php echo $category['id'];?>">All</a></li>
                                <?php if (!empty(Category::getSubCategoriesList($category['id'])) && is_array(Category::getSubCategoriesList($category['id']))): ?>
                                    <?php foreach (Category::getSubCategoriesList($category['id']) as $subCategory): ?>
                                        <li>
                                            <a href="/catalog/category-<?php echo $category['id']."-".$subCategory['id'];?>">
                                                <i class="icon-chevron-right"></i>
                                                    <?php echo $subCategory['name']; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <br/>
            </div>
            <!-- Sidebar end -->
            <div class="span9">
                <ul class="breadcrumb">
                    <li><a href="/">Home</a> <span class="divider">/</span></li>
                    <li class="active">Products Name</li>
                </ul>
                <h3><?php echo Category::getSubCategoryName($categoryId, $subCategoryId); ?>
                    <small class="pull-right"> 40 products are available </small>
                </h3>	
                <hr class="soft"/>
                <p>
                    Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies - that is why our goods are so popular and we have a great number of faithful customers all over the country.
                </p>
                <hr class="soft"/>
                <form class="form-horizontal span6">
                    <div class="control-group">
                        <label class="control-label alignL">Sort By </label>
                        <select>
                            <option>Priduct name A - Z</option>
                            <option>Priduct name Z - A</option>
                            <option>Priduct Stoke</option>
                            <option>Price Lowest first</option>
                        </select>
                    </div>
                </form>

                <div id="myTab" class="pull-right">
                    <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
                    <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
                </div>
                <br class="clr"/>
                <!-- Content -->
                <div class="tab-content">
                    <!-- Content list -->
                    <div class="tab-pane" id="listView">
                        <?php if (isset($subCategoryProducts) && is_array($subCategoryProducts)): ?>
                            <?php foreach ($subCategoryProducts as $product): ?>
                                <div class="row">
                                    <div class="span2">
                                        <img class="product" src="<?php echo Product::getImage($product['id']); ?>" alt=""/>
                                    </div>
                                    <div class="span4">
                                        <h3>
                                            <?php if ($product['is_new']): ?>
                                                New |
                                            <?php endif; ?>
                                            <?php if ($product['availability']): ?>
                                                Available
                                            <?php endif; ?>
                                        </h3>			  
                                        <hr class="soft"/>
                                        <h4><?php echo $product['name'];?></h4>
                                        <p>
                                            <?php echo $product['title']; ?>
                                        </p>
                                        <a class="btn btn-small pull-right" href="/product/<?php echo $product['id'];?>">View Details</a>
                                        <br class="clr"/>
                                    </div>
                                    <div class="span3 alignR">
                                        <form class="form-horizontal qtyFrm">
                                            <h3> $<?php echo $product['price'];?></h3>
                                            <label class="checkbox">
                                                <input type="checkbox">  Adds product to compair
                                            </label><br/>

                                            <a href="/product/<?php echo $product['id'];?>" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                                            <a href="/product/<?php echo $product['id'];?>" class="btn btn-large"><i class="icon-zoom-in"></i></a>

                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No products</p>
                        <?php endif; ?>
                        <hr class="soft"/>
                    </div>
                    <!-- Content list end -->
                    <!-- Content block -->
                    <div class="tab-pane  active" id="blockView">
                        <ul class="thumbnails">
                            <?php if (isset($subCategoryProducts) && is_array($subCategoryProducts)): ?>
                                <?php foreach ($subCategoryProducts as $product): ?>
                                    <li class="span3">
                                        <div class="thumbnail">
                                            <a href="/product/<?php echo $product['id'];?>">
                                                <img class="product" src="<?php echo Product::getImage($product['id']); ?>" alt=""/>
                                            </a>
                                            <div class="caption">
                                                <h5><?php echo $product['name'];?></h5>
                                                <h4 style="text-align:center">
                                                    <a class="btn" href="/product/<?php echo $product['id'];?>"> 
                                                        <i class="icon-zoom-in"></i>
                                                    </a> 
                                                    <a class="btn add-to-cart" data-id="<?php echo $product['id'];?>" href="#">Add to
                                                        <i class="icon-shopping-cart"></i>
                                                    </a>
                                                    <a class="btn btn-primary" href="#">
                                                        $<?php echo $product['price'];?>
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                        <hr class="soft"/>
                    </div>
                    <!-- Content block end-->
                </div>
                <!-- Content end -->
                <a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
                <!-- Pagination -->
                <?php echo $pagination->get(); ?>
                <!-- Pagination end -->
                <br class="clr"/>
            </div>
        </div>
    </div>
</div>
<!-- MainBody end -->
<?php include ROOT . '/views/layouts/footer.php'; ?>
