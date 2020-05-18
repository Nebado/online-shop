<!-- Footer ================================================================== -->
<div  id="footerSection">
    <div class="container">
        <div class="row">
            <div class="span3">
                <h5>ACCOUNT</h5>
                <a href="/login/">YOUR ACCOUNT</a>
                <a href="/login/">PERSONAL INFORMATION</a> 
                <a href="/login/">ADDRESSES</a> 
                <a href="/login/">DISCOUNT</a>  
                <a href="/login/">ORDER HISTORY</a>
            </div>
            <div class="span3">
                <h5>INFORMATION</h5>
                <a href="/contact/">CONTACT</a>  
                <a href="/register/">REGISTRATION</a>  
                <a href="/legal/">LEGAL NOTICE</a>  
                <a href="/tac/">TERMS AND CONDITIONS</a> 
                <a href="/faq/">FAQ</a>
            </div>
            <div class="span3">
                <h5>OUR OFFERS</h5>
                <a href="#">NEW PRODUCTS</a> 
                <a href="#">TOP SELLERS</a>  
                <a href="/offer/">SPECIAL OFFERS</a>  
                <a href="#">MANUFACTURERS</a> 
                <a href="#">SUPPLIERS</a> 
            </div>
            <div id="socialMedia" class="span3 pull-right">
                <h5>SOCIAL MEDIA </h5>
                <a href="#"><img width="60" height="60" src="/template/themes/images/facebook.png" title="facebook" alt="facebook"/></a>
                <a href="#"><img width="60" height="60" src="/template/themes/images/twitter.png" title="twitter" alt="twitter"/></a>
                <a href="#"><img width="60" height="60" src="/template/themes/images/youtube.png" title="youtube" alt="youtube"/></a>
            </div> 
        </div>
        <p class="pull-right">&copy; Bootshop</p>
    </div><!-- Container End -->
</div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="/template/themes/js/jquery.js" type="text/javascript"></script>
<script src="/template/themes/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/template/themes/js/google-code-prettify/prettify.js"></script>

<script src="/template/themes/js/bootshop.js"></script>
<script src="/template/themes/js/jquery.lightbox-0.5.js"></script>
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