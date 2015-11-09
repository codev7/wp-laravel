$(document).ready(function(){
	
	$('.gallery').each(function() {
		var $el = $(this).find('.gallery-nav').children(),
			width = ~~($(this).find('.gallery-nav').outerWidth() / $el.length);

		$el.css('width', width);
	});

	$('.gallery').slick({
		arrows: false,
		dots: true,
		slide: '.slide'
	}).find('.gallery-nav').find('a').on('click', function() {
		var ix = $(this).closest('li').index(),
			activeClass = 'active';
		$(this).closest('.gallery').slick('slickGoTo', parseInt(ix));
		$(this).closest('li').addClass(activeClass).siblings('.' + activeClass).removeClass(activeClass);
		return false;
	});

	$('.gallery').on('afterChange', function(event, slick, direction)
	{
		var ix = $('.slick-dots li.slick-active').index();

		var num = parseInt(ix) + 1;

		$('.gallery-nav li').removeClass('active');
		$('.gallery-nav li:nth-child('+ num +')').addClass("active");
		
	});	
	


	$('.tooltipper').tooltip();
	
	function setZindex($items) {
		var length = $items.length;
		for (var i = 0; i < length; i++) {
			$items.eq(i).css('z-index', length - i);
		}
	}
	setZindex($('#header ~ section'));
	
	$('.testimonial-area').find('.testimonial').matchHeight();
	$('.contact-info').find('.contact-item').find('.descr').matchHeight();
	
	$('.contact-info .contact-item .photos span, .images-block .img').each(function() {
		var $el = $(this).find('img');
		if ($el.length > 0) {
			$(this).css('background-image', 'url(' + $el.attr('src') + ')');
		}
	});
	
	$('.visual2').each(function() {
		var $el = $(this).find('.bg-img');
		if ($el.length > 0) {
			$(this).css('background-image', 'url(' + $el.attr('src') + ')');
		}
	});

	$('.btn-to-next').click(function(){
		$('html,body').animate({
			scrollTop: $(this).closest('section').next().offset().top
		}, 700)
		return false;
	});
	
	$('.visual3').each(function() {
		var $el = $(this).find('.bg-img');
		
		if ($el.length > 0) {

			if($el.hasClass('tiled'))
			{
				$(this).append('<div class="bg" style="background-image: url(' + $el.attr('src') +'); background-repeat: repeat; background-size: 400px;"></div>');
			}
			else
			{	
				$(this).append('<div class="bg" style="background-image: url(' + $el.attr('src') +');"></div>');
			}

			
		}
	});

});