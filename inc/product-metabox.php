<?php
return array(
    array(
        'type' => 'textbox',
        'name' => 'p_reg_price',
        'label' => __('Regular Price', 'beverage'),
        'description' => __('Product regular price assign here'),
        'default' => '',
        'validation' => 'numeric|required',
    ),
    array(
        'type' => 'textbox',
        'name' => 'p_sale_price',
        'label' => __('Sale Price', 'beverage'),
        'description' => __('Product sale price assign here'),
        'default' => '',
        'validation' => 'numeric',
    ),
    array(
        'type' => 'textbox',
        'name' => 'p_code',
        'label' => __('Product Code', 'beverage'),
        'description' => __('Product code must be unique'),
        'default' => '',
        'validation' => 'required',
    ),
    array(
        'type'      => 'group',
        'name'      => 'p_gallery',
        'repeating' => true,
        'title'     => __('Product Gallery', 'beverage'),
        'sortable' => true,
        'fields'    => array(
           array(
                'type' => 'upload',
                'name' => 'p_gallery_img',
                'label' => __('Image', 'beverage'),
                'description' => __('Show another product image using gallery', 'vp_textdomain'),
                'default' => '',
            ),
        ),
    ),
);