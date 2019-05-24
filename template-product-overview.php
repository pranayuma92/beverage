<?php

/*
 Template name: Product Overview
 */

get_header();
$meta = get_post_meta(get_the_ID(), 'po_mb', true);
$title = $meta['title'] ? $meta['title'] : 'Our Products';

//print_r($meta);

$args = array(
	'post_type'      => 'product',
	'post_status'    => 'publish',
	'posts_per_page' => -1
);

switch ($meta['view']) {
	case 'compact':
		$template = dirname(__FILE__) .'/module/html-shortcode/product-overview.php';
		break;

	case 'simple':
		$template = dirname(__FILE__) .'/module/html-shortcode/product-grid.php';
		break;
	
	default:
		$template = dirname(__FILE__) .'/module/html-shortcode/product-overview.php';
		break;
}
       
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php if($meta['e_best']) :
				$id = $meta['p_id']; 
				$p = get_post( $id ); ?>
				<section class="banner-bottom-wthree py-5" id="about">
			        <div class="container py-md-3">
			        	<div class="header pb-lg-3 pb-3 text-center">
				            <h3 class="tittle two mb-lg-3 mb-3" style="color: #000">Best Seller</h3>
				        </div>
			            <div class="row banner-grids">
			                <div class="col-md-6 content-left-bottom text-left pr-lg-5">
			                    <h4><?php echo $p->post_title; ?></h4>
			                    <p class="mt-2 text-left"><?php echo $p->post_content; ?></p>

			                </div>
			                <div class="col-md-6 content-right-bottom text-left">
			                    <img src="<?php echo get_the_post_thumbnail_url($id)?>" alt="news image" class="img-fluid">
			                </div>
			            </div>
			        </div>
			    </section>
			<?php 

			endif;

			include($template);

			if($meta['e_banner']) : ?>
			<section class="order-sec pb-5 pt-md-0 pt-5 alignfull" id="order">
		        <div class="container py-lg-3">
		            <div class="test-info text-center">
		                <h3 class="tittle order">
		                    <span><?php echo $meta['p_banner'][0]['pre']; ?></span><?php echo $meta['p_banner'][0]['main']; ?></h3>

		                <div class="row mt-lg-4 mt-3">
		                    <div class="col-md-6 order-left-content text-right">
		                        <h4><?php echo $meta['p_banner'][0]['price'] ?></h4>
		                    </div>
		                    <div class="col-md-6 order-right-content text-left">
		                        <?php echo $meta['p_banner'][0]['content'] ?>
		                    </div>
		                    <div class="read-more mx-auto text-center">
		                        <a href="#menu" class="read-more scroll">Order Now </a> </div>
		                </div>
		            </div>
		        </div>
		    </section>
		<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();