<?php

namespace CMV\Http\Controllers\MarketingSite;

use Illuminate\Http\Request;
use CMV\Http\Requests;
use CMV\Http\Controllers\Controller;
use Cache;

/**
 * @Middleware("require-wordpress")
 */
class BlogController extends Controller
{
    /**
     * Developer Daily Blog Index 
     * @Get("blog/{paged?}/{page_number?}", as="blog", where={"paged": "page", "page_number": "[0-9]+"})
     * @return Blog Index
     */
    public function blog($paged = null, $page_number = null)
    {       


        global $paged;

        $paged = $page_number;

        $posts = new \WP_Query([
            'post_type' => 'blog-post',
            'posts_per_page' => 10,
            'order' => 'ASC',
            'orderby' => 'post_title',
            'paged' => ( isset($page_number) ) ? $page_number : 1
        ]);

        return $this->minifyHTML(view('marketing/blog/index')->withPosts($posts)->withCanonical( route('blog') ));
    }


    /**
     * Blog Single Post
     * @Get("blog/{slug}", as="blog.post")
     * @param  $slug - slug of post
     * @return single post page view
     */
    public function blogSingle($slug)
    {       

        global $post;
        global $more;


        $args = [
          'name'        => $slug,
          'post_type'   => 'blog-post',
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
        $more = 1;
        $view = view('marketing/blog/post')->withPost( $post );

        return $this->minifyHTML($view);
    }


    /**
     * Blog Category Page
     * @Get("blog/category/{category}/{paged?}/{page_number?}", as="blog.category", where={"paged": "page", "page_number": "[0-9]+"})
     * @param $category - category of posts to display 
     * @return posts sorted by category view
     */
    public function categories($category, $paged = null, $page_number = null)
    {   


        global $paged;

        $paged = $page_number;

        $posts = new \WP_Query([
            'post_type' => 'blog-post',
            'posts_per_page' => 10,
            'order' => 'ASC',
            'orderby' => 'post_title',
            'category_name' => $category,
            'paged' => ( isset($page_number) ) ? $page_number : 1
        ]);

        return $this->minifyHTML(view('marketing/blog/index')->withPosts($posts)->withCanonical( route('blog.category', ['category' => $category]) ));
    }
}
