<?php

namespace CMV\Console\Commands;

use Illuminate\Console\Command;

class ImportDesignShackPostsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        /*
        define('WP_USE_THEMES', false);
        require base_path().'/wordpress/wp-blog-header.php';

        $articles = [
            'http://designshack.net/articles/layouts/10-ways-to-use-mapping-in-web-or-app-design/',
            'http://designshack.net/articles/inspiration/10-tips-for-designing-for-wearables-and-watches/',
            'http://designshack.net/articles/50-shades-of-black-effective-use-of-no-color/',
            'http://designshack.net/articles/accessibility/should-we-kill-the-captcha/',
            'http://designshack.net/articles/business-articles/how-to-find-or-create-your-brand-personality/',
            'http://designshack.net/articles/css/10-less-css-examples-you-should-steal-for-your-projects/',
            'http://designshack.net/articles/css/5-really-useful-responsive-web-design-patterns/',
            'http://designshack.net/articles/css/how-to-build-a-minimalist-user-profile-layout-with-content-tabs/',
            'http://designshack.net/articles/css/how-to-center-anything-with-css/',
            'http://designshack.net/articles/css/inner-shadows-in-css-images-text-and-beyond/',
            'http://designshack.net/articles/css/mobilefirst/',
            'http://designshack.net/articles/css/the-lowdown-on-absolute-vs-relative-positioning/',
            'http://designshack.net/articles/css/the-lowdown-on-before-and-after-in-css/',
            'http://designshack.net/articles/graphics/the-difference-between-ui-and-ux/',
            'http://designshack.net/articles/inspiration/25-awesome-responsive-blog-designs/',
            'http://designshack.net/articles/javascript/how-to-easily-manage-cookies-within-jquery/',
            'http://designshack.net/articles/javascript/sliding-client-testimonials-carousel-with-jquery/',
            'http://designshack.net/articles/layouts/15-tips-for-creating-a-great-website-footer/',
            'http://designshack.net/articles/layouts/how-to-design-an-email-people-will-actually-read-on-their-phones/',
            'http://designshack.net/articles/typography/whats-the-deal-with-em-and-rem/',
            'http://designshack.net/articles/webstandards/10-ux-phrases-and-terms-to-know-right-now/',
            'http://designshack.net/articles/business-articles/design-checklist-tips-and-examples/',
            'http://designshack.net/articles/business-articles/do-you-need-a-style-guide/',
            'http://designshack.net/articles/business-articles/how-to-hold-a-meeting-that-gets-everyone-excited-about-design/',
            'http://designshack.net/articles/business-articles/why-good-website-design-matters-for-every-business/',
            'http://designshack.net/articles/competitions/form-building-from-a-designers-perspective/',
            'http://designshack.net/articles/graphics/10-tips-for-designing-icons-that-dont-suck/',
            'http://designshack.net/articles/inspiration/7-tips-for-designing-a-better-checkout-page/',
            'http://designshack.net/articles/inspiration/designing-without-images-making-typography-work-for-you/',
            'http://designshack.net/articles/layouts/how-to-balance-text-and-visual-content-in-design/',
            'http://designshack.net/articles/layouts/minimal-design-how-to-design-more-with-less/',
            'http://designshack.net/articles/typography/7-tips-for-choosing-the-best-web-font-for-your-design/',
            'http://designshack.net/articles/typography/tips-for-designing-better-mobile-typography/'
        ];
        $this->u = '';
        $this->pw = '';


        $args = [
          'name'        => $slug,
          'post_type'   => 'blog-post',
          'post_status' => 'publish',
          'numberposts' => -1
        ];

        $posts = get_posts($args);


        foreach($posts as $post)
        {

            
            update_field('field_557cdeddb29a5', 'Reading an article entitled '.$post->post_title.' on Code My Views.' ,$post->ID);
            update_field('field_557cdef9b29a6', $post->post_title ,$post->ID);
            update_field('field_557ce01abdb84', 'Get a quote in less than an hour',$post->ID);
            update_field('field_557ce03cbdaf6', 'Learn More',$post->ID);
            update_field('field_557ce04f5fb47', 'https://codemyviews.com/quote',$post->ID);


        }

        return true;*/
    }
}
