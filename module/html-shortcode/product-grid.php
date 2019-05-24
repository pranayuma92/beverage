<?php 
    $product = new WP_Query($args);
?>

<section class="services simple-view py-5 alignfull" id="menu">
    <div class="container py-md-5">
        <div class="header pb-lg-3 pb-3 text-center">
            <h3 class="tittle two mb-lg-3 mb-3"><?php echo $title; ?></h3>
        </div>
        <div class="row ab-info mt-lg-4">
            <?php while($product->have_posts()) : $product->the_post();
                    $cat = get_the_terms(get_the_ID(), 'product_category'); ?>
            <div class="col-lg-3 ab-content" onclick="window.location.href='<?php the_permalink()?>'">
                <div class="ab-content-inner">
                    <img src="<?php echo get_the_post_thumbnail_url()?>" alt="news image" class="img-fluid">
                    <div class="ab-info-con">
                        <h4><?php the_title()?></h4>
                        <?php if(!empty(vp_metabox('p_mb.p_sale_price'))) :?>
                        <p>Rp <?php echo number_format(vp_metabox('p_mb.p_sale_price'),0,'.','.') ?> <del>Rp <?php echo number_format(vp_metabox('p_mb.p_reg_price'),0,'.','.') ?></del></p>
                        <span class="filter-price"><?php echo vp_metabox('p_mb.p_sale_price')?></span>
                        <?php else :?>
                        <p>Rp <?php echo number_format(vp_metabox('p_mb.p_reg_price'),0,'.','.') ?></p>
                        <span class="filter-price"><?php echo vp_metabox('p_mb.p_reg_price')?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
           <?php endwhile; ?>
        </div>
    </div>
</section>