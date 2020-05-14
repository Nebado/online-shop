<?php include ROOT . '/views/layouts/header.php'; ?>

<div id="mainBody">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div id="sidebar" class="span3">
                <div class="well well-small"><a id="myCart" href="product_summary.html"><img src="/template/themes/images/ico-cart.png" alt="cart">3 Items in your cart  <span class="badge badge-warning pull-right">$155.00</span></a></div>
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
            <!-- Sidebar End -->
            <div class="span9">
                <ul class="breadcrumb">
                    <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                    <li class="active">Registration</li>
                </ul>
                <h3> Registration</h3>	
                <div class="well">
                    <?php if (!$result): ?>
                        <?php if (isset($errors) && (is_array($errors)) && (!empty($errors))): ?>
                            <div class="alert-block alert-error fade in">
                                <?php foreach ($errors as $error): ?>
                                    <ul>
                                        <li> - <?php echo $error; ?></li>
                                    </ul>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <!--
                        <div class="alert alert-info fade in">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                         </div>
                        <div class="alert fade in">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                         </div>
                         <div class="alert alert-block alert-error fade in">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                         </div> -->
                        <form class="form-horizontal" action="" method="post">
                            <h4>Your personal information</h4>
                            <div class="control-group">
                                <label class="control-label" for="inputFname1">First name <sup>*</sup></label>
                                <div class="controls">
                                    <input type="text" name="firstName" id="inputFname1" value="<?php echo $firstName;?>" placeholder="First Name">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputLname">Last name <sup>*</sup></label>
                                <div class="controls">
                                    <input type="text" name="lastName" id="inputLname" value="<?php echo $lastName;?>" placeholder="Last Name">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="input_email">Email <sup>*</sup></label>
                                <div class="controls">
                                    <input type="text" name="email" id="input_email" value="<?php echo $email;?>" placeholder="Email">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputPassword1">Password <sup>*</sup></label>
                                <div class="controls">
                                    <input type="password" name="password" id="inputPassword1" value="<?php echo $password;?>" placeholder="Password">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Date of Birth <sup>*</sup></label>
                                <div class="controls">
                                    <input type="date" name="birth" value="<?php echo $birth;?>" placeholder="dd-mm-y" />
                                </div>
                            </div>
                            <h4>Your address</h4>
                            <div class="control-group">
                                <label class="control-label" for="company">Company</label>
                                <div class="controls">
                                    <input type="text" name="company" id="company" value="<?php echo $company;?>" placeholder="company"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="address">Address<sup>*</sup></label>
                                <div class="controls">
                                    <input type="text" name="address" id="address" value="<?php echo $address;?>" placeholder="Adress"/> <span>Street address, P.O. box, company name, c/o</span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="city">City<sup>*</sup></label>
                                <div class="controls">
                                    <input type="text" name="city" id="city" value="<?php echo $city;?>" placeholder="city"/> 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="state">State<sup>*</sup></label>
                                <div class="controls">
                                    <select id="state" name="state[]">
                                        <option value="">-</option>
                                        <option value="1">Alabama</option>
                                        <option value="2">Alaska</option>
                                        <option value="3">Arizona</option>
                                        <option value="4">Arkansas</option>
                                        <option value="5">California</option>
                                    </select>
                                </div>
                            </div>	
                            <div class="control-group">
                                <label class="control-label" for="postcode">Zip / Postal Code<sup>*</sup></label>
                                <div class="controls">
                                    <input type="text" name="postcode" id="postcode" value="<?php echo $postcode;?>" placeholder="Zip / Postal Code"/> 
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="country">Country<sup>*</sup></label>
                                <div class="controls">
                                    <select id="country" name="country[]">
                                        <option value="">-</option>
                                        <option value="1">Country</option>
                                    </select>
                                </div>
                            </div>	
                            <div class="control-group">
                                <label class="control-label" for="aditionalInfo">Additional information</label>
                                <div class="controls">
                                    <textarea name="info" id="aditionalInfo" cols="26" rows="3">Additional information</textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="phone">Mobile phone <sup>*</sup></label>
                                <div class="controls">
                                    <input type="text"  name="phone" id="phone" value="<?php echo $phone;?>" placeholder="phone"/> <span>You must register at least one phone number</span>
                                </div>
                            </div>

                            <p><sup>*</sup>Required field	</p>

                            <div class="control-group">
                                <div class="controls">
                                    <input type="hidden" name="email_create" value="1">
                                    <input type="hidden" name="is_new_customer" value="1">
                                    <input class="btn btn-large btn-success" type="submit" name="submit" value="Register" />
                                </div>
                            </div>		
                        </form>
                    <?php else: ?>
                        <p>You are registered! Welcome!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MainBody End ============================= -->

<?php include ROOT . '/views/layouts/footer.php'; ?>
