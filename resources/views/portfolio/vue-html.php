@extends(&#x27;layouts.master&#x27;)


@section(&#x27;content&#x27;)
&#x3C;section id=&#x22;our-code&#x22; class=&#x22;inner-content&#x22;&#x3E;
    &#x3C;div class=&#x22;container&#x22;&#x3E;
        &#x3C;div class=&#x22;row&#x22;&#x3E;
            &#x3C;div class=&#x22;col-sm-6&#x22;&#x3E;
                &#x3C;h1&#x3E;{{ $h1_title }}&#x3C;/h1&#x3E;

                &#x3C;hr /&#x3E;
            &#x3C;/div&#x3E;&#x3C;!--col--&#x3E;

            &#x3C;div class=&#x22;col-sm-6&#x22;&#x3E;
                &#x3C;p&#x3E;Since most of our projects are bound by our &#x3C;a target=&#x22;_blank&#x22; href=&#x22;{{ route(&#x27;legal&#x27;) }}&#x22;&#x3E;non-disclosure agreement&#x3C;/a&#x3E;, we are only to show a small fraction of the projects we have actually worked on.  We&#x27;ve tried to snapshot some of the latest and greatest below.  Code samples included for each.&#x3C;/p&#x3E;
            &#x3C;/div&#x3E;&#x3C;!--col--&#x3E;
        &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;
    &#x3C;/div&#x3E;&#x3C;!--container--&#x3E;
&#x3C;/section&#x3E;&#x3C;!--our-code--&#x3E;

&#x3C;div id=&#x22;portfolio-items&#x22;&#x3E;
    &#x3C;div id=&#x22;single-portfolio-item&#x22;&#x3E;

        &#x3C;div
            class=&#x22;container&#x22;
            v-if=&#x22;!loaded&#x22;&#x3E;
            &#x3C;div class=&#x22;col-sm-6 col-sm-offset-3&#x22;&#x3E;
                &#x3C;div class=&#x22;well well-small text-center&#x22; id=&#x22;portfolio-loader&#x22;&#x3E;
                    &#x3C;h2&#x3E;Loading Portfolio...&#x3C;br /&#x3E;&#x3C;i class=&#x22;fa fa-spin fa-spinner&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/h2&#x3E;
                &#x3C;/div&#x3E;
            &#x3C;/div&#x3E;
        &#x3C;/div&#x3E;&#x3C;!--container--&#x3E;
        
        &#x3C;div v-repeat=&#x22;portfolioItems&#x22;&#x3E;
            &#x3C;div class=&#x22;portfolio-item&#x22;&#x3E;
                
                    &#x3C;img
                    v-attr=&#x22;src:image&#x22; alt=&#x22;Portfolio Item @{{ name }} Screenshot&#x22; title=&#x22;Portfolio Item @{{ name }} Screenshot&#x22; /&#x3E;

               
                    &#x3C;div class=&#x22;hover-section&#x22;&#x3E;
                        &#x3C;h3&#x3E;@{{ name }}&#x3C;/h3&#x3E;
                        &#x3C;p&#x3E;@{{ type }}&#x3C;/p&#x3E;

                        &#x3C;a v-on=&#x22;click: openCodeModal(name)&#x22; class=&#x22;btn btn-success&#x22;&#x3E;View Code&#x3C;/a&#x3E;
                    &#x3C;/div&#x3E;&#x3C;!--hover-section--&#x3E;
                    &#x3C;div class=&#x22;trans-bg&#x22;&#x3E;&#x3C;/div&#x3E;
            &#x3C;/div&#x3E;&#x3C;!--portfolio-item--&#x3E;
            &#x3C;div class=&#x22;portfolio-item&#x22;&#x3E;
                &#x3C;img
                style=&#x22;visibility: hidden&#x22;
                v-if=&#x22;!show_empty&#x22;
                src=&#x22;{{ asset(&#x27;images/grid.png&#x27;) }}&#x22; alt=&#x22;Filler Image&#x22; title=&#x22;Filler Image&#x22; /&#x3E;
                &#x3C;img
                v-if=&#x22;show_empty&#x22;
                src=&#x22;{{ asset(&#x27;images/grid.png&#x27;) }}&#x22; alt=&#x22;Filler Image&#x22; title=&#x22;Filler Image&#x22; /&#x3E;
            &#x3C;/div&#x3E;&#x3C;!--portfolio-item--&#x3E;
        &#x3C;/div&#x3E;&#x3C;!--v-repeat--&#x3E;
    &#x3C;/div&#x3E;&#x3C;!--portfolio-item--&#x3E;
    &#x3C;div class=&#x22;modal fade&#x22; id=&#x22;modal-portfolio&#x22;&#x3E;
      &#x3C;div class=&#x22;modal-dialog modal-lg&#x22;&#x3E;
        &#x3C;div class=&#x22;modal-content&#x22;&#x3E;
          &#x3C;div class=&#x22;modal-header&#x22;&#x3E;
            &#x3C;button type=&#x22;button&#x22; class=&#x22;close&#x22; data-dismiss=&#x22;modal&#x22; aria-label=&#x22;Close&#x22;&#x3E;&#x3C;i class=&#x22;fa fa-times&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/button&#x3E;
            &#x3C;h4 class=&#x22;modal-title&#x22;&#x3E;@{{ modal.name }} Project&#x3C;/h4&#x3E;
          &#x3C;/div&#x3E;
          &#x3C;div class=&#x22;modal-body&#x22;&#x3E;

            &#x3C;div class=&#x22;text-center&#x22;&#x3E;

                &#x3C;div class=&#x22;row&#x22;&#x3E;
                    &#x3C;div class=&#x22;col-sm-10 col-sm-offset-1&#x22;&#x3E;

                        &#x3C;h4&#x3E;@{{ modal.description }}&#x3C;/h4&#x3E;

                    &#x3C;/div&#x3E;&#x3C;!--col--&#x3E;
                &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;
                
                &#x3C;br /&#x3E;

                &#x3C;div class=&#x22;btn-group btn-group-lg&#x22;&#x3E;
                    &#x3C;a
                    v-repeat=&#x22;modal.tabs&#x22;
                    href=&#x22;#@{{ id }}&#x22;
                    data-toggle=&#x22;tab&#x22;
                    class=&#x22;btn btn-lg btn-primary&#x22;&#x3E;
                        @{{ text }} &#x3C;i class=&#x22;fa fa-@{{ icon }}&#x22;&#x3E;&#x3C;/i&#x3E;
                    &#x3C;/a&#x3E;
                
                    &#x3C;a v-attr=&#x22;href: modal.preview_link&#x22; target=&#x22;_blank&#x22; rel=&#x22;nofollow&#x22; class=&#x22;btn btn-lg btn-primary&#x22;&#x3E;View Site &#x3C;i class=&#x22;fa fa-search&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/a&#x3E;
                &#x3C;/div&#x3E;&#x3C;!--btn-group--&#x3E;
            &#x3C;/div&#x3E;&#x3C;!--text-center--&#x3E;

            &#x3C;br /&#x3E;

            &#x3C;div class=&#x22;code-block&#x22;&#x3E;
                &#x3C;div class=&#x22;tab-content&#x22;&#x3E;
                    &#x3C;div
                        v-repeat=&#x22;modal.tabs&#x22;
                        class=&#x22;tab-pane&#x22;
                        id=&#x22;@{{ id }}&#x22;&#x3E;
                        &#x3C;pre&#x3E;&#x3C;code class=&#x22;@{{ code_type }}&#x22; v-html=&#x22;content&#x22;&#x3E;&#x3C;/code&#x3E;&#x3C;/pre&#x3E;
                    &#x3C;/div&#x3E;&#x3C;!--tab-pane--&#x3E;
                &#x3C;/div&#x3E;&#x3C;!--tab-content--&#x3E;
            &#x3C;/div&#x3E;&#x3C;!--code-block--&#x3E;
          &#x3C;/div&#x3E;
        &#x3C;/div&#x3E;&#x3C;!-- /.modal-content --&#x3E;
      &#x3C;/div&#x3E;&#x3C;!-- /.modal-dialog --&#x3E;
    &#x3C;/div&#x3E;&#x3C;!-- /.modal --&#x3E;
&#x3C;/div&#x3E;&#x3C;!--portfolio-items--&#x3E;
@stop