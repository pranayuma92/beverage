<?php 

require_once __DIR__ . '/framework/bootstrap.php';
require_once __DIR__ . '/CustomPostType.php';
require_once __DIR__ . '/MetaboxOption.php';

class ExtendedFunction {

	protected $dir = '';

	protected $text_domain = 'beverage_';

	public function init() {
		( new CustomPostType() )->run();
		$this->dir = get_template_directory_uri() . '/assets/';
		add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts') );
		add_action( 'after_setup_theme', array($this, 'product_metaboxes') );
		add_action( 'after_setup_theme', array($this, 'slider_metaboxes') );
		add_action( 'after_setup_theme', array($this, 'certain_metabox') );
		add_action( 'after_setup_theme', array($this, 'init_options') );
		add_action( 'admin_menu', array($this, 'custom_menu_page') );
		add_shortcode( 'contact-form', array($this, 'contact_form') );
		add_shortcode('product-overview',  array($this, 'product_overview'));
	}

	public function enqueue_scripts() {
		wp_enqueue_style( $this->text_domain . 'bootstrap', $this->dir . '/css/bootstrap.css' );
		wp_enqueue_style( $this->text_domain . 'custom', $this->dir . '/css/style.css' );
		wp_enqueue_style( $this->text_domain . 'font-awesome', $this->dir . '/css/font-awesome.css' );
		wp_enqueue_style( $this->text_domain . 'flexslider-custom', '//cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.min.css' );

		wp_enqueue_script( $this->text_domain . 'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), '4.0.0', false );
		wp_enqueue_script( $this->text_domain . 'flexslider', '//cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider-min.js', array('jquery'), '2.7.2', false );
	}

	public function render( $filePath, $viewData = null ) {
 
        ( $viewData ) ? extract( $viewData ) : null;
 
        ob_start();
        include( $filePath );
        $template = ob_get_contents();
        ob_end_clean();
 
        return $template;
    }

	public function product_metaboxes() {
    
	    $mb = new VP_Metabox(array(
	        'id'          => 'p_mb',
	        'types'       => array('product'),
	        'title'       => __('Product Option', 'beverage'),
	        'priority'    => 'high',
	        'is_dev_mode' => false,
	        'template'    => MetaboxOption::product_meta()
	    ));
	}

	public function slider_metaboxes() {
	    
	    $mb = new VP_Metabox(array(
	        'id'          => 's_mb',
	        'types'       => array('simple_slider'),
	        'title'       => __('Slider Option', 'beverage'),
	        'priority'    => 'high',
	        'is_dev_mode' => false,
	        'template'    => MetaboxOption::slider_meta()
	    ));
	}

	public function certain_metabox() {
		$post_id = $_GET['post'];

		$pageTemplate = get_post_meta($post_id, '_wp_page_template', true);

		if($pageTemplate == 'template-product-overview.php' ) {
            $mb = new VP_Metabox(array(
		        'id'          => 'po_mb',
		        'types'       => array('page'),
		        'title'       => __('Product Overview Option', 'beverage'),
		        'priority'    => 'high',
		        'is_dev_mode' => false,
		        'template'    => MetaboxOption::product_overview_meta()
		    ));
        }
	}

	public function init_options() {
	    
	    $theme_options = new VP_Option(array(
	        'is_dev_mode'           => false,
	        'option_key'            => 'b_option',
	        'page_slug'             => 'b_option',
	        'template'              => MetaboxOption::theme_option(),
	        'menu_page'             => 'b_option',
	        'use_auto_group_naming' => true,
	        'use_exim_menu'         => true,
	        'minimum_role'          => 'edit_theme_options',
	        'layout'                => 'fixed',
	        'page_title'            => __( 'Theme Settings', 'beverage' ),
	        'menu_label'            => __( 'Theme Settings', 'beverage' ),
	    ));
	}

	public function custom_menu_page() {
	   add_menu_page( 'Theme Settings', 'Theme Settings', 'manage_options', 'b_option', array($this, 'init_options'), 'dashicons-art'  );
	}

	public function contact_form() {
		$templatePath = dirname( __FILE__ ) .'/html-shortcode/contact.php';
		return $this->render($templatePath);
	}

    public function product_overview( $atts ){

    	extract(
    		shortcode_atts(
    			array(
    				'view' => '',
    				'title' => ''
    			),
    			$atts
    		)
    	);

    	$viewData = array(
            'args' => array(
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'posts_per_page' => -1
			),
			'title' => $title
        );

        if($view == 'compact') {
        	$templatePath = dirname( __FILE__ ) .'/html-shortcode/product-overview.php';
        } elseif($view == 'simple') {
        	$templatePath = dirname( __FILE__ ) .'/html-shortcode/product-grid.php';
        } else {
        	$templatePath = dirname( __FILE__ ) .'/html-shortcode/product-overview.php';
        }

		return $this->render($templatePath, $viewData);
    }
}