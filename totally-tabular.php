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

ReadMe: Widgets Must have titles for this plgin to work. 
Failure to provide a title ill result in the title-field not showing, breaking layout.
See Lines 33-36
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
?>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
  <style>
  #tab-widget-wrap{
    width:100%;
    height:auto;
    float:left;
    position:fixed;
    bottom:0;left:0;
    
    background:#ccf;  
  }

  #tab-widget{
    position:absolute;

    border:2px groove #000;
    height:180px;
  }  
  .tab-title{
    width:40%;
    margin-right:60%;
    float:left;
    
    background:#00f;
    color:#fff;
    font-size:2em;
    height:80px;
  }    
  .tab-content{
    position:absolute;
    right:0;
    top:0;
    
    width:60%;
    float:right;
    display:none;
    height:auto;
  }    
  .tab-visible{display:block;}
  </style>

<?php
}
add_action('wp_head', 'tabular_code'); 


function show_tabs(){
  
  ?><div id="tab-widget-wrap"><?php
  dynamic_sidebar( 'tabbed-sidebar' );
/*
 function widget($args, $instance){
    //Extract the widget-sidebar parameters from array
    extract($args, EXTR_SKIP);

    echo $before_widget;
    echo $before_title;
    //Display title as stored in this instance of the widget
    echo esc_html($instance['title']); 
    echo $after_title;
    //Widget content
    echo $after_widget;

 }  
*/  //get_sidebar('sidebar-tabbed-sidebar');
  ?></div><?php
?>

  <script type="text/javascript">
  $(window).load(function() { //start after HTML, images have loaded
    var InfiniteRotator =
    {
    init: function()
    {
      var initialFadeIn = 1000; //initial fade-in time (in milliseconds) 
      var itemInterval = 5000; //interval between items (in milliseconds)
      var fadeTime = 2500; //cross-fade time (in milliseconds)
      var numberOfItems = $('.tab-content').length; //count number of items
      var currentItem = 0; //set current item
   
      //show first item
      $('.tab-content').eq(currentItem).fadeIn(initialFadeIn);
   
      //loop through the items
      var infiniteLoop = setInterval(function(){
      $('.tab-content').eq(currentItem).fadeOut(fadeTime);
   
      if(currentItem == numberOfItems -1){
        currentItem = 0;
      }else{
        currentItem++;
      }
      $('.tab-content').eq(currentItem).fadeIn(fadeTime);
   
      }, itemInterval);
    }
    };
    InfiniteRotator.init();
  });  

  jQuery(".tab-title").click(function() {
    jQuery(".tab-widget").find(".tab-content").removeClass("tab-visible");
    jQuery(this).next(".tab-content").css("background", "#0f0"); 
    jQuery(this).next(".tab-content").toggleClass("tab-visible"); 
    //jQuery("#tabbed-content-anchor").prepend(jQuery(this).next(".tab-content")); 
    //jQuery(this).sibling(".tab-content").toggleClass("tab-visible"); 
  });
  </script>
<?php
}
add_action('wp_footer', 'show_tabs');
?>
