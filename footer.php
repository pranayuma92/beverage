<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Beverage
 */

?>

	</div><!-- #content -->

	<footer class="footer-content-new">
        <div class="layer-new footer">
            <div class="container-fluid">
                <p class="copy-right-grids text-li text-center my-sm-4 my-4">© <?php echo date('Y')?> - <?php echo bloginfo()?>| By
                    <a href="http://ukmgood.com/" target="_blank"> ukmgood.com </a>
                </p>
                <div class="w3ls-footer text-center mt-4">
                    <ul class="list-unstyled w3ls-icons">
                        <li><a href="<?php echo vp_option('b_option.facebook')?>"><span class="fa fa-facebook icon_facebook"></span></a></li>
                        <li><a href="<?php echo vp_option('b_option.twitter')?>"><span class="fa fa-twitter icon_twitter"></span></a></li>
                        <li><a href="<?php echo vp_option('b_option.instagram')?>"><span class="fa fa-instagram"></span></a></li>
                        <li><a href="mailto:<?php echo vp_option('b_option.email')?>"><span class="fa fa-envelope"></span></a></li>
                    </ul>
                </div>
                <div class="move-top text-right"><a href="#home" class="move-top"> <span class="fa fa-angle-up  mb-3" aria-hidden="true"></span></a></div>
            </div>
            <!-- //footer bottom -->
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
