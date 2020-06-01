<!-- Footer ================================================================== -->
<div  id="footerSection">
    <div class="container">
        <div class="row">
            <div class="span3">
                <h5>ACCOUNT</h5>
                <a href="/cabinet/">YOUR ACCOUNT</a>
                <a href="/cabinet/edit">PERSONAL INFORMATION</a>
                <a href="/cabinet/history/">ORDER HISTORY</a>
            </div>
            <div class="span3">
                <h5>INFORMATION</h5>
                <a href="/contact/">CONTACT</a>  
                <a href="/register/">REGISTRATION</a>  
            </div>
            <div id="socialMedia" class="span3 pull-right">
                <h5>SOCIAL MEDIA </h5>
                <a href="#"><img width="60" height="60" src="/template/themes/images/facebook.png" title="facebook" alt="facebook"/></a>
                <a href="#"><img width="60" height="60" src="/template/themes/images/twitter.png" title="twitter" alt="twitter"/></a>
                <a href="#"><img width="60" height="60" src="/template/themes/images/youtube.png" title="youtube" alt="youtube"/></a>
            </div> 
        </div>
        <p class="pull-right" style="margin-top: 10px;">&copy; Online shop</p>
    </div><!-- Container End -->
</div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="/template/themes/js/jquery.js" type="text/javascript"></script>
<script src="/template/themes/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/template/themes/js/google-code-prettify/prettify.js"></script>

<script src="/template/themes/js/rootshop.js"></script>
<script src="/template/themes/js/jquery.lightbox-0.5.js"></script>
<script src="/template/themes/js/jquery.cycle2.js"></script>
<script src="/template/themes/js/jquery.cycle2.carousel.js"></script>
<script>
    $(document).ready(function(){
        $(".add-to-cart").click(function () {
            var id = $(this).attr("data-id");
            $.post("/cart/addAjax/"+id, {}, function (data) {
               $("#cart-count").html(data); 
            });
            return false;
        });
    });
</script>
</body>
</html>