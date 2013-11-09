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

#tabbed-sidebar{
  width:800px;
  margin:auto;
  height:248px;
  background:#fff;

  position:relative;  
  
  -moz-box-shadow: 0 0 1px #515151, 0 0 1px #515151;
  -webkit-box-shadow: 0 0 1px #515151, 0 0 1px #515151;
  box-shadow: 0 0 1px #515151, 0 0 1px #515151;
  
  top:0;
  left:0;
  -moz-border-radius:8px;-webkit-border-radius:8px;border-radius:8px;
}
.tab-title{
  width:40%;
  margin-right:60%;
  float:left;
  
  color:#fff;
  font-size:22px;
  line-height:62px;
  font-family: 'Aller-Light', 'Arial', 'Helvetica', Sans-serif, sans;
  text-transform:uppercase;
  text-align: center;
  
  /*padding: 18px 0;
  padding: 14px 0;*/
  height:62px;
    
  background:#5ca441;
  background-image: -moz-linear-gradient(left, #366d34, #69b646);
  background-image: -ms-linear-gradient(left, #366d34, #69b646);
  background-image: -webkit-linear-gradient(left, #366d34, #69b646);
  background-image: -o-linear-gradient(left, #366d34, #69b646);
  background-image: linear-gradient(left, #366d34, #69b646);
  
  position:relative;
  z-index:90;
  
  -moz-box-shadow: inset -1px -1px 1px #5ca441;
  -webkit-box-shadow: inset -1px -1px 1px #5ca441;
  box-shadow: inset -1px -1px 1px #5ca441;  
}   

.tab-widget:first-child .tab-title{
  -moz-border-radius-topleft: 8px; -webkit-border-top-left-radius: 8px; border-top-left-radius: 8px;
}
.tab-widget:last-child .tab-title{
  -moz-border-radius-bottomleft: 8px; -webkit-border-bottom-left-radius: 8px; border-bottom-left-radius: 8px;
}

.tab-widget .current-item{
  background:#003169;
  background-image: -moz-linear-gradient(top, #013d79, #002559);
  background-image: -ms-linear-gradient(top, #013d79, #002559);
  background-image: -webkit-linear-gradient(top, #013d79, #002559);
  background-image: -o-linear-gradient(top, #013d79, #002559);
  background-image: linear-gradient(top, #013d79, #002559);
  
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;   
}
.tab-widget .current-item:after{
  content: "";
  width:16px;
  height:34px;
  float:right;
  margin-right:-16px;
  margin-top:14px;
  background: url(img/tab-widget-current.png) no-repeat;
}
.tab-content{
  width:52%;
  height:212px;
  padding:18px 4%;
  float:right;
  color:#003d7b;
  display:none;
  /*display:block;*/
  position:absolute;
  right:0;
  top:0;
  z-index:80;
  background: #fff url(img/tab-widget-content.png) repeat-y top left;
  -moz-border-radius-topright: 8px; -webkit-border-top-right-radius: 8px;  border-top-right-radius: 8px;
  -moz-border-radius-bottomright: 8px; -webkit-border-bottom-right-radius: 8px; border-bottom-right-radius: 8px;
}   

.tab-content h6{font-size:30px;text-transform:uppercase;}
.tab-widget-content-title-green{color:#69b645;font-family: 'Aller-Light', 'Arial', 'Helvetica', Sans-serif, sans;} 
.tab-widget-content-title-blue{color:#1d417a;font-weight:bold;font-family: 'Aller-Bold', 'Arial', 'Helvetica', Sans-serif, sans;}
/*.tab-visible{display:block;}*/  
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
  <script>
$(window).load(function() { //start after HTML, images have loaded
  $('.tab-widget .tab-content').hide(); //hide all items
  
    var InfiniteRotator =
    {
        init: function()
        {
            var initialFadeIn = 0; //initial fade-in time (in milliseconds)
            var itemInterval = 3000; //interval between items (in milliseconds)
            var fadeTime = 1500; //cross-fade time (in milliseconds)
 
            var numberOfItems = $('.tab-widget').length; //count number of items
            var currentItem = 0; //set current item
 
            //show first item
            $('.tab-widget .tab-title').eq(currentItem).toggleClass('current-item');
      $('.tab-widget .tab-content').eq(currentItem).fadeIn(fadeTime);
 
            //loop through the items
            var infiniteLoop = setInterval(function(){
        $('.tab-widget .tab-content').eq(currentItem).fadeOut(fadeTime);
                
        //$('.tab-title').not(this).removeClass('current-item');
                if(currentItem == numberOfItems -1){
                    currentItem = 0;
                }else{
                    currentItem++;
                }
        
        $('.tab-widget .tab-title').removeClass('current-item');
                $('.tab-widget .tab-title').eq(currentItem).toggleClass('current-item');

                $('.tab-widget .tab-content').eq(currentItem).fadeIn(fadeTime);
        
        $('.tab-title').click(function(){
          /* $('.tab-widget .tab-content').css('backround', '#00f'); use toggleClass*/  
          //$('.tab-widget .tab-title').removeClass('current-item');
          //$('.tab-title').not(this).removeClass('current-item');
          $('.tab-widget .tab-title').removeClass('current-item');
          
          $(this).toggleClass('current-item');
        
          
          $('.tab-widget .tab-content').hide();
          $(this).next('.tab-content').show();
          clearInterval(infiniteLoop);
            //$('.tab-widget .tab-content').eq(currentItem).fadeOut(fadeTime);
            //$(this).next('.tab-content').eq(this).css('border', '1px solid #0f0');.fadeIn(fadeTime);
        }); 
            }, itemInterval);
        }
    };
 
    InfiniteRotator.init();
});     
  </script>
<?php
}
add_action('wp_head', 'tabular_code'); 

//[foobar]
function show_tabs( $atts ){
  return '<?php if ( is_active_sidebar( \'tabbed-sidebar\' ) ) : ?><div id="tab-container" class="widget-area rotator-tab-section">' . dynamic_sidebar( 'tabbed-sidebar' ) . '</div><?php endif; ?>';
}
add_shortcode( 'tabular', 'show_tabs' );


