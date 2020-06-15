<?php include ROOT . '/views/layouts/header.php'; ?>

<!-- Main -->
<div id="mainBody">
    <div class="container">
        <hr class="soften">
        <h1>Visit us</h1>
        <hr class="soften"/>	
        <div class="row">
            <div class="span4">
                <h4>Contact Details</h4>
                <p>	18 Fresno,<br/> CA 93727, USA
                    <br/><br/>
                    info@rootsshop.com<br/>
                    ﻿Tel 123-456-6780<br/>
                    Fax 123-456-5679<br/>
                    web:rootsshop.com
                </p>		
            </div>

            <div class="span4">
                <h4>Opening Hours</h4>
                <h5> Monday - Friday</h5>
                <p>09:00am - 09:00pm<br/><br/></p>
                <h5>Saturday</h5>
                <p>09:00am - 07:00pm<br/><br/></p>
                <h5>Sunday</h5>
                <p>12:30pm - 06:00pm<br/><br/></p>
            </div>
            <div class="span4">
                <h4>Email Us</h4>
                <?php if ($result == false) : ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <?php foreach ($errors as $error): ?>
                            <ul>
                                <li> - <?php echo $error; ?></li>
                            </ul>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <form class="form-horizontal" action="" method="post">
                        <fieldset>
                            <div class="control-group">
                                <input type="text" name="name" placeholder="name" class="input-xlarge"/>
                            </div>
                            <div class="control-group">
                                <input type="text" name="email" placeholder="email" class="input-xlarge"/>
                            </div>
                            <div class="control-group">
                                <input type="text" name="subject" placeholder="subject"  class="input-xlarge"/>
                            </div>
                            <div class="control-group">
                                <textarea rows="3" id="textarea" name="message" class="input-xlarge"></textarea>
                            </div>
                            <input class="btn btn-large" name="submit" type="submit" value="Send Messages">
                        </fieldset>
                    </form>
                <?php else: ?>
                    <p>Your message is sent. Our manager answers you later</p>
                <?php endif; ?> 
            </div>
        </div>
        <div class="row">
            <div class="span12">
                <iframe style="width:100%; height:300; border: 0px" scrolling="no" src="https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=18+California,+Fresno,+CA,+United+States&amp;aq=0&amp;oq=18+California+united+state&amp;sll=39.9589,-120.955336&amp;sspn=0.007114,0.016512&amp;ie=UTF8&amp;hq=&amp;hnear=18,+Fresno,+California+93727,+United+States&amp;t=m&amp;ll=36.732762,-119.695787&amp;spn=0.017197,0.100336&amp;z=14&amp;output=embed"></iframe><br />
                <small><a href="https://maps.google.co.uk/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=18+California,+Fresno,+CA,+United+States&amp;aq=0&amp;oq=18+California+united+state&amp;sll=39.9589,-120.955336&amp;sspn=0.007114,0.016512&amp;ie=UTF8&amp;hq=&amp;hnear=18,+Fresno,+California+93727,+United+States&amp;t=m&amp;ll=36.732762,-119.695787&amp;spn=0.017197,0.100336&amp;z=14" style="color:#0000FF;text-align:left">View Larger Map</a></small>
            </div>
        </div>
    </div>
</div>
<!-- MainBody End -->

<?php include ROOT . '/views/layouts/footer.php'; ?>

