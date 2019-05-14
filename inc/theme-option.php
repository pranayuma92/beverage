<?php
return array(
    'title' => __('Theme Settings | by UKMGood', 'beverage'),
    'logo'  => get_template_directory_uri() .  '/assets/images/ukmgood.png',
    'menus' => array(
        array(
	        'title' => __('Contact Details', 'beverage'),
	        'icon' => 'font-awesome:fa-user',
	        'controls' => array(
	           	array(
			        'type' => 'textbox',
			        'name' => 'contact',
			        'label' => __('Contact', 'beverage'),
			        'description' => __('Your contact person', 'beverage'),
			        'default' => '',
			        'validation' => 'numeric'
			    ), 
			    array(
			        'type' => 'textbox',
			        'name' => 'instagram',
			        'label' => __('Instagram', 'beverage'),
			        'description' => __('Your instagram url', 'beverage'),
			        'default' => '',
			    ),
			    array(
			        'type' => 'textbox',
			        'name' => 'facebook',
			        'label' => __('Facebook', 'beverage'),
			        'description' => __('Your facebook url', 'beverage'),
			        'default' => '',
			    ),
			    array(
			        'type' => 'textbox',
			        'name' => 'twitter',
			        'label' => __('Twitter', 'beverage'),
			        'description' => __('Your twitter url', 'beverage'),
			        'default' => '',
			    ),
			    array(
			        'type' => 'textbox',
			        'name' => 'email',
			        'label' => __('Email', 'beverage'),
			        'description' => __('Your email address', 'beverage'),
			        'default' => '',
			        'validation' => 'email'
			    ),
			    array(
			        'type' => 'textarea',
			        'name' => 'address',
			        'label' => __('Address', 'beverage'),
			        'description' => __('Your shop address', 'beverage'),
			        'default' => '',
			    ),
	        ),
	    ),
	    array(
	        'title' => __('Banner and Slider', 'beverage'),
	        'icon' => 'font-awesome:fa-picture-o',
	        'controls' => array(
	        	array(
			        'type' => 'textbox',
			        'name' => 's_speed',
			        'label' => __('Crossfading Speed', 'beverage'),
			        'description' => __('Adjust banner crossfading speed', 'beverage'),
			        'default' => '7000',
			        'validation' => ''
			    ),
			    array(
			        'type' => 'textbox',
			        'name' => 'h_text',
			        'label' => __('Hompage Banner Text', 'beverage'),
			        'description' => __('Set homepage banner text', 'beverage'),
			        'default' => 'Welcome to Beverage by ukmgood.com',
			        'validation' => ''
			    ),
	        )
	    ),
	    array(
	        'title' => __('Product', 'beverage'),
	        'icon' => 'font-awesome:fa-shopping-cart',
	        'controls' => array(
	        	array(
			        'type' => 'textbox',
			        'name' => 'p_count',
			        'label' => __('Product Per Page', 'beverage'),
			        'description' => __('Set how many product will display per page', 'beverage'),
			        'default' => '4',
			        'validation' => ''
			    ),
			    array(
			        'type' => 'toggle',
			        'name' => 'p_filter',
			        'label' => __('Enable Product Filter', 'beverage'),
			        'description' => __('Filter is good for filtering many product into specific', 'beverage'),
			        'default' => '0',
			    ),
			    array(
			        'type' => 'checkbox',
			        'name' => 'p_filter_op',
			        'label' => __('Select Filter', 'beverage'),
			        'description' => __('Select filter to display', 'beverage'),
			        'validation' => '',
			        'dependency' => array(
			            'field'    => 'p_filter',
			            'function' => 'vp_dep_boolean',
			        ),
			        'items' => array(
			            array(
			                'value' => 'category',
			                'label' => __('Product Category', 'beverage'),
			            ),
			            array(
			                'value' => 'price',
			                'label' => __('Product Price', 'beverage'),
			            ),
			        ),
			        'default' => array(
			            'category',
			        ),
			    ),
			    array(
			        'type' => 'textbox',
			        'name' => 'p_range_price',
			        'label' => __('Price Range', 'beverage'),
			        'description' => __('Set minimal and maximal price range. Example : 100-200', 'beverage'),
			        'default' => '',
			        'validation' => '',
			        'dependency' => array(
			            'field'    => 'p_filter',
			            'function' => 'vp_dep_boolean',
			        ),
			    ),
			    array(
			        'type' => 'toggle',
			        'name' => 'p_archive',
			        'label' => __('Enable Product Archive', 'beverage'),
			        'description' => __('Enable this if you want to show all product in archive page', 'beverage'),
			        'default' => '0',
			    ),
			    array(
			        'type' => 'toggle',
			        'name' => 'p_wa',
			        'label' => __('Enable Button Order Via Whatsapp', 'beverage'),
			        'description' => __('If enable, customer can order the product via Whatsapp', 'beverage'),
			        'default' => '1',
			    ),
			    array(
			        'type' => 'toggle',
			        'name' => 'p_email',
			        'label' => __('Enable Button Order Via Email', 'beverage'),
			        'description' => __('If enable, customer can order the product via Email', 'beverage'),
			        'default' => '0',
			    ),
			     array(
			        'type' => 'toggle',
			        'name' => 'p_cart',
			        'label' => __('Enable Cart and Checkout', 'beverage'),
			        'description' => __('If enable, customer can add product to cart and do checkout (coming soon)', 'beverage'),
			        'default' => '0',
			    ),
			     array(
			        'type' => 'checkbox',
			        'name' => 'p_payment',
			        'label' => __('Select Payment Method', 'beverage'),
			        'description' => __('Select available payment method (coming soon)', 'beverage'),
			        'validation' => '',
			        'dependency' => array(
			            'field'    => 'p_cart',
			            'function' => 'vp_dep_boolean',
			        ),
			        'items' => array(
			            array(
			                'value' => 'vaccount',
			                'label' => __('Virtual Account', 'beverage'),
			            ),
			            array(
			                'value' => 'doku',
			                'label' => __('Doku Payment', 'beverage'),
			            ),
			            array(
			                'value' => 'midtrans',
			                'label' => __('Midtrans Payment', 'beverage'),
			            ),
			        ),
			        'default' => array(
			            'vaccount',
			        ),
			    ),
			    array(
			        'type' => 'notebox',
			        'label' => __('Shortcode Available', 'beverage'),
			        'description' => __('<b>[product-overview]</b> : Show product overview', 'beverage'),
			        'status' => 'normal',
			    ),
	        )
	    ),
		array(
	        'title' => __('Appearance', 'beverage'),
	        'icon' => 'font-awesome:fa-picture-o',
	        'controls' => array(
	        	array(
			        'type' => 'upload',
			        'name' => 'c_logo',
			        'label' => __('Custom Logo', 'beverage'),
			        'description' => __('Change website title with your custom logo', 'beverage'),
			        'default' => '',
			    ),
	        	array(
			        'type' => 'color',
			        'name' => 'b_color',
			        'label' => __('Color Scheme', 'beverage'),
			        'description' => __('Set color Scheme style. Let empty if you want to use default color', 'beverage'),
			        'default' => '#c20d00',
			        'format' => 'hex',
			    ),
	        )
	    ),
    ),
);