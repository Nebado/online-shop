<?php include ROOT . '/views/layouts/header.php'; ?>

<!-- Main -->
<div id="mainBody">
    <div class="container">
        <hr class="soften">
        <h1>Cabinet</h1>
        <hr class="soften"/>	
        <div class="row">
            <div class="span12">
                <h3>Your features</h3>
                <br>
                <h4>Welcome, <i style="color: #408140;"><?php echo $userName; ?></i></h4>
                <br>
                <h5><a href="/cabinet/edit">Edit personal information</a></h5>
                <h5><a href="/soon">See order history</a></h5>
                <h5><a href="/soon">Play a game</a></h5>
            </div>           
        </div>
    </div>
</div>
<!-- MainBody End -->

<?php include ROOT . '/views/layouts/footer.php'; ?>


