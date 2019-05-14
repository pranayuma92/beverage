<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Beverage
 */

get_header();
?>

	<div id="primary" class="content-area single-product">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post(); 
			$cat = get_the_terms(get_the_ID(), 'product_category'); ?>

			<div class="row content-product-single">
				<div class="col-md-6 product-image">
					<div id="slider" class="flexslider">
					  	<ul class="slides">
					    	<li>
								<?php the_post_thumbnail('large'); ?>
							</li>
							<?php $galleries = vp_metabox('p_mb.p_gallery');
							foreach($galleries as $gallery){
								echo '<li><img src="'.$gallery['p_gallery_img'].'"/></li>';
							}?>
						</ul>
					</div>
				</div>
					
				<div class="col-md-6 product-detail">
					<!-- <h2><?php the_title(); ?></h2> -->
					<?php if(!empty(vp_metabox('p_mb.p_sale_price'))) :?>
						<h2>Rp <?php echo number_format(vp_metabox('p_mb.p_sale_price'),0,'.','.'); ?> <del>Rp <?php echo number_format(vp_metabox('p_mb.p_reg_price'),0,'.','.'); ?></del></h2>
					<?php else:?>
						<h2>Rp <?php echo number_format(vp_metabox('p_mb.p_reg_price'),0,'.','.'); ?></h2>
					<?php endif; ?>
					<h5>Kode produk: <?php echo vp_metabox('p_mb.p_code'); ?></h5><br>
					<h5><?php echo $cat[0]->name; ?></h5>
					<p><?php the_content(); ?></p>
					<div class="cta-button">
						<?php if(vp_option('b_option.p_wa') == 1) {?>
							<a href="#" class="read-more scroll btn-wa" data-toggle="modal" data-target="#exampleModalCenter">Pesan via Whatsapp</a><br/>
						<?php } ?>

						<?php if(vp_option('b_option.p_email') == 1) {?>
							<a href="#" class="read-more scroll btn-email" data-toggle="modal" data-target="#exampleModalCenter2">Pesan via email</a>
						<?php } ?>
					</div>
				</div>
			</div>
			<!-- <?php print_r(vp_option('b_option.p_filter_op'))?> -->
			<script type="text/javascript">
				(function($){
					$('.btn-wa').on('click', function(){
						window.location.href = 'https://api.whatsapp.com/send?phone=<?php echo str_replace('0', '62', vp_option('b_option.contact'))?>&text=Halo%2C%20saya%20mau%20order%20<?php echo get_the_title(); ?>';
					})

					$('.btn-email').on('click', function(){
						window.location.href = 'mailto:<?php echo vp_option('b_option.email')?>';
					})
				})(jQuery)
			</script>

		<?php endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<script type="text/javascript">
		(function($){
			
 
  $('#slider').flexslider({
    animation: "slide",
  });

		})(jQuery);
	</script>

<?php
get_footer();
