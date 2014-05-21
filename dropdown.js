$(document).ready(function () {	
	$('#list .middle_row_header li ul').removeClass('sub_menu_header');
	$('#list .middle_row_header li').hover(
		function () {
			//show its submenu
			//$(this).find('ul').slideDown(500);   same this as below
			$('ul', this).stop(true).slideDown({duration : 500, easing : 'easeOutBounce'});
		}, 
		function () {
			//hide its submenu
			//$(this).find('ul').slideUp(500);
			$('ul', this).stop(true).slideUp({duration : 100, easing : 'easeInBounce'});			
		}
	);
	//fix this
	
	$('#list .middle_row_header li ul li').mouseenter(
		function () {
			$(this).find('div').animate({
				width : $(this).width(),
				 left: $(this).position().left
			},
			{
            duration: 'slow', 
            easing: 'easeOutElastic',
            queue: false
          });
		}
	
	);
	
});