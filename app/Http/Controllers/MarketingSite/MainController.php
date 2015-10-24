<?php

namespace CMV\Http\Controllers\MarketingSite;

use Illuminate\Http\Request;
use CMV\Http\Requests;
use CMV\Http\Controllers\Controller;

class MainController extends Controller
{
    /**
     * Home Page Controller
     * @Get("concept", as="concept") 
     * @return Design concept page view
     */
    public function concept()
    {
        return view('concept');
    }

    /**
     * Home Page Controller
     * @Get("/", as="home") 
     * @return Home page view
     */
    public function home()
    {

        return $this->minifyHTML(view('marketing/home'));

    }

    /**
     * About Us
     * @Get("about-us", as="about-us")
     * @return About us view
     */
    public function aboutUs()
    {
        return $this->minifyHTML(view('marketing/about-us'));
    }

    /**
     * Legal
     * @Get("legal", as="legal")
     * @return About us view
     */
    public function legal()
    {
        return $this->minifyHTML(view('marketing/legal'));
    }

    /**
     * Methodology
     * @Get("our-methods", as="methods")
     * @return Methodology View
     */
    public function ourMethods()
    {  
        return $this->minifyHTML(view('marketing/our-methods'));
    }


    /**
     * Methodology
     * @Get("knowledgebase/earn-more-money-as-a-designer", as="jason-the-designer")
     * @return Methodology View
     */
    public function jasonTheDesigner()
    {  
        return $this->minifyHTML(view('marketing/earn-more-money'));
    }

    /**
     * Coding Portfolio
     * @Get("our-work/code", as="our-code")
     * @return Coding Portfolio View
     */
    public function codingPortfolio()
    {  

        return view('marketing/portfolio')
                ->with('h1_title', 'Our Code')
                ->with('cssPreview', view('partials/css-preview'))
                ->with('htmlPreview', view('partials/html-template'));

    }

    /**
     * Portfolio Items --- need to add middleware
     * @Get("code/get", middleware="ajax")
     * @return Coding Portfolio View
     */
    public function getPortfolioItems(Request $request)
    {
        $items = [];
        
        $items[] = [
            'name' => 'Detail Delivery',
            'type' => 'Design & WordPress',
            'image' => asset('images/detail-delivery.jpg'),
            'preview_link' => 'http://detaildelivery.com',
            'description' => 'We created the HTML and also made a custom WordPress theme for detail delivery!',
            'tabs' => [
                [
                    'text' => 'View Front-page.php',
                    'icon' => 'wordpress',
                    'content' => view('marketing/portfolio/detaildelivery-frontpage')->render(),
                    'id' => 'tab-2',
                    'code_type' => 'html'
                ],
                [
                    'text' => 'View CSS/LESS',
                    'icon' => 'css3',
                    'content' => htmlentities( view('marketing/portfolio/detaildelivery-css')->render() ),
                    'id' => 'tab-1',
                    'code_type' => 'css'
                ],
            ],
            'show_empty' => true
        ];

        $items[] = [
            'name' => 'Mic.pics',
            'type' => 'Bootstrap / Laravel',
            'image' => asset('images/micpics.jpg'),
            'preview_link' => 'http://panora.mic.pics',
            'description' => 'For this project, we created a custom twitter bootstrap theme that was then used in the custom Laravel application.',
            'tabs' => [
                [
                    'text' => 'View HTML',
                    'icon' => 'plus',
                    'content' => view('marketing/portfolio/micpics-html')->render(),
                    'id' => 'tab-1',
                    'code_type' => 'html'
                ],
                [
                    'text' => 'View CSS',
                    'icon' => 'plus',
                    'content' => view('marketing/portfolio/micpics-css')->render(),
                    'id' => 'tab-2',
                    'code_type' => 'css'
                ]
            ],
            'show_empty' => true
        ];
        $items[] = [
            'name' => 'LotPlans',
            'type' => 'PSD to HTML',
            'image' => asset('images/lotplans.jpg'),
            'preview_link' => 'https://lotplans.com',
            'description' => 'For the LotPlans project, our team took care of the entire stack of development.  Everything from wireframes, to design, to PSD to HTML.  We even built a custom Laravel application that is now used as their main interface for customers.',
            'tabs' => [
                [
                    'text' => 'View HTML',
                    'icon' => 'plus',
                    'content' =>  view('marketing/portfolio/lotplans-html')->render(),
                    'id' => 'tab-1',
                    'code_type' => 'html'
                ],
                [
                    'text' => 'View CSS',
                    'icon' => 'plus',
                    'content' => view('marketing/portfolio/lotplans-css')->render(),
                    'id' => 'tab-2',
                    'code_type' => 'css'
                ]
            ],
            'show_empty' => true
        ];

        $items[] = [
            'name' => 'Slack Commands',
            'type' => 'PHP / Laravel / API Integrations',
            'image' => asset('images/slack-laravel-command.jpg'),
            'preview_link' => 'https://api.slack.com/',
            'description' => 'We recently did some work the slack API.  A customer asked us to write a command that could be dispatched in their Laravel 5 application.  In this case, the command connects to the Slack API and sends a message.  We love integrating with different APIs around the web - let us know what API you want integrated in your next project.',
            'tabs' => [
                [
                    'text' => 'View PHP',
                    'icon' => 'plus',
                    'content' => view('marketing/portfolio/slack-command')->render(),
                    'id' => 'tab-1',
                    'code_type' => 'html'
                ]
            ],
            'show_empty' => true
        ];

        $items[] = [
            'name' => 'Wahooly',
            'type' => 'PSD to Email',
            'image' => asset('images/wahooly.jpg'),
            'preview_link' => 'http://wahooly.psd2email.codemyviews.com',
            'description' => 'This is a PSD to Email template created for Wahooly.  As you can see, we had to use tables because for email templates you almost always have to use a table layout in order to be cross-device and cross-application compatible.  We support all email clients, and test in all devices.',
            'tabs' => [
                [
                    'text' => 'View HTML',
                    'icon' => 'plus',
                    'content' => htmlentities(view('marketing/portfolio/wahooly')->render()),
                    'id' => 'tab-1',
                    'code_type' => 'html'
                ]
            ],
            'show_empty' => true
        ];

        $items[] = [
            'name' => 'React.js',
            'type' => 'JavaScript Project',
            'image' => asset('images/react.jpg'),
            'description' => 'We recently had a customer ask us to integrate their front end into the React.js framework.  We cannot show the actual site because of NDA, but below is a snapshot of some of the code we wrote.',
            'tabs' => [
                [
                    'text' => 'View JavaScript',
                    'icon' => 'plus',
                    'content' => view('marketing/portfolio/react-js')->render(),
                    'id' => 'tab-1',
                    'code_type' => 'javascript'
                ]
            ],
            'show_empty' => false,
            'preview_link' => 'https://facebook.github.io/react/docs/getting-started.html'
        ];

        $items[] = [
            'name' => 'Vue.js (This Portfolio Page)',
            'type' => 'JavaScript Project',
            'image' => asset('images/vuejs.jpg'),
            'preview_link' => 'https://codemyviews.com/our-work/code',
            'description' => 'The portfolio page you are looking at, including this modal window, were built using the Vue.js JavaScript framework.  Ask us about this and we can use it in your next project.',
            'tabs' => [
                [
                    'text' => 'View JavaScript',
                    'icon' => 'plus',
                    'content' => view('marketing/portfolio/vue-js')->render(),
                    'id' => 'tab-1',
                    'code_type' => 'javascript'
                ],
                [
                    'text' => 'View HTML',
                    'icon' => 'html5',
                    'content' => view('marketing/portfolio/vue-html')->render(),
                    'id' => 'tab-2',
                    'code_type' => 'html'
                ]
            ],
            'show_empty' => false
        ];


        return response()->json($items);
    }


    /**
     * Testimonials
     * @Get("testimonials/why-our-customers-love-us", as="testimonials")
     * @return Testimonial View
     */
    public function testimonials()
    {   
        return redirect()->route('home');
        return view('marketing/testimonials');
    }

    /**
     * Pricing
     * @Get("pricing", as="pricing")
     * @param  
     * @return 
     */
    public function pricing()
    {
        return redirect()->to('/');
        //return view('marketing/pricing');
    }

    /**
     * Free Quote
     * @Get("quote", as="quote")
     * @return Quote View
     */
    public function freeQuote()
    {   
        
        return redirect()->route('project.new');
    }
}
