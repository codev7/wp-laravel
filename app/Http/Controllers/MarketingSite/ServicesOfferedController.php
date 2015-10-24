<?php

namespace CMV\Http\Controllers\MarketingSite;

use Illuminate\Http\Request;
use CMV\Http\Requests;
use CMV\Http\Controllers\Controller;

class ServicesOfferedController extends Controller
{
    /**
     * Services Offered View
     * @Get("services", as="services")
     * @return Services Offered
     */
    public function services()
    {
        

        return redirect()->to('services/psd-to-html');

        return $this->minifyHTML(view('marketing/services/index'));

    }


    /**
     * Services Offered View
     * @Get("wordpress-concierge", as="wp-concierge")
     * @return Services Offered
     */
    public function concierge()
    {


        return $this->minifyHTML(view('marketing/concierge'));


    }


    /**
     * Display the specified resource.
     *  @Get("services/{slug}", as="service")
     * @param  int  
     * @return Response
     */
    public function service($slug)
    {

        if($slug == 'javascript') return redirect()->route('service', ['slug' => 'psd-to-html']);
        if($slug == 'web-application-development')  return redirect()->route('service',['slug' => 'web-mobile-application-development']);
        if($slug == 'wordpress-plugin-development')  return redirect()->route('service',['slug' => 'wordpress-development']);
        
        global $post;
        global $more;

        $args = [
          'name'        => $slug,
          'post_type'   => 'landing-page',
          'post_status' => 'publish',
          'numberposts' => 1
        ];

        $posts = get_posts($args);

        if(!$posts)
        {
            abort('404');
        }

        $post = $posts[0];
        setup_postdata($post);
        
        return $this->minifyHTML(view('marketing/services')->withPost($post));

    }
}
