<?php include ROOT . '/views/layouts/header.php' ?>

<!-- Main -->
<div id="mainBody">
	<div class="container">
	<div class="row">
	    <div class="span12">
            <ul class="breadcrumb">
		        <li><a href="/">Home</a> <span class="divider">/</span></li>
		        <li class="active">Forget password?</li>
            </ul>
	        <h3> FORGET YOUR PASSWORD?</h3>	
	        <hr class="soft"/>
	
	<div class="row">
		<div class="span12" style="min-height:900px">
			<div class="well">
			<h5>Reset your password</h5><br/>
			Please enter the email address for your account. A verification code will be sent to you. Once you have received the verification code, you will be able to choose a new password for your account.<br/><br/><br/>
            <?php if ($result): ?>
                <h4>We sent a new password to your mail! Thank you!</h4>
            <?php else: ?>
                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul style="color:#ff0000;">
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
			    <form action="" method="post">
			        <div class="control-group">
				        <label class="control-label" for="inputEmail1">E-mail address</label>
				        <div class="controls">
				            <input class="span3" name="email" type="text" id="inputEmail1" placeholder="Email">
				        </div>
			        </div>
			        <div class="controls">
			            <button type="submit" name="submit" class="btn block">Submit</button>
			        </div>
			    </form>
            <?php endif; ?>
		</div>
		</div>
	</div>	
	
</div>
</div>
</div>
</div>
<!-- MainBody End -->

<?php include ROOT . '/views/layouts/footer.php' ?>
