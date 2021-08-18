<?php
  /*
    Plugin Name:  B&S - Guten Woo
    Plugin URI:   https://github.com/borgenfalkskott/bs-guten-woo
    Description:  Enable the gutenberg editor for your WooCommerce products.
    Version:      0.1.0
    Author:       Borgenfalk & Skott
    Author URI:   https://borgenfalk.se
    License:      MIT
    License URI:  https://github.com/borgenfalkskott/bs-guten-woo/blob/main/LICENSE
    Text Domain:  bs-guten-woo
    Domain Path:  /languages
  */

  defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


  /**
   * Enable the Gutenberg Editor for your WooCommerce Products
   */
  add_filter( 'use_block_editor_for_post_type', function( $can_edit, $post_type ){
    if( $post_type == 'product' ) $can_edit = true;
    return $can_edit;
  }, 99, 2);


  /**
   * Disable Woo product tabs
   */
  add_filter('woocommerce_product_tabs', function( $tabs ){
    unset( $tabs['description'] );
    unset( $tabs['reviews'] );
    unset( $tabs['additional_information'] );
    return $tabs;
  }, 99);


  /**
   * Remove description heading on product page
   */
  add_filter('woocommerce_product_description_heading', '__return_null');

  
  /**
   * Render single product description/content
   */
  add_action('woocommerce_after_single_product_summary', function(){
    wc_get_template('single-product/tabs/description.php');
  }, 99);


  /**
   * Enable Woo taxonomies in Wp REST API
   */
  function bs_guten_woo_show_taxonomy_in_api( $args ) {
    $args['show_in_rest'] = true;
    return $args;
  }
  add_filter('woocommerce_taxonomy_args_product_cat', 'bs_guten_woo_show_taxonomy_in_api');
  add_filter('woocommerce_taxonomy_args_product_tag', 'bs_guten_woo_show_taxonomy_in_api');
?>