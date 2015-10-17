@extends('layouts.master')

@section('body')
<body class="blog-detail-page">
@endsection

@section('title')
<title>{{ get_field('title_tag') }}</title>
@stop

@section('meta')

<meta name="description" content="{{ get_field('meta_description') }}" />

@if(get_field('canonical_tag'))
<link rel="canonical" href="{{  get_field('canonical_tag') }}" />

@else

<link rel="canonical" href="{{  get_permalink()  }}" />

@endif
@stop

@section('content_grouping')
@if(get_field('content_group'))
    ga('set', 'contentGroup1', '{{ get_field('content_group') }}');
@endif
@stop

@section('content')
    <section class="visual2 text-center">
        <div class="container">
            <img class="bg-img" src="{{ asset('images/img-39.jpg') }}" alt="{{ get_the_title() }}" >
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                    <h1>{{ get_the_title() }}</h1>
                    <p>
                        <?php $term = wp_get_object_terms(get_the_ID(), 'category')[0]->slug; ?>

                        @if($term == 'branding')
                            <span class="label label-danger category-label">Branding</span>
                        @elseif($term == 'front-end')
                            <span class="label label-success category-label">Front End</span>
                        @else
                            <span class="label label-primary category-label">UI/UX</span>
                        @endif
                         posted by Code My Views</p>
                </div>
            </div>
        </div>
    </section><!-- /page-heading -->
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 wysiwyg">
                    

                    {{ the_content() }}


                    <hr />

                    <h3>Join the Discussion</h3>
                    <div id="disqus_thread"></div>

                    <br />
                    <script type="text/javascript">
                        /* * * CONFIGURATION VARIABLES * * */
                        var disqus_shortname = 'codemyviews';
                        var disqus_identifier = '{{ get_the_ID() }}';
                        var disqus_title = '{{ get_the_title() }}';
                        var disqus_url = "{{ get_permalink() }}";
                        /* * * DON'T EDIT BELOW THIS LINE * * */
                        (function() {
                            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
                </div>
            </div>
  
        </div>
    </section><!-- /main -->
    <section class="more-articles">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <header class="text-center">
                        <h3 class="sub-ttl">More</h3>
                        <h2 class="ttl text-primary">ARTICLES</h2>
                    </header>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="thumbnail thumbnail-item">
                                <a href="/blog/10-tips-for-designing-icons-that-dont-suck"><img src="{{ asset('images/img-41.jpg') }}" alt="images description" ></a>
                                <div class="caption">
                                    <h4><a href="/blog/10-tips-for-designing-icons-that-dont-suck">10 Tips for Designing Icons That Don’t Suck</a></h4>
                                    <p>Almost every designer is thinking about app design these days. One of the smallest features of every app is</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="thumbnail thumbnail-item">
                                <a href="/blog/how-to-center-anything-with-css"><img src="{{ asset('images/img-42.jpg') }}" alt="images description" ></a>
                                <div class="caption">
                                    <h4><a href="/blog/how-to-center-anything-with-css">How To Center Anything With CSS</a></h4>
                                    <p>Recently, we took a dive into the very core concepts behind CSS layout and explored the differences between...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /more-articles -->
    @include('partials/call-to-action')

    @include('partials/contact-info')

@endsection