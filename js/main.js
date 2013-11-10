/* jQuery rotator courtesy of Brian McNitt @mcnitt - Modified with care by Adam McFadyen @ www.dabzo.com*/
(function($){ // Closure to avoid jQuery conflicts
$(window).load(function() { //start after HTML, images have loaded

$('.tab-widget .tab-content').hide(); //hide all items
var InfiniteRotator =
{
  init: function()
  {
    var initialFadeIn = 0; //initial fade-in time (in milliseconds)
 //   var itemInterval = 3000; //interval between items (in milliseconds)
    var fadeTime = 500; //cross-fade time (in milliseconds)

    var numberOfItems = $('.tab-widget').length; //count number of items
    var currentItem = 0; //set current item
	var verticalPadding = 120; //a little wiggle-room

	var titleWidth = (100 / numberOfItems - 4) + '%'; //container-width minus 2% padding on either side
	$('.tab-title').css('width', titleWidth); //assign tab-title widths (100/numberOfItems-padding)
	
    //show first item
    $('.tab-widget .tab-title').eq(currentItem).addClass('current-item');
    $('#tab-container').height($('.tab-widget .tab-content').eq(currentItem).height() + verticalPadding);        
    $('.tab-widget .tab-content').eq(currentItem).fadeIn(fadeTime);

  $('.tab-title').click(function(){
	$('.tab-widget .tab-title').removeClass('current-item');
	$(this).addClass('current-item');
	$('.tab-widget .tab-content').hide();
	$('#tab-container').height($(this).next('.tab-content').height() + verticalPadding).fadeIn(fadeTime);
	$(this).next('.tab-content').show();
	clearInterval(infiniteLoop);
  }); 
	
    //loop through the items
    var infiniteLoop = setInterval(function(){
      $('.tab-widget .tab-content').eq(currentItem).hide();
      
      if(currentItem == numberOfItems -1){
        currentItem = 0;
      }else{
        currentItem++;
      }
      
      $('.tab-widget .tab-title').removeClass('current-item');
      $('.tab-widget .tab-title').eq(currentItem).addClass('current-item');
      $('#tab-container').height($('.tab-widget .tab-content').eq(currentItem).height() + verticalPadding).fadeIn(fadeTime);        
      $('.tab-widget .tab-content').eq(currentItem).fadeIn(fadeTime);

    }, itemInterval);
  }
};

InfiniteRotator.init();

});     
})(jQuery);