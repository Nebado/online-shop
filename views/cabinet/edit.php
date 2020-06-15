<?php include ROOT . '/views/layouts/header.php'; ?>

<!-- Main -->
<div id="mainBody">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h3> Edit Personal Information</h3>
                <hr class="soft"/>
                <div class="row">
                    <div class="span9">
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
                                            <input type="text" name="state" id="state" value="<?php echo $state;?>" placeholder="State"/>
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
                                            <input type="text" name="country" id="country" value="<?php echo $country;?>" placeholder="Country"/> 
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
                                            <input type="text"  name="phone" id="phone" value="<?php echo $phone;?>" placeholder="Phone"/> <span>You must register at least one phone number</span>
                                        </div>
                                    </div>

                                    <p><sup>*</sup>Required field</p>

                                    <div class="control-group">
                                        <div class="controls">
                                            <input class="btn btn-large btn-success" type="submit" name="submit" value="Edit" />
                                        </div>
                                    </div>		
                                </form>
                            <?php else: ?>
                                <p>Our information is updated!</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>	
            </div>
        </div>
    </div>
</div>
<!-- MainBody End -->

<?php include ROOT . '/views/layouts/footer.php'; ?>
