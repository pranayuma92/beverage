<?php
/**
 * Beverage functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Beverage
 */

if ( ! function_exists( 'beverage_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function beverage_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Beverage, use a find and replace
		 * to change 'beverage' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'beverage', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'beverage' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'beverage_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'beverage_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function beverage_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'beverage_content_width', 640 );
}
add_action( 'after_setup_theme', 'beverage_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function beverage_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'beverage' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'beverage' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'beverage_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function beverage_scripts() {
	wp_enqueue_style( 'beverage-style', get_stylesheet_uri() ); 

	wp_enqueue_style( 'beverage-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css' );

	wp_enqueue_style( 'beverage-custom', get_template_directory_uri() . '/assets/css/style.css' ); 

	wp_enqueue_style( 'flexslider-custom', '//cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.min.css' );

	wp_enqueue_style( 'beverage-fa', get_template_directory_uri() . '/assets/css/font-awesome.css' );

	wp_enqueue_script( 'beverage-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true ); 

	wp_enqueue_script( 'flexslider', '//cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider-min.js', array('jquery'), '2.7.2', false );

	//wp_enqueue_script( 'jplist', get_template_directory_uri() . '/js/jplist.es6.compiled.js', array(), '1.0', false );

	wp_enqueue_script( 'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), '4.0.0', false );

	wp_enqueue_script( 'beverage-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'beverage_scripts' );

add_action( 'admin_enqueue_scripts', function(){
	wp_enqueue_style( 'beverage-admin-custom', get_template_directory_uri() . '/assets/css/admin-style.css' ); 
});

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/cpt.php';

require get_template_directory() . '/framework/bootstrap.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function product_metaboxes() {
    
    $mb_path  = get_template_directory() . '/inc/product-metabox.php';
    
    $mb = new VP_Metabox(array(
        'id'          => 'p_mb',
        'types'       => array('product'),
        'title'       => __('Product Option', 'beverage'),
        'priority'    => 'high',
        'is_dev_mode' => false,
        'template'    => $mb_path
    ));
}

add_action( 'after_setup_theme', 'product_metaboxes' );

function slider_metaboxes() {
    
    $mb_path  = get_template_directory() . '/inc/slider-metabox.php';
    
    $mb = new VP_Metabox(array(
        'id'          => 's_mb',
        'types'       => array('simple_slider'),
        'title'       => __('Slider Option', 'beverage'),
        'priority'    => 'high',
        'is_dev_mode' => false,
        'template'    => $mb_path
    ));
}

add_action( 'after_setup_theme', 'slider_metaboxes' );

function init_options() {
    
    $tmpl_opt  = get_template_directory() . '/inc/theme-option.php';
    
    $theme_options = new VP_Option(array(
        'is_dev_mode'           => false,
        'option_key'            => 'b_option',
        'page_slug'             => 'b_option',
        'template'              => $tmpl_opt,
        'menu_page'             => 'b_option',
        'use_auto_group_naming' => true,
        'use_exim_menu'         => true,
        'minimum_role'          => 'edit_theme_options',
        'layout'                => 'fixed',
        'page_title'            => __( 'Theme Settings', 'beverage' ),
        'menu_label'            => __( 'Theme Settings', 'beverage' ),
    ));
}


add_action( 'after_setup_theme', 'init_options' );

function custom_menu_page() {
   add_menu_page( 'Theme Settings', 'Theme Settings', 'manage_options', 'b_option', 'init_options', 'dashicons-art'  );
}
add_action( 'admin_menu', 'custom_menu_page' );

add_shortcode('product-overview', function(){
	$args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => -1
	);

	$product = new WP_Query($args); 
	ob_start()?>
	<section class="mid-sec py-5" id="menu">
	    <div class="container-fluid py-lg-5">
	        <div class="header pb-lg-3 pb-3 text-center">
	            <h3 class="tittle mb-lg-3 mb-3">Produk Kami</h3>
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
<?php
return ob_get_clean();
});

add_shortcode('contact-form', function(){
	ob_start(); ?>
	 <section class="contact py-5" id="contact">
        <div class="container pb-md-5">
            <div class="header py-lg-5 pb-3 text-center">
                <h3 class="tittle mb-lg-5 mb-3"> Kontak Kami</h3>
            </div>

            <div class="contact-form mx-auto text-left">
                <form name="contactform" id="contactform1" method="post" action="#">
                    <div class="row">
                        <div class="col-lg-4 con-gd">
                            <div class="form-group">
                                <label>Nama *</label>
                                <input type="text" class="form-control" id="name" placeholder="" name="name" required="">
                            </div>
                        </div>
                        <div class="col-lg-4 con-gd">
                            <div class="form-group">
                                <label>Email *</label>
                                <input type="email" class="form-control" id="email" placeholder="" name="email" required="">
                            </div>
                        </div>
                        <div class="col-lg-4 contact-page">
                            <div class="form-group">
                                <label>Submit *</label>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
            <ul class="list-unstyled row text-left mb-lg-5 mb-3">
                <li class="col-lg-4 adress-info">
                    <div class="row">
                        <div class="col-md-3 text-lg-center adress-icon">
                            <span class="fa fa-map-marker"></span>
                        </div>
                        <div class="col-md-9 text-left">
                            <h6>Alamat</h6>
                            <p><?php echo vp_option('b_option.address')?></p>
                        </div>
                    </div>
                </li>

                <li class="col-lg-4 adress-info">
                    <div class="row">
                        <div class="col-md-3 text-lg-center adress-icon">
                            <span class="fa fa-envelope-open-o"></span>
                        </div>
                        <div class="col-md-9 text-left">
                            <h6>Email</h6>
                            <a href="mailto:<?php echo vp_option('b_option.email')?>"><?php echo vp_option('b_option.email')?></a>
                        </div>
                    </div>
                </li>
                <li class="col-lg-4 adress-info">
                    <div class="row">
                        <div class="col-md-3 text-lg-center adress-icon">
                            <span class="fa fa-mobile"></span>
                        </div>
                        <div class="col-md-9 text-left">
                            <h6>Telepon</h6>
                            <p><?php echo vp_option('b_option.contact')?></p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

    </section>
<?php
return ob_get_clean();
});


add_filter( 'manage_product_posts_columns', function($columns){
	$columns = array(
		'cb' => $columns['cb'],
    	'image' => __( 'Image' ),
    	'title' => __( 'Title' ),
    	'category' => __( 'Category' ),
    	'price' => __( 'Price' ),
    	'sale' => __('Sale Price'),
    	'sku' => __( 'SKU' ),
    	'date' => __( 'Date')
	);

	return $columns;
});

add_action( 'manage_product_posts_custom_column', function($column, $post_id){
	if ( 'image' === $column ) {
		echo get_the_post_thumbnail( $post_id, array(80, 80) );
	}

	if( 'price' === $column ) {
		echo 'Rp '.number_format(vp_metabox('p_mb.p_reg_price'), 0,'.','.');
	}

	if( 'sale' === $column ) {
		if(vp_metabox('p_mb.p_sale_price') != null){
			echo 'Rp '.number_format(vp_metabox('p_mb.p_sale_price'), 0,'.','.');
		}else {
			echo '-';
		}
	}

	if( 'sku' === $column ) {
		echo vp_metabox('p_mb.p_code');
	}

	if( 'category' === $column ){
		$cat = get_the_terms($post->ID, 'product_category');
		if($cat){
			echo $cat[0]->name;
		} else {
			echo '-';
		}
	}

	if( 'date' === $column ){
		echo get_the_date( 'F j, Y');
	}
}, 10, 2);

add_action('wp_footer', function(){
	$arr = array();
	$slider = new WP_Query(array('post_type'=>'simple_slider'));

	if($slider->have_posts()){
		while ($slider->have_posts()) {
			$slider->the_post();
			$arr[] = vp_metabox('s_mb.slider');
		}

	} ?>
	<script type="text/javascript">
        var slider = <?php echo json_encode($arr)?>;
        console.log(slider);

        secs = 4;
        slider.forEach(function(img){
            new Image().src = img; 
        });

        function backgroundSequence() {
            window.clearTimeout();
            var k = 0;
            for (i = 0; i < slider.length; i++) {
                setTimeout(function(){ 
                    document.querySelector('.main-content').style.background = "url(" + slider[k] + ") no-repeat center center";
                    document.querySelector('.main-content').style.backgroundSize ="cover";
                if ((k + 1) === slider.length) { setTimeout(function() { backgroundSequence() }, (secs * <?php echo vp_option('b_option.s_speed')?>))} else { k++; }            
                }, (secs * <?php echo vp_option('b_option.s_speed')?>) * i)   
            }
        }
        if(slider != null || slider != [] || slider != 0 || slider != '') {
        	backgroundSequence();
        }
    </script>
<?php
});

add_filter( 'post_row_actions', 'remove_row_actions', 10, 1 );
function remove_row_actions( $actions ) {
    if( get_post_type() === 'simple_slider' )
        unset( $actions['view'] );
        unset( $actions['inline hide-if-no-js'] );
    return $actions;
}

function theme_get_customizer_css() {
    ob_start();

    $text_color = vp_option('b_option.b_color');
    if ( ! empty( $text_color ) ) {
      ?>
	    a.read-more {
		    background: <?php echo $text_color; ?>;
		    color: #fff;
		}

		.jplist-holder button, #menu .buttons button {
			color: <?php echo $text_color; ?>;
	    	border: 1px solid <?php echo $text_color; ?>;
		}

		.jplist-holder button.jplist-selected, 
		#menu .buttons button.jplist-selected, 
		.jplist-slider-range, 
		.contact-form button.btn,
		.jplist-slider-holder-1:active, .jplist-slider-holder-2:active {
			background: <?php echo $text_color; ?>;
		}

		.jplist-slider-holder-1, .jplist-slider-holder-2 {
			border: 5px solid <?php echo $text_color; ?>;
		}

		p.price {
			color: <?php echo $text_color; ?>;
		}
      <?php
	}


    $css = ob_get_clean();
    return $css;
}

function theme_enqueue_styles() {
  wp_enqueue_style( 'theme-styles', get_template_directory_uri() . '/assets/css/style.css'); // This is where you enqueue your theme's main stylesheet
  $custom_css = theme_get_customizer_css();
  wp_add_inline_style( 'theme-styles', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
