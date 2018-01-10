/* jQuery rotator courtesy of Brian McNitt @mcnitt - Modified by Adam McFadyen @ajmcfadyen */
(function($){ // Closure to avoid jQuery conflicts
$(window).load(function() { //start after HTML, images have loaded

var itemInterval = ttabular_optionsData.itemInterval;
var layoutOption = ttabular_optionsData.layoutOption;
// alert(layoutOption);
// alert(itemInterval);
$('.ttab-widget .ttab-content').hide(); //hide all items

var InfiniteRotator =
{
  init: function()
  {
    var initialFadeIn = 0; //initial fade-in time (in milliseconds)

    // var itemInterval = 3000; //interval between items (in milliseconds)
    var fadeTime = 500; //cross-fade time (in milliseconds)
    var numberOfContainers = $('.rotator-tab-section').length; //count number of items
    var numberOfItems = $('.widget-area .ttab-widget').length; //count number of items
    var currentItem = 0; //set current item
    
    if(layoutOption=='horizontal'){
      var titleWidth = (((100 / numberOfItems) * numberOfContainers) - 4) + '%'; //container-width minus 2% padding on either side
      $('.ttab-title').css('width', titleWidth); //assign ttab-title widths (100/numberOfItems-padding)
    }
    
    //show first item
    $('.ttab-widget .ttab-title').eq(currentItem).addClass('current-item');
    $('#ttab-container').height($('.ttab-widget .ttab-content').eq(currentItem).height());        
    $('.ttab-widget .ttab-content').eq(currentItem).fadeIn(fadeTime);

    $('.ttab-title').click(function(){
      $('.ttab-widget .ttab-title').removeClass('current-item');
      $(this).addClass('current-item');
      $('.ttab-widget .ttab-content').hide();
      $('#ttab-container').height($(this).next('.ttab-content').height()).fadeIn(fadeTime);
      $(this).next('.ttab-content').show();

      clearInterval(infiniteLoop);
    }); 
  
    //loop through the items
    var infiniteLoop = setInterval(function(){
      $('.ttab-widget .ttab-content').eq(currentItem).hide();
      
      if(currentItem == numberOfItems -1){
        currentItem = 0;
      }else{
        currentItem++;
      }
      
      $('.ttab-widget .ttab-title').removeClass('current-item');
      $('.ttab-widget .ttab-title').eq(currentItem).addClass('current-item');
      $('#ttab-container').height($('.ttab-widget .ttab-content').eq(currentItem).height()).fadeIn(fadeTime);        
      $('.ttab-widget .ttab-content').eq(currentItem).fadeIn(fadeTime);

    }, itemInterval);
  }
};

InfiniteRotator.init();

});     
})(jQuery);