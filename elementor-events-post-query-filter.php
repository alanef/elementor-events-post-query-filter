<?php

/**
 *
 * @wordpress-plugin
 * Plugin Name: Elementor Post Query Filter for Events Manager
 * Plugin URI:  https://fullworks.net/products/custom-plugin-development/
 * Description: Query Filter for Events
 * Version:     1.0.0
 * Author:      Alan Fuller
 * Author URI:  https://fullworks.net/products/custom-plugin-development/
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 **/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( "elementor_pro/posts/query/newevents", 'custom_filter_new', 10, 2 );
add_action( "elementor_pro/posts/query/oldevents", 'custom_filter_old', 10, 2 );

function custom_filter_new( $wp_query, $elementor_this ) {

	return custom_filter( $wp_query, true );
}

function custom_filter_old( $wp_query, $elementor_this ) {

	return custom_filter( $wp_query, false );
}

function custom_filter( $wp_query, $new = true ) {

	$wp_query->query_vars['order']      = 'ASC';
	$wp_query->query_vars['meta_key']   = '_event_start';
	$wp_query->query_vars['orderby']    = 'meta_value';
	$wp_query->query_vars['meta_query'] = array(
		array(
			'key'     => '_event_start',
			'value'   => date( 'Y-m-d H-i-s' ),
			'compare' => ( $new ) ? '>=' : '<',
		)
	);

	return $wp_query;
}
