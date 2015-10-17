@extends('layouts.master')

@section('meta')

<meta name="description" content="The Developer Daily blog by Code My Views is your one stop resource for all things web.  We post weekly updates about UI/UX, front-end, and everything in between." />

<link rel="canonical" href="{{  $canonical }}" />

@stop

@section('title')
<title>Developer Daily Blog by Code My Views</title>
@endsection

@section('content')
    <div class="container">
        <div class="twocolumns">
            <div class="row">
                <div class="col-lg-8 col-md-9">


                @if($posts->have_posts())

                    <div class="posts-append">
                        <?php while($posts->have_posts()): $posts->the_post(); ?>

                      
                          <div class="post-preview">
                            <header>
                                <?php $term = wp_get_object_terms(get_the_ID(), 'category')[0]->slug; ?>

                                @if($term == 'branding')
                                    <span class="label label-danger category-label">
                                @elseif($term == 'front-end')
                                    <span class="label label-success category-label">
                                @else
                                    <span class="label label-primary category-label">
                                @endif
                                    {{ wp_get_object_terms(get_the_ID(), 'category')[0]->name }}</span>
                                <h2><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
                                <div class="meta">
                                    <p>posted by Code My Views</p>
                                </div>
                            </header>
                            @if(get_field('featured_image'))

                                <a href="{{ get_permalink() }}">{!! wp_get_attachment_image(get_field('featured_image'),'square', true, ['class' => 'img-responsive img-rounded img-base']) !!}</a>
                            
                            @else

                                <a href="{{ get_permalink() }}">{!! wp_get_attachment_image(45604,'square', true, ['class' => 'img-responsive img-rounded img-base']) !!}</a>

                            @endif


                            <a href="{{ get_permalink() }}" class="btn btn-info pull-right">read story</a>
                        </div>
                        <?php endwhile; ?>
                    </div><!--posts-append-->

                    {{ next_posts_link('LOAD MORE POSTS <i class="fa fa-arrow-down"></i>', $posts->max_num_pages) }}
                @else
                    <div class="post-preview">
                        <header>

                            <span class="label label-danger category-label">Nothing Found</span>
                            <h2>Nothing found here.</h2>
                            <div class="meta">
                                <p>Sorry, we could not find what you were looking for.</p>
                            </div>
                        </header>
     




                        <a href="{{ route('blog') }}" class="btn btn-info">Go back to the blog</a>
                    </div>
                @endif
                    
                   
                </div>
                <div class="col-lg-3 col-lg-offset-1 col-md-3">
                    <div class="cell-item">
                        <h3>Learn</h3>
                        <ul class="list-unstyled category-list">
                            <li><a href="{{ route('blog.category',['category' => 'ui-ux']) }}" class="ico-01">UI/UX design</a></li>
                            <li><a href="{{ route('blog.category',['category' => 'front-end']) }}" class="ico-02">front end</a></li>
                            <li><a href="{{ route('blog.category',['category' => 'branding']) }}" class="ico-03">branding</a></li>
                        </ul>
                    </div>
                    <div class="cell-item">
                        <h3>Our Writers</h3>
                        <ul class="media-list writers-list">
                            <li class="media">
                                <div class="media-left">
                                    <img src="{{ asset('images/connor-h.png') }}" alt="image description" class="media-object img-circle" >
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading text-primary">Connor Hood</h4>
                                    <h5 class="role">FOUNDER, CEO</h5>
                                </div>
                            </li>
                            <li class="media">
                                <div class="media-left">
                                    <img src="{{ asset('images/courtney-b.png') }}" alt="image description" class="media-object img-circle" >
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading text-primary">Courtney Booth</h4>
                                    <h5 class="role">COMMUNITY</h5>
                                </div>
                            </li>
                            <li class="media">
                                <div class="media-left">
                                    <img src="{{ asset('images/fred-j.png') }}" alt="image description" class="media-object img-circle" >
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading text-primary">Frederick Jones</h4>
                                    <h5 class="role">QA Specialist</h5>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="cell-item" style="display: none">
                        <h3>Subscribe</h3>
                        <p>Get the latest news and updates from the best client team around.</p>
                        <form class="subscribe-form">
                            <div class="form-group">
                                <label class="sr-only" for="lbl-01">Email address</label>
                                <input type="email" class="form-control" id="lbl-01" placeholder="Email Address">
                            </div>
                            <button type="submit" class="btn btn-default">sign up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /twocolumns -->
    </div><!-- /container -->
    @include('partials/call-to-action')

    @include('partials/contact-info')
@endsection