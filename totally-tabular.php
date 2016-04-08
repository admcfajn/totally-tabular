<?php
/*
Plugin Name: Totally Tabular
Plugin URI: http://dabzo.com/totally-tabular
Description: Responsive Tabbed Widgets - Aiming to Increase Usability through responsive tabbed-regions & drop-down-menus.
Version: 1.00
Author: Adam McFadyen
Author URI: http://dabzo.com 
License: GPL2

Copyright 2013 Adam McFadyen  (email : adam@dabzo.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

ReadMe: Use [tabular] shortcode to include widgets added to the Tabbed-Sidebar in your WordPress theme. 
Tabs will cycle automatically & are clickable.
*/

require_once('admin-page.php');

function tabular_sidebar(){
  register_sidebar( array(
    'name' => __( 'Tabular Sidebar', 'dabzo' ),
    'id' => 'tabbed-sidebar',
    'description' => __( 'Sidebar to display widgets as tabs via [tabular] shortcode.', 'dabzo' ),
    'before_widget' => '<div class="ttab-widget">',
    'after_widget' => '</div></div>',
    'before_title' => '<h5 class="ttab-title">',
    'after_title' => '</h5><div class="ttab-content">',
  ) );
}
add_action('init', 'tabular_sidebar');

function tabular_code(){
	if ( is_active_sidebar( 'tabbed-sidebar' ) ) :
		$options = get_option('ttabular_settings'); 
		$defaultItemInterval = "5000";
		$itemInterval = $options['rotator_speed'];

		if($itemInterval == NULL)
			$itemInterval = $defaultItemInterval;

		echo'<script>';
		echo'var itemInterval = ' . $itemInterval . ';';
		echo'</script>';
	endif;
}
add_action('wp_footer', 'tabular_code'); 

function my_scripts_method() {
	wp_enqueue_script(
		'ttabular-main',
		plugins_url('/js/main.js' , __FILE__),
		array( 'jquery' )
	);
	wp_enqueue_style(
		'ttabular-style',
		plugins_url('/css/style.css' , __FILE__)
	);
}
//remove_action( 'wp_enqueue_scripts', 'my_scripts_method' );
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

function format_tabular_widgets( $title ) {	
	$title = "<span>" . $title . "</span>";
	return $title;
}

function tabular_shortcode_output(){
	if ( is_active_sidebar( 'tabbed-sidebar' ) ) :
	ob_start();
		echo'<div id="ttab-container" class="widget-area rotator-tab-section">';
		add_filter ( 'widget_title', 'format_tabular_widgets' );
		dynamic_sidebar( 'tabbed-sidebar' );
		remove_filter ( 'widget_title', 'format_tabular_widgets' );
		echo'</div>';
	return ob_get_clean();	
	else:
		return '* Please Add Widgets to the "Tabular Sidebar" *';	
	endif;
}

//[tabular]
function show_tabs( $atts ){
	return tabular_shortcode_output();
}
add_shortcode( 'tabular', 'show_tabs' );

