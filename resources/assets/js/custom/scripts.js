$(document).ready(function(){
	
	customForm.lib.domReady(function(){
		
		customForm.customForms.replaceAll();
	
	});
	
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
	
	(function() {
		var $parent = $('.visual').find('.yt-block'),
			$logo = $parent.find('.logo'),
			$corner = $parent.find('.corner'),
			$point1 = $parent.find('.point-01'),
			$point2 = $parent.find('.point-02'),
			$glass = $parent.find('.glass'),
			$light = $parent.find('.light'),
			$devices = $parent.find('.devices'),
			$state = $parent.find('.state'),
			$btn = $parent.find('.btn-restart'),
			activeClass = 'animated',
			arr = ['ind-white', 'ind-blue', 'ind-green'],
			arr2 = ['ind-red', 'ind-yellow', 'ind-black'],
			arr3 = ['time1', 'time2', 'time3'];
		
		$devices.each(function() {
			var $el = $(this).find('img');
			if ($el.length > 0) {
				$(this).find('.device').find('.img').append($el.clone());
			}
		});
		$light.find('.ind').each(function() {
			$(this).addClass(arr[getRandomInt(0,2)]);
			$(this).addClass(arr2[getRandomInt(0,2)]);
			$(this).addClass(arr3[getRandomInt(0,2)]);
		});
		function getRandomInt(min, max) {
			return Math.floor(Math.random() * (max - min + 1)) + min;
		}
		function startMove() {
			setTimeout(function() {
				$logo.addClass(activeClass);
			}, 2000);
			setTimeout(function() {
				$logo.fadeOut();
				$corner.addClass(activeClass);
			}, 3000);
			setTimeout(function() {
				$corner.removeClass(activeClass);
			}, 3500);
			setTimeout(function() {
				$point1.addClass(activeClass);
			}, 4500);
			setTimeout(function() {
				$point1.removeClass(activeClass);
			}, 5000);
			setTimeout(function() {
				$glass.addClass(activeClass);
			}, 6000);
			setTimeout(function() {
				$glass.removeClass(activeClass);
			}, 6500);
			setTimeout(function() {
				$light.addClass(activeClass);
			}, 7500);
			setTimeout(function() {
				$light.removeClass(activeClass);
			}, 10000);
			setTimeout(function() {
				$point2.addClass(activeClass);
			}, 11000);
			setTimeout(function() {
				$point2.removeClass(activeClass);
			}, 11500);
			setTimeout(function() {
				$devices.addClass(activeClass);
			}, 12500);
			setTimeout(function() {
				$devices.removeClass(activeClass);
			}, 15500);
			setTimeout(function() {
				$state.addClass(activeClass);
			}, 16500);
		}
		//startMove();
		/*$btn.on('click', function() {
			if ($(this).next().hasClass(activeClass)) {
				$parent.find('.' + activeClass).removeClass(activeClass);
				setTimeout(function() {
					$logo.fadeIn(300);
					startMove();
				}, 1000);
			}
			return false;
		});*/
	})();

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