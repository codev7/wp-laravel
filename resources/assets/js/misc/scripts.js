var init = function() {
    // scripts.js
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
	
    $(document).on('click','.full-screen-screenshot', function(e)
    {

        e.preventDefault();

        var imgLink = $(this).attr('href');

        $('body').append('<div class="screenshot-photo"><a href="#" class="btn btn-xs btn-info-outline close-screenshot">CLOSE</a><img src="' + imgLink + '" /></div>');

        console.log(imgLink);
    });


    var reply_thread_open_class = 'is-opened';
    $(document).on('keyup','.reply-to-a-thread', function(e)
    {


        var _this = $(this);

        if( !_this.hasClass(reply_thread_open_class) && _this.val() != '')
        {

                
                _this.next('.btn-reply-to-thread').fadeIn();

                _this.animate({

                    height: '120px'

                },200).addClass(reply_thread_open_class);

        }
        


    }).on('mouseleave','.reply-to-a-thread', function()
    {
        var _this = $(this);

        if(_this.val() == '')
        {
            _this.next('.btn-reply-to-thread').fadeOut();

            _this.animate({

                height: '50px'

            },200).removeClass(reply_thread_open_class);
        }
    });




    $(document).on('click', '.close-screenshot', function(e)
    {

        e.preventDefault();


        $('.screenshot-photo').each(function(e)
        {   
            var _this = $(this);
            _this.fadeOut(function(){

                _this.remove();

            });
        });


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
		}, 700);
		return false;
	});
	
	$('.visual3').each(function() {
		var $el = $(this).find('.bg-img');
		
		if ($el.length > 0) {
			if($el.hasClass('tiled')) {
				$(this).append('<div class="bg" style="background-image: url(' + $el.attr('src') +'); background-repeat: repeat; background-size: 400px;"></div>');
			} else {
				$(this).append('<div class="bg" style="background-image: url(' + $el.attr('src') +');"></div>');
			}
		}
	});

    // load-more.js
    $('.btn-load-more').on('click', function(e)
    {
        var btn = $(this);

        if(btn.hasClass('disabled')) return false;

        var defaultText = btn.html();

        btn.addClass('disabled').html('LOADING MORE POSTS <i class="fa fa-spin fa-spinner"></i>');

        var contentTarget = '.post-preview';
        var appendTo = '.posts-append';
        var loadMore = '.btn-load-more';

        $.get(btn.attr('href'), function(data) {
            $( appendTo ).append($(data).find( contentTarget ));

            var nextBtn = $(data).find( loadMore ).attr('href');

            if(nextBtn) {
                btn
                    .removeClass('disabled')
                    .html(defaultText)
                    .attr('href',nextBtn);
            } else {
                btn.html('All posts have been loaded!').css('cursor','default');
            }
        });

        e.preventDefault();
    });

};

export default init;