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

function isRouteNameSpace($pathToCheck)
{      
    return str_contains(Request::url(), $pathToCheck);

}

function isRoute($name)
{
    return Route::currentRouteName() == $name;
}

function hasRole($role)
{

    if(Auth::guest()) return false;

    switch($role) {

        case 'sales-rep':


            return Auth::user()->is_sales_rep;

        break;


        case 'developer':

            return Auth::user()->is_developer;

        break;

        case 'admin':

            return Auth::user()->is_admin;

        break;


        case 'mastermind':

            return Auth::user()->is_mastermind;

        break;
    }

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
    $user = Auth::user();
    $output = [
        'logged_in' => Auth::check(),
        'user_id' => Auth::check() ? $user->id : null,
        'admin' => Auth::check() ? Auth::user()->is_admin ? true : false : false,
        'developer' => Auth::check() ? Auth::user()->is_developer ? true : false : false,
        'prod' => isProduction(),
        //'zref_route' => route('zref'),
        'environment' => App::environment()
    ];

    if ($user && $user->currentTeam) {
        $output['team'] = $user->currentTeam->toArray();
    }

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

function isSparkView()
{
    $request = app('request');
    return $request->is('settings*')
      || $request->is('register*')
      || $request->is('spark*')
      || $request->is('login*')
      || $request->is('terms*')
      || $request->is('password*');
}

function setBodyClassIfPjax(array $classes) {
    if (!Request::pjax()) return '';

    $classes = implode(' ', $classes);
    return "
        <script>
            $('body').attr('class', '$classes')
        </script>
    ";
}

/**
 * Generates random string
 * @param int $length
 * @return string
 */
function random_str($length = 8) {
    $possible = "abcdefghijklmnopqrstuvwxyz0123456789";

    return 'e' . substr(str_shuffle($possible), 0, $length - 1);
}

function yesNo($bool) {
    return $bool ? 'Yes' : 'No';
}

function std_column(array $array, $column) {
    $res = [];
    foreach ($array as $item) {
        $res[] = $item->$column;
    }
    return $res;
}

function getGravatarImage($email, $size = 256)
{
    return "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "&s=" . $size . "&default=" . urlencode(asset('images/favicon.png'));
}

/**
 * Used in wrapping up text links with <a> tags in messages markup
 * Class RecursiveDOMIterator
 */
class RecursiveDOMIterator implements RecursiveIterator
{
    protected $_position;
    protected $_nodeList;
    public function __construct(DOMNode $domNode)
    {
        $this->_position = 0;
        $this->_nodeList = $domNode->childNodes;
    }
    public function getChildren() { return new self($this->current()); }
    public function key()         { return $this->_position; }
    public function next()        { $this->_position++; }
    public function rewind()      { $this->_position = 0; }
    public function valid()
    {
        return $this->_position < $this->_nodeList->length;
    }
    public function hasChildren()
    {
        return $this->current()->hasChildNodes();
    }
    public function current()
    {
        return $this->_nodeList->item($this->_position);
    }
}
