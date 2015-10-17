$(document).on('ready', function()
{

    $('.btn-load-more').on('click', function(e)
    {

        var btn = $(this);


        if(btn.hasClass('disabled')) return false;

        var defaultText = btn.html();


        btn.addClass('disabled').html('LOADING MORE POSTS <i class="fa fa-spin fa-spinner"></i>');

        var contentTarget = '.post-preview';

        var appendTo = '.posts-append';

        var loadMore = '.btn-load-more';

        $.get(btn.attr('href'), function(data)
        {


            $( appendTo ).append($(data).find( contentTarget ));


            var nextBtn = $(data).find( loadMore ).attr('href');

            if(nextBtn)
            {

                btn
                    .removeClass('disabled')
                    .html(defaultText)
                    .attr('href',nextBtn);

                console.log('more');
            }
            else
            {   

                btn.html('All posts have been loaded!').css('cursor','default');

            }

        });


        e.preventDefault();
    });


    
});