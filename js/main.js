
  <script>
(function($){ // Closure to avoid jQuery conflicts
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
			$('#tab-container').height($('.tab-widget .tab-content').eq(currentItem).height() + 80);				
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
				$('#tab-container').height($('.tab-widget .tab-content').eq(currentItem).height() + 80).fadeIn(fadeTime);				
				$('.tab-widget .tab-content').eq(currentItem).fadeIn(fadeTime);

				$('.tab-title').click(function(){
				/* $('.tab-widget .tab-content').css('backround', '#00f'); use toggleClass*/  
				//$('.tab-widget .tab-title').removeClass('current-item');
				//$('.tab-title').not(this).removeClass('current-item');
				  $('.tab-widget .tab-title').removeClass('current-item');
				  $(this).toggleClass('current-item');
				  $('.tab-widget .tab-content').fadeOut(fadeTime);
				  $('#tab-container').height($(this).next('.tab-content').height() + 80).fadeIn(fadeTime);
				  $(this).next('.tab-content').fadeIn(fadeTime);
				  clearInterval(infiniteLoop);
				//$('.tab-widget .tab-content').eq(currentItem).fadeOut(fadeTime);
				//$(this).next('.tab-content').eq(this).css('border', '1px solid #0f0');.fadeIn(fadeTime);
				}); 
            }, itemInterval);
        }
    };
 
    InfiniteRotator.init();
});     
})(jQuery);
  </script>