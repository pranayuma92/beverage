<?php 
	$product = new WP_Query($args);
?>

<section class="mid-sec py-5" id="menu">
    <div class="container-fluid py-lg-5">
        <div class="header pb-lg-3 pb-3 text-center">
            <h3 class="tittle mb-lg-3 mb-3"><?php echo $title; ?></h3>
        </div>
        <?php if(vp_option('b_option.p_filter') == 1) :
        	$range = explode('-', vp_option('b_option.p_range_price')); 

			if(in_array('category', vp_option('b_option.p_filter_op'))) : ?>
				<div class="buttons">
					<button
			            data-jplist-control="reset"
			            data-group="data-group-1"
			            data-mode="radio"
			            data-name="reset">
				        All Products
				    </button>
					<?php $terms = get_terms('product_category');
					foreach($terms as $term) :?>
					    <button
				            data-jplist-control="buttons-path-filter"
				            data-path=".<?php echo $term->slug;?>"
				            data-group="data-group-1"
				            data-mode="radio"
				            name="name1">
					        <?php echo $term->name;?>
					    </button>
					<?php endforeach; ?>
				    
				</div>
			<?php endif; 

        	if(in_array('price', vp_option('b_option.p_filter_op'))) : ?>
	     	<div
			    data-jplist-control="slider-range-filter"
			    data-path=".filter-price"
			    data-group="data-group-1"
			    data-name="price-filter-1"
			    data-min="<?php echo $range[0]?>"
			    data-from="<?php echo $range[0]?>"
			    data-to="<?php echo $range[1]?>"
			    data-max="<?php echo $range[1]?>">

			    <div class="label min-price">Rp <span data-type="value-1"></span></div>
				<div class="jplist-slider" data-type="slider"></div>
				<div class="label max-price">Rp <span data-type="value-2"></span></div>
			</div>

			<?php 
			endif; 

		endif;?>
        <section id="content1">
            <div class="ab-info row" data-jplist-group="data-group-1">
            	<?php while($product->have_posts()) : $product->the_post();
            		$cat = get_the_terms(get_the_ID(), 'product_category'); ?>
                <div data-jplist-item class="col-md-3 ab-content" onclick="window.location.href='<?php the_permalink()?>'">
                    <div class="tab-wrap">
                        <img src="<?php echo get_the_post_thumbnail_url()?>" alt="news image" class="img-fluid">
                        <div class="ab-info-con">
                            <h4><?php the_title()?></h4>
                            <?php if(!empty(vp_metabox('p_mb.p_sale_price'))) :?>
                            <p class="price">Rp <?php echo number_format(vp_metabox('p_mb.p_sale_price'),0,'.','.') ?> <del>Rp <?php echo number_format(vp_metabox('p_mb.p_reg_price'),0,'.','.') ?></del></p>
                            <span class="filter-price"><?php echo vp_metabox('p_mb.p_sale_price')?></span>
                            <?php else :?>
                            <p class="price">Rp <?php echo number_format(vp_metabox('p_mb.p_reg_price'),0,'.','.') ?></p>
                            <span class="filter-price"><?php echo vp_metabox('p_mb.p_reg_price')?></span>
                            <?php endif; ?>
                            <h5 class="category <?php echo $cat[0]->slug;?>"><strong><?php echo $cat[0]->name;?></strong></h5>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        </section>
    </div>
</section>
<div class="filter-no-result" data-jplist-control="no-results" data-group="data-group-1" data-name="no-results"><h4>No Results Found</h4></div>
<div
    data-jplist-control="pagination"
    data-group="data-group-1"
    data-items-per-page="<?php echo vp_option('b_option.p_count')?>"
    data-current-page="0"
    data-name="pagination1">

    <div class="row mb-3 pagination-product">
        <div class="jplist-holder" data-type="pages">
            <button type="button" data-type="page">{pageNumber}</button>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/jplist.js"></script>
<script type="text/javascript">
	jplist.init();
</script>