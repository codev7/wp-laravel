<?php


function get_status_options($selected = null)
{
    $output = '';
    foreach(CMV\Models\Prospector\Company::$statuses as $status => $description)
    {   

        $output .= '<option ';

        if($selected == $status)
        {
            $output .= 'selected="selected" ';
        }

        $output .= 'value="' . $status . '">' . $status . '</option>';

    }

    return $output;
}

function count_for_rep($email, $company_type = null)
{

    $rep = CMV\User::where('is_sales_rep',true)->with('companies')->whereEmail($email)->first();

    if(!$rep) return 0;

    return $rep->companies()->where('type', $company_type)->count();
}

/*
Usage:
fireJSEvent('Viewed Admin Dashboard','pageview','Viewed Dashboard',['date' => date('Y-m-d')]);
*/
function fireJSEvent($eventName, $eventCategory, $eventAction, $properties = [])
{
    
    $output = [];

    $output[] = [

        'name' => $eventName,
        'category' =>  $eventCategory,
        'action' => $eventAction,
        'properties' => $properties

    ];

    if(Session::has('js_event'))
    {
        $current = json_decode(Session::pull('js_event'));

        $output = array_merge($current, $output);

    }

    Session::put('js_event', json_encode($output));
}


function quoteFieldsProjectFields()
{
    return [
        'PSD to HTML',
        'WordPress Coding',
        'JavaScript Coding',
        'HTML Email Template',
        'Custom Application Development',
        'I\'m not sure',
    ];
}

function leadDeadlineOptions()
{

    return [

        'I need this done asap',
        'My deadline is in 1 week',
        'My deadline is in 1-3 weeks',
        'My deadline is in 1+ months',
        'No deadline, I just want a quote'

    ];

}

function getMarketingHeaderNavigation()
{

    return [

        [
            'text' => 'Developer Daily',
            'route-name' => 'blog',
        ],
        [
            'text' => 'Our Methods',
            'route-name' => 'methods'
        ],
        [
            'text' => 'Work',
            'route-name' => 'our-code'
        ],
        [
            'text' => 'Services',
            'route-name' => 'services',
            'children' => [
                'PSD to HTML' => route('service',['slug' => 'psd-to-html']),
                'Twitter Bootstrap' => route('service',['slug' => 'bootstrap']),
                'PSD to Email' => route('service',['slug' => 'psd-to-email']),
                'WordPress Development' => route('service',['slug' => 'wordpress-development']),
                'Concierge' => route('wp-concierge'),
                'Custom Applications' => route('service',['slug' => 'web-mobile-application-development'])
            ]
        ]
    ];

}

function identifyUserJS()
{

    Session::put('flash_js_identity','yes');

}

function isProduction()
{

    if (App::environment('production')) {
        return true;
    }


    return false;
}

/*  giveUserPropertyJS(['User Type' => 'Admin']); */
function giveUserPropertyJS($properties)
{

    $key = 'js_user_properties';

    if(Session::has( $key ))
    {
        $current = (array) json_decode(Session::pull( $key ));



        $properties = array_merge($current, $properties);

    }

    Session::put( $key , json_encode($properties));
}



function getCodeMyViewsUserObject()
{

    $output = [
        'logged_in' => Auth::check(),
        'user_id' => Auth::check() ? Auth::user()->id : null,
        'admin' => Auth::check() ? Auth::user()->is_admin ? true : false : false,
        'prod' => isProduction(),
        //'zref_route' => route('zref'),
        'environment' => App::environment()

    ];


    return json_encode($output);

}


function ip()
{
    return Request::getClientIp();
}

function before_bugsnag_notify($error)
{

    if (Auth::check()) {
        $error->setMetaData([

            'user' => [
                'id' => Auth::id(),
                'email' => Auth::user()->email
            ]

        ]);
    }
}

function set_active($path, $active = 'active')
{

    return Request::is($path) ? $active : '';

}

function set_active_from_route_name($route_name, $active = 'active')
{


    if (is_array($route_name)) {

        foreach ($route_name as $name) {

            if (Route::currentRouteName() == $name) {
                return $active;
            }
        }

        return false;
    }
    return Route::currentRouteName() == $route_name ? $active : '';

}

function isAdmin()
{
    if (!Auth::check()) return false;

    if (Auth::user()->hasRole('administrator')) return true;

    return false;
}


if (!function_exists("preprint")) {
    function preprint($s, $return = false)
    {
        $x = "<pre>";
        $x .= print_r($s, 1);
        $x .= "</pre>";
        if ($return) return $x;
        else print $x;
    }
}