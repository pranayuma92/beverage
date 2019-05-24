<?php 

class CustomPostType {

    public function run() {
        add_action( 'init', array($this, 'custom_hierarchical_taxonomy'));
        add_action( 'init', array($this, 'custom_post_type'));
        add_action( 'init', array($this, 'simple_slider_image'));
        add_filter( 'manage_product_posts_columns', array($this, 'reorder_product_columns'));
        add_action( 'manage_product_posts_custom_column', array($this, 'manage_product_columns'), 10, 2);
        add_filter( 'post_row_actions', array($this, 'remove_row_actions'), 10, 1 );
    }

    public function custom_hierarchical_taxonomy() {
 
        $labels = array(
            'name' => _x( 'Product Category', 'taxonomy general name', 'beverage' ),
            'singular_name' => _x( 'Product Category', 'taxonomy singular name', 'beverage' ),
            'search_items' =>  __( 'Search Group', 'beverage' ),
            'all_items' => __( 'All Product Category', 'beverage' ),
            'parent_item' => __( 'Parent Product Category', 'beverage' ),
            'parent_item_colon' => __( 'Parent Product Category:', 'beverage' ),
            'edit_item' => __( 'Edit Product Category', 'beverage' ), 
            'update_item' => __( 'Update Product Category', 'beverage' ),
            'add_new_item' => __( 'Add New Product Category', 'beverage' ),
            'new_item_name' => __( 'New Product Category Name', 'beverage' ),
            'menu_name' => __( 'Product Category', 'beverage' ),
        );    
         
        register_taxonomy('product_category',array('product'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'product_category' ),
        )); 
    }

    public function custom_post_type() {

        if(vp_option('b_option.p_archive') == 1){
            $ar = true;
        } else {
            $ar = false;
        }

        $labels = array(
            'name'                => _x( 'Product', 'Post Type General Name', 'beverage' ),
            'singular_name'       => _x( 'Product', 'Post Type Singular Name', 'beverage' ),
            'menu_name'           => __( 'Product', 'beverage' ),
            'parent_item_colon'   => __( 'Parent Product', 'beverage' ),
            'all_items'           => __( 'All Product', 'beverage' ),
            'view_item'           => __( 'View Product', 'beverage' ),
            'add_new_item'        => __( 'Add New Product', 'beverage' ),
            'add_new'             => __( 'Add New Product', 'beverage' ),
            'edit_item'           => __( 'Edit Product', 'beverage' ),
            'update_item'         => __( 'Update Product', 'beverage' ),
            'search_items'        => __( 'Search Product', 'beverage' ),
            'not_found'           => __( 'Not Found', 'beverage' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'beverage' ),
        );
         
         
        $args = array(
            'label'               => __( 'posts', 'beverage' ),
            'description'         => __( 'Posts and reviews', 'beverage' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', ),
            'menu_icon'           => 'dashicons-cart',          
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => false,
            'menu_position'       => 19,
            'can_export'          => true,
            'has_archive'         => $ar,
            'exclude_from_search' => true,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        );

        register_post_type( 'product', $args );
        flush_rewrite_rules();
    }

    public function simple_slider_image() {
        $labels1 = array(
            'name'                => _x( 'Banner Slider', 'Post Type General Name', '' ),
            'singular_name'       => _x( 'Banner Slider', 'Post Type Singular Name', '' ),
            'menu_name'           => __( 'Banner Slider', '' ),
            'all_items'           => __( 'All Slider Child', '' ),
            'view_item'           => __( 'Banner Slider', '' ),
            'add_new_item'        => __( 'Add New Child', '' ),
            'add_new'             => __( 'Add New Child', '' ),
            'edit_item'           => __( 'Edit Banner Slider Child', '' ),
            'update_item'         => __( 'Update Banner Slider', '' ),
            'search_items'        => __( 'Search Banner Slider', '' ),
            'not_found'           => __( 'Not Found', '' ),
            'not_found_in_trash'  => __( 'Not found in Trash', '' ),
        );

        $args1 = array(
            'label'               => __( 'Banner Slider', '' ),
            'description'         => __( 'Banner Slider news and reviews', '' ),
            'labels'              => $labels1,
            'supports'            => array( 'title'),
            'menu_icon'           => 'dashicons-format-gallery', 
            'hierarchical'        => false,
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => false,
            'show_in_admin_bar'   => false,
            'menu_position'       => 30,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        );

        register_post_type( 'simple_slider', $args1 );
        flush_rewrite_rules();
    }

    public function reorder_product_columns($columns){
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
    }

    public function manage_product_columns($column, $post_id){
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
    }

    public function remove_row_actions( $actions ) {
        if( get_post_type() === 'simple_slider' )
            unset( $actions['view'] );
            unset( $actions['inline hide-if-no-js'] );
        return $actions;
    }
}


 


 


