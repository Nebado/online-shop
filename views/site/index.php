<?php include ROOT . '/views/layouts/header.php'; ?>

<?php
use \App\models\Category;
use \App\models\Product;

?>

<!-- Carousel -->
<div id="carouselBlk">
    <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">
            <div class="item active">
                <div class="container">
                    <a href="/register/"><img src="/template/themes/images/carousel/3.png" alt=""/></a>
                    <div class="carousel-caption">
                        <h4>Second Thumbnail label</h4>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="container">
                    <a href="/register/"><img src="/template/themes/images/carousel/4.png" alt=""/></a>
                    <div class="carousel-caption">
                        <h4>Second Thumbnail label</h4>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="container">
                    <a href="/register/"><img src="/template/themes/images/carousel/5.png" alt=""/></a>
                    <div class="carousel-caption">
                        <h4>Second Thumbnail label</h4>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="container">
                    <a href="/register/"><img src="/template/themes/images/carousel/6.png" alt=""/></a>
                    <div class="carousel-caption">
                        <h4>Second Thumbnail label</h4>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div> 
</div>
<!-- Carousel End -->

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
                        <li class="subMenu">
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
                <div class="thumbnail">
                    <img src="/template/themes/images/payment_methods.png" title="Bootshop Payment Methods" alt="Payments Methods">
                    <div class="caption">
                        <h5>Payment Methods</h5>
                    </div>
                </div>
            </div>
            <!-- Sidebar End -->

            <!-- Latest Products -->
            <div class="span9">		
                <h4>Latest Products </h4>
                <ul class="thumbnails">
                    <?php if (isset($latestProducts) && (is_array($latestProducts))): ?>
                        <?php foreach ($latestProducts as $product): ?>
                            <li class="span3">
                                <div class="thumbnail">
                                    <?php if ($product['is_new']):?>
                                       <i class="tag"></i>
                                    <?php endif;?>
                                    <a  href="/product/<?php echo $product['id'];?>">
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
                <!-- Latest Products End -->
                
                <!-- Featured Products -->
                <div class="well well-small">
                    <h4>Featured Products <small class="pull-right"><?php echo $totalFeaturedProducts;?> featured products</small></h4>           
                    <div class="cycle-slideshow" 
                         data-cycle-fx=carousel
                         data-cycle-timeout=5000
                         data-cycle-carousel-visible=3
                         data-cycle-carousel-fluid=true
                         data-cycle-slides="div.item"
                         data-cycle-prev="#prev"
                         data-cycle-next="#next"
                         >                        
                        <?php foreach ($sliderProducts as $sliderItem): ?>
                            <div class="item">
                                <ul class="thumbnails">
                                    <li class="span3">
                                        <div class="thumbnail">
                                            <?php if ($sliderItem['is_new']): ?>
                                                <i class="tag"></i>
                                            <?php endif; ?>
                                            <a href="/product/<?php echo $sliderItem['id'];?>">
                                                <img class="product" src="<?php echo Product::getImage($sliderItem['id']); ?>" alt="">
                                            </a>
                                            <div class="caption">
                                                <h5><?php echo $sliderItem['name'];?></h5>
                                                <h4 style="text-align:center">
                                                    <a class="btn" href="/product/<?php echo $sliderItem['id'];?>">
                                                        <i class="icon-zoom-in"></i>
                                                    </a>
                                                    <a class="btn add-to-cart" data-id="<?php echo $sliderItem['id'];?>" href="#">Add to
                                                        <i class="icon-shopping-cart"></i>
                                                    </a>
                                                    <a class="btn btn-primary" href="#">
                                                        $<?php echo $sliderItem['price'];?>
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>    
                                    </li>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                        <a class="left carousel-control" id="prev" href="#featured" data-slide="prev">‹</a>
                        <a class="right carousel-control" id="next"  href="#featured" data-slide="next">›</a>
                    </div>
                </div>
                <!--/Featured Products-->
            </div>
        </div>
    </div>
</div>
<!-- Main End -->

<?php include ROOT . '/views/layouts/footer.php'; ?>
