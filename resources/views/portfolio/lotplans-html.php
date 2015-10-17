@extends(&#x27;layouts.main&#x27;)

@section(&#x27;title_tag&#x27;,&#x27;House Plans | Floor Plans | Architectural Designs - LotPlans&#x27;)

@section(&#x27;custom_meta&#x27;)
&#x3C;meta name=&#x22;description&#x22; content=&#x22;Change the way you buy and build a house with LotPlans House Plans. Buying a house plan at LotPlans is quick, easy, and cost-effective. Best Price Guaranteed.&#x22; /&#x3E;
@stop

@section(&#x27;home_hero&#x27;)
&#x3C;section id=&#x22;home-hero&#x22;&#x3E;
        &#x3C;div class=&#x22;container&#x22;&#x3E;
            &#x3C;div class=&#x22;row&#x22;&#x3E;
                &#x3C;div class=&#x22;col-sm-12&#x22;&#x3E;
                    &#x3C;div class=&#x22;search-box&#x22; id=&#x22;pop-over&#x22;&#x3E;
                        &#x3C;div class=&#x22;search-box-content&#x22;&#x3E;
                            &#x3C;div class=&#x22;row&#x22; id=&#x22;search-box-title&#x22;&#x3E;
                                &#x3C;div class=&#x22;col-sm-2&#x22;&#x3E;
                                    &#x3C;i class=&#x22;fa fa-search&#x22;&#x3E;&#x3C;/i&#x3E;
                                &#x3C;/div&#x3E;

                                &#x3C;div class=&#x22;col-sm-10&#x22;&#x3E;
                                    &#x3C;h1&#x3E;Search For House Plans&#x3C;/h1&#x3E;
                                    &#x3C;p&#x3E;Lot Plans has the best house plans in the industry.&#x3C;/p&#x3E;
                                &#x3C;/div&#x3E;
                            &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;

                            @include(&#x27;partials.real-search&#x27;)
                        &#x3C;/div&#x3E;&#x3C;!--search-box-content--&#x3E;
                        &#x3C;div class=&#x22;bottom&#x22;&#x3E;&#x3C;/div&#x3E;
                    &#x3C;/div&#x3E;&#x3C;!--search-box--&#x3E;
                &#x3C;/div&#x3E;&#x3C;!--col--&#x3E;
            &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;

            &#x3C;h3 id=&#x22;seeplans&#x22;&#x3E;See Plans By Category &#x3C;i class=&#x22;fa fa-chevron-down&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/h3&#x3E;
        &#x3C;/div&#x3E;&#x3C;!--container--&#x3E;
    &#x3C;/section&#x3E;&#x3C;!--home-hero--&#x3E;

@stop

@section(&#x27;content&#x27;)

&#x3C;section id=&#x22;blurred-bg&#x22;&#x3E;
    &#x3C;div class=&#x22;container&#x22;&#x3E;
        &#x3C;div class=&#x22;col-sm-12&#x22;&#x3E;
            &#x3C;h2&#x3E;Search our database of &#x3C;span&#x3E;5,000+&#x3C;/span&#x3E; high end houseplans and home designs...&#x3C;br /&#x3E;&#x3C;strong class=&#x22;text-primary&#x22; style=&#x22;margin-top: 10px; display: block;&#x22;&#x3E;Easy Customization Available!&#x3C;/strong&#x3E;&#x3C;/h2&#x3E;
        &#x3C;/div&#x3E;&#x3C;!--col--&#x3E;
    &#x3C;/div&#x3E;&#x3C;!--container--&#x3E;
&#x3C;/section&#x3E;&#x3C;!--blurred-bg--&#x3E;

&#x3C;section id=&#x22;home-content&#x22;&#x3E;
    &#x3C;div class=&#x22;container&#x22;&#x3E;
        &#x3C;h3 class=&#x22;home-ico&#x22;&#x3E;Featured House Plans&#x3C;/h3&#x3E;

        &#x3C;div class=&#x22;row&#x22;&#x3E;

            @if(isset($plans))

                @foreach($plans as $plan)
                    &#x3C;div class=&#x22;col-sm-4&#x22;&#x3E;
                        @include(&#x27;partials/plan&#x27;,[&#x27;plan&#x27; =&#x3E; $plan])
                    &#x3C;/div&#x3E;&#x3C;!--col--&#x3E;
                @endforeach
            @endif
        &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;

        &#x3C;hr  class=&#x22;dotted&#x22; /&#x3E;

        &#x3C;h4&#x3E;Featured Architectural Styles&#x3C;/h4&#x3E;


        &#x3C;div class=&#x22;row&#x22; id=&#x22;featured-plans&#x22;&#x3E;

            &#x3C;?php $cols = [&#x27;8&#x27;,&#x27;4&#x27;,&#x27;4&#x27;,&#x27;4&#x27;,&#x27;4&#x27;,&#x27;4&#x27;,&#x27;8&#x27;]; $count = 0; ?&#x3E;

            @if($styles)

                @foreach($styles as $style)

                    &#x3C;div class=&#x22;col-sm-{{ $cols[$count] }}&#x22;&#x3E;
                        &#x3C;a href=&#x22;{{ route(&#x27;collections.styles.index&#x27;,[&#x27;slug&#x27; =&#x3E; $style-&#x3E;slug]) }}&#x22;&#x3E;
                            &#x3C;img src=&#x22;{{ $style-&#x3E;thumbnail_url }}&#x22; /&#x3E;
                            &#x3C;h5&#x3E;{{ $style-&#x3E;name }}&#x3C;/h5&#x3E;
                        &#x3C;/a&#x3E;
                    &#x3C;/div&#x3E;&#x3C;!--col--&#x3E;

                    &#x3C;?php $count++; ?&#x3E;
                @endforeach
            @endif          
        &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;

        &#x3C;div class=&#x22;row&#x22;&#x3E;
            &#x3C;div class=&#x22;col-sm-4 col-sm-offset-4 text-center&#x22;&#x3E;
                &#x3C;br /&#x3E;
    
                &#x3C;a href=&#x22;{{ route(&#x27;collections.styles&#x27;) }}&#x22; class=&#x22;btn btn-lg btn-block btn-flat btn-danger&#x22;&#x3E;View All Design Styles&#x3C;/a&#x3E;

            &#x3C;/div&#x3E;&#x3C;!--col--&#x3E;
        &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;

    
        &#x3C;hr  class=&#x22;dotted&#x22; /&#x3E;

        &#x3C;h6&#x3E;What They Say About Us?&#x3C;/h6&#x3E;

        &#x3C;div id=&#x22;testimonial-section&#x22;&#x3E;
            &#x3C;div class=&#x22;text-center&#x22;&#x3E;
                &#x3C;div class=&#x22;btn-group btn-group-lg&#x22; id=&#x22;testimonial-tabber&#x22;&#x3E;
                    &#x3C;a href=&#x22;#testimonial-designers&#x22; data-toggle=&#x22;tab&#x22; class=&#x22;btn btn-lg btn-primary btn-flat&#x22;&#x3E;Designers&#x3C;/a&#x3E;
                    &#x3C;a href=&#x22;#testimonial-customers&#x22; data-toggle=&#x22;tab&#x22; class=&#x22;btn btn-lg btn-default btn-flat&#x22;&#x3E;Customers&#x3C;/a&#x3E;
                &#x3C;/div&#x3E;&#x3C;!--btn-group--&#x3E;
            &#x3C;/div&#x3E;&#x3C;!--text-center--&#x3E;

            &#x3C;br /&#x3E;

            &#x3C;div class=&#x22;tab-content&#x22;&#x3E;
                &#x3C;div class=&#x22;tab-pane active&#x22; id=&#x22;testimonial-designers&#x22;&#x3E;
                    &#x3C;div class=&#x22;row&#x22;&#x3E;

                        @if(isset($testimonials[&#x27;designers&#x27;]))

                            @foreach($testimonials[&#x27;designers&#x27;] as $testimonial)
                            &#x3C;div class=&#x22;testimonial-column col-md-4 col-sm-6&#x22;&#x3E;

                                &#x3C;div class=&#x22;quote&#x22;&#x3E;
                                    &#x3C;i class=&#x22;fa fa-quote-left fa-2x&#x22;&#x3E;&#x3C;/i&#x3E;
                                &#x3C;/div&#x3E;&#x3C;!--quote--&#x3E;

                                &#x3C;p class=&#x22;text&#x22;&#x3E;{{ $testimonial[&#x27;testimonial&#x27;] }}&#x3C;/p&#x3E;

                                &#x3C;div class=&#x22;quote&#x22;&#x3E;
                                    &#x3C;i class=&#x22;fa fa-quote-right fa-2x&#x22;&#x3E;&#x3C;/i&#x3E;
                                &#x3C;/div&#x3E;&#x3C;!--quote--&#x3E;

                                &#x3C;!--&#x3C;img class=&#x22;img-circle&#x22; src=&#x22;{{ $testimonial[&#x27;image_url&#x27;] }}&#x22; alt=&#x22;&#x22; /&#x3E;--&#x3E;

                                &#x3C;p class=&#x22;quote-by&#x22;&#x3E;{{ $testimonial[&#x27;name&#x27;] }}&#x3C;/p&#x3E;
                                &#x3C;p class=&#x22;location&#x22;&#x3E;{{ $testimonial[&#x27;location&#x27;] }}&#x3C;/p&#x3E;
                            &#x3C;/div&#x3E;&#x3C;!--testimonial-column--&#x3E;
                            @endforeach
                        @endif
                    &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;
                &#x3C;/div&#x3E;&#x3C;!--testimonial-designers--&#x3E;

                &#x3C;div class=&#x22;tab-pane&#x22; id=&#x22;testimonial-customers&#x22;&#x3E;
                    &#x3C;div class=&#x22;row&#x22;&#x3E;

                        @if(isset($testimonials[&#x27;customers&#x27;]))

                            @foreach($testimonials[&#x27;customers&#x27;] as $testimonial)
                            &#x3C;div class=&#x22;testimonial-column col-md-3 col-sm-6&#x22;&#x3E;

                                &#x3C;div class=&#x22;quote&#x22;&#x3E;
                                    &#x3C;i class=&#x22;fa fa-quote-left fa-2x&#x22;&#x3E;&#x3C;/i&#x3E;
                                &#x3C;/div&#x3E;&#x3C;!--quote--&#x3E;

                                &#x3C;p class=&#x22;text&#x22;&#x3E;{{ $testimonial[&#x27;testimonial&#x27;] }}&#x3C;/p&#x3E;

                                &#x3C;div class=&#x22;quote&#x22;&#x3E;
                                    &#x3C;i class=&#x22;fa fa-quote-right fa-2x&#x22;&#x3E;&#x3C;/i&#x3E;
                                &#x3C;/div&#x3E;&#x3C;!--quote--&#x3E;

                                &#x3C;!--&#x3C;img class=&#x22;img-circle&#x22; src=&#x22;{{ $testimonial[&#x27;image_url&#x27;] }}&#x22; alt=&#x22;&#x22; /&#x3E;--&#x3E;

                                &#x3C;p class=&#x22;quote-by&#x22;&#x3E;{{ $testimonial[&#x27;name&#x27;] }}&#x3C;/p&#x3E;
                                &#x3C;p class=&#x22;location&#x22;&#x3E;{{ $testimonial[&#x27;location&#x27;] }}&#x3C;/p&#x3E;
                            &#x3C;/div&#x3E;&#x3C;!--testimonial-column--&#x3E;
                            @endforeach
                        @endif
                    &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;
                &#x3C;/div&#x3E;&#x3C;!--testimonial-customers--&#x3E;
            &#x3C;/div&#x3E;&#x3C;!--tab-content--&#x3E;
        &#x3C;/div&#x3E;&#x3C;!--testimonial-section--&#x3E;
        
        &#x3C;hr  class=&#x22;dotted&#x22; /&#x3E;

        &#x3C;h6&#x3E;Why Lotplans?&#x3C;/h6&#x3E;

        &#x3C;div class=&#x22;row&#x22; id=&#x22;why-lotplans-section&#x22;&#x3E;
            @if(isset($why))
                @foreach($why as $col)
                    &#x3C;div class=&#x22;col-md-15 col-sm-6 text-center&#x22;&#x3E;
                        &#x3C;div class=&#x22;icon&#x22;&#x3E;
                            &#x3C;i class=&#x22;fa fa-{{ $col[&#x27;icon_path&#x27;] }} fa-2x&#x22;&#x3E;&#x3C;/i&#x3E;
                        &#x3C;/div&#x3E;&#x3C;!--icon--&#x3E;

                        &#x3C;p class=&#x22;title&#x22;&#x3E;{{ $col[&#x27;title&#x27;] }}&#x3C;/p&#x3E;
                        &#x3C;p class=&#x22;description&#x22;&#x3E;{{ $col[&#x27;description&#x27;] }}&#x3C;/p&#x3E;
                    &#x3C;/div&#x3E;&#x3C;!--col--&#x3E;
                @endforeach
            @endif
        &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;
    &#x3C;/div&#x3E;&#x3C;!--container--&#x3E;
&#x3C;/section&#x3E;&#x3C;!--content--&#x3E;
@stop