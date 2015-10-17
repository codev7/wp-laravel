/* Include CSRF token on all ajax requests done through vue.js */
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');


/* This is for the dropdown menu in header */
//var menu = new cbpTooltipMenu( document.getElementById( 'cbp-tm-menu' ) );

//hljs.initHighlightingOnLoad();

/* This is for tabs on services page 
if(document.getElementById('tabs'))
{
    //new CBPFWTabs( document.getElementById( 'tabs' ) );    
}*/

$(document).on('ready',function()
{   

    /* Tooltip Class 
    $('.tooltipper').tooltip();*/

    /* Typeahead on home page 
	$(".typeahead").typed({
		strings: ['HTML', 'Bootstrap' , 'HAML','Blade','WordPress','Anything'],
		typeSpeed: 100,
		startDelay: 1000,
        callback: function()
        {

            $('.typed-cursor').remove();

        }
	});*/


    /* Fix the navbar
	$(document).on('scroll',function(e)
	{      
        var $navBar = $('#main-navbar-header');
        
        $navBar.addClass('white');

        if(document.body.scrollTop === 0)
        {
            $navBar.removeClass('white');
        }
		
	}); */

    
    $('.jobs').on('click', function()
    {

        alert("Welcome to step 1 of the Code My Views Inc. team member interview.  We are delighted to see you are interested in working with us.  To get to step 2 of the developer interview, please view your developer console in the browser.  If you don't know what that is then I bet google will be able to tell you!");


        console.log("Congrats!  You made it to step 2.  To get to step 3, run this JavaScript function in the developer console: getStep3(yourEmailHere)");


        return false;

    });
});