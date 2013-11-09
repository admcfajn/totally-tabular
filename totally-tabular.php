<?php
/*
Plugin Name: Totally Tabular
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Aiming to Increase Usability through responsive tabbed-regions & drop-down-menus.
Version: 0.1
Author: Adam McFadyen
Author URI: http://dabzo.com 
License: GPL2

Copyright 2013 Adam McFadyen  (email : adam@dabzo.com)

This is my first WordPress plugin. I've been building WordPress-sites for 5 years now.

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

ReadMe: Widgets Must have titles for this plugin to work. 
Failure to provide a title will result in the title-field not showing, breaking layout.

Use [tabular] shortcode to include widgets added to the Tabbed-Sidebar in your WordPress theme. 
Tabs will cycle automatically & are clickable.
*/
function tabular_sidebar(){
  register_sidebar( array(
    'name' => __( 'Tabbed Sidebar', 'dabzo' ),
    'id' => 'tabbed-sidebar',
    'description' => __( 'Side-bar to display widgets as tabs', 'dabzo' ),
    'before_widget' => '<div class="tab-widget">',
    'after_widget' => '</div></div>',
    'before_title' => '<h5 class="tab-title">',
    'after_title' => '</h5><div class="tab-content">',
  ) );
}
add_action('init', 'tabular_sidebar');

function tabular_code(){
	echo '<script>window.jQuery || document.write(\'<script src="js/vendor/jquery-1.10.2.min.js"><\/script>\')</script>';
	require_once('css/style.css');
	require_once('js/main.js');
}
add_action('wp_head', 'tabular_code'); 

function tabular_shortcode_output(){
	if ( is_active_sidebar( 'tabbed-sidebar' ) ) :
		echo'<div id="tab-container" class="widget-area rotator-tab-section">';
		// dynamic_sidebar( 'tabbed-sidebar' );
		dynamic_sidebar( 'tabbed-sidebar' );
	//	echo'<br style="position:absolute;clear:both;" />';
		echo'</div>';
	endif;
}

//[tabular]
function show_tabs( $atts ){
	return tabular_shortcode_output();
}
add_shortcode( 'tabular', 'show_tabs' );


?>