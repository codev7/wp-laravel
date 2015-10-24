&#x3C;?php 

/* Template Name: Home Page */

get_header(); ?&#x3E;        
&#x3C;div id=&#x22;teaser&#x22;&#x3E;
    &#x3C;div class=&#x22;overlay&#x22;&#x3E;
        &#x3C;div class=&#x22;container&#x22;&#x3E;
            &#x3C;div class=&#x22;row&#x22;&#x3E;
                &#x3C;div class=&#x22;col-sm-12&#x22;&#x3E;
                    &#x3C;h1&#x3E;&#x3C;?php the_field(&#x27;h1_title&#x27;); ?&#x3E;&#x3C;/h1&#x3E;
                    &#x3C;h2&#x3E;&#x3C;?php the_field(&#x27;subittle&#x27;); ?&#x3E;&#x3C;/h2&#x3E;

                    &#x3C;br /&#x3E;
                    &#x3C;br /&#x3E;

                    &#x3C;div class=&#x22;row&#x22;&#x3E;
                        &#x3C;div class=&#x22;col-sm-6 col-sm-offset-3&#x22;&#x3E;
                            &#x3C;form action=&#x22;&#x3C;?php echo get_page_link(9); ?&#x3E;&#x22; method=&#x22;post&#x22; class=&#x22;form-inline&#x22; id=&#x22;zip-top&#x22;&#x3E;
                                &#x3C;div class=&#x22;input-group input-group-lg&#x22;&#x3E;
                                    &#x3C;input type=&#x22;text&#x22; placeholder=&#x22;Enter Your Zip Code&#x22; id=&#x22;home-zip&#x22; name=&#x22;zip&#x22; class=&#x22;form-control required&#x22;&#x3E;
                                        &#x3C;span class=&#x22;input-group-btn&#x22;&#x3E;
                                            &#x3C;button class=&#x22;btn btn-danger&#x22; style=&#x22;width: 230px&#x22; type=&#x22;submit&#x22;&#x3E;Check Availability&#x3C;/button&#x3E;
                                        &#x3C;/span&#x3E;
                                    &#x3C;/div&#x3E;&#x3C;!-- /input-group --&#x3E;
                            &#x3C;/form&#x3E;
                        &#x3C;/div&#x3E;&#x3C;!--col--&#x3E;
                    &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;
                &#x3C;/div&#x3E;&#x3C;!--col-sm-12--&#x3E;
            &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;
        &#x3C;/div&#x3E;&#x3C;!--container--&#x3E;
    &#x3C;/div&#x3E;&#x3C;!--overlay--&#x3E;
&#x3C;/div&#x3E;&#x3C;!--teaser--&#x3E;

&#x3C;section id=&#x22;how-it-works&#x22; class=&#x22;section&#x22;&#x3E;
    &#x3C;div class=&#x22;container&#x22;&#x3E;
        &#x3C;div class=&#x22;intro&#x22;&#x3E;
            &#x3C;h3&#x3E;&#x3C;?php the_field(&#x27;third_headline&#x27;); ?&#x3E;&#x3C;/h3&#x3E;
        &#x3C;/div&#x3E;
        &#x3C;div class=&#x22;row&#x22;&#x3E;
            &#x3C;div class=&#x22;how-col&#x22;&#x3E;
                &#x3C;div class=&#x22;ico &#x22;&#x3E;&#x3C;i class=&#x22;fa fa-calendar&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/div&#x3E;
                &#x3C;div class=&#x22;desc &#x22;&#x3E;
                    &#x3C;h4&#x3E;&#x3C;?php the_field(&#x27;column_1_title&#x27;); ?&#x3E;&#x3C;/h4&#x3E;
                    &#x3C;p&#x3E;&#x3C;?php the_field(&#x27;column_1_content&#x27;); ?&#x3E;&#x3C;/p&#x3E;
                &#x3C;/div&#x3E;
            &#x3C;/div&#x3E;&#x3C;!--col--&#x3E;

            &#x3C;div class=&#x22;how-col&#x22;&#x3E;
                &#x3C;div class=&#x22;ico &#x22;&#x3E;&#x3C;i class=&#x22;fa fa-repeat&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/div&#x3E;
                &#x3C;div class=&#x22;desc&#x22;&#x3E;
                    &#x3C;h4&#x3E;&#x3C;?php the_field(&#x27;column_2_title&#x27;); ?&#x3E;&#x3C;/h4&#x3E;
                    &#x3C;p&#x3E;&#x3C;?php the_field(&#x27;column_2_content&#x27;); ?&#x3E;&#x3C;/p&#x3E;
                &#x3C;/div&#x3E;
            &#x3C;/div&#x3E;&#x3C;!--col--&#x3E;

            &#x3C;div class=&#x22;how-col&#x22;&#x3E;
                &#x3C;div class=&#x22;ico  &#x22;&#x3E;&#x3C;i class=&#x22;fa fa-star&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/div&#x3E;
                &#x3C;div class=&#x22;desc &#x22;&#x3E;
                    &#x3C;h4&#x3E;&#x3C;?php the_field(&#x27;column_3_title&#x27;); ?&#x3E;&#x3C;/h4&#x3E;
                    &#x3C;p&#x3E;&#x3C;?php the_field(&#x27;column_3_content&#x27;); ?&#x3E;&#x3C;/p&#x3E;
                &#x3C;/div&#x3E;
            &#x3C;/div&#x3E;
        &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;            

        &#x3C;hr /&#x3E;

        &#x3C;div class=&#x22;intro&#x22;&#x3E;
            &#x3C;h3&#x3E;&#x3C;?php the_field(&#x27;fourth_headline&#x27;); ?&#x3E;&#x3C;/h3&#x3E;
        &#x3C;/div&#x3E;&#x3C;!--intro--&#x3E;

        &#x3C;div class=&#x22;row&#x22;&#x3E;
            &#x3C;div class=&#x22;col-sm-7&#x22;&#x3E;
                &#x3C;div class=&#x22;innerIntro&#x22;&#x3E;
                    &#x3C;h4&#x3E;The best detailing starts with the best products and labor.&#x3C;/h4&#x3E;

                    &#x3C;p&#x3E;Have you noticed how other Austin, TX mobile auto detailers lack, well, attention to detail? Our uncompromising service is based on using the best products and labor to achieve a higher quality detailing on time, every time no matter your location. Just enter your zip code at the top or bottom of this page to schedule your next detailing.&#x3C;/p&#x3E;
                &#x3C;/div&#x3E;

                &#x3C;div class=&#x22;row&#x22;&#x3E;
                    &#x3C;div class=&#x22;ico-row&#x22;&#x3E;
                        &#x3C;div class=&#x22;ico&#x22;&#x3E;&#x3C;i class=&#x22;fa fa-smile-o&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/div&#x3E;
                        &#x3C;div class=&#x22;details&#x22;&#x3E;
                            &#x3C;h5&#x3E;&#x3C;?php the_field(&#x27;bottom_col_1_headline&#x27;); ?&#x3E;&#x3C;/h5&#x3E;
                            &#x3C;p&#x3E;&#x3C;?php the_field(&#x27;bottom_col_1_text&#x27;); ?&#x3E;&#x3C;/p&#x3E;
                        &#x3C;/div&#x3E;
                    &#x3C;/div&#x3E;&#x3C;!--ico-row--&#x3E;

                    &#x3C;div class=&#x22;ico-row&#x22;&#x3E;
                        &#x3C;div class=&#x22;ico&#x22;&#x3E;&#x3C;i class=&#x22;fa fa-asterisk&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/div&#x3E;
                        &#x3C;div class=&#x22;details&#x22;&#x3E;
                            &#x3C;h5&#x3E;&#x3C;?php the_field(&#x27;bottom_col_2_headline&#x27;); ?&#x3E;&#x3C;/h5&#x3E;
                            &#x3C;p&#x3E;&#x3C;?php the_field(&#x27;bottom_col_2_text&#x27;); ?&#x3E;&#x3C;/p&#x3E;
                        &#x3C;/div&#x3E;
                    &#x3C;/div&#x3E;&#x3C;!--ico-row--&#x3E;
                &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;

                &#x3C;div class=&#x22;row&#x22;&#x3E;
                    &#x3C;div class=&#x22;ico-row&#x22;&#x3E;
                        &#x3C;div class=&#x22;ico&#x22;&#x3E;&#x3C;i class=&#x22;fa fa-clock-o&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/div&#x3E;
                        &#x3C;div class=&#x22;details&#x22;&#x3E;
                            &#x3C;h5&#x3E;&#x3C;?php the_field(&#x27;bottom_col_3_headline&#x27;); ?&#x3E;&#x3C;/h5&#x3E;
                            &#x3C;p&#x3E;&#x3C;?php the_field(&#x27;bottom_col_3_text&#x27;); ?&#x3E;&#x3C;/p&#x3E;
                        &#x3C;/div&#x3E;
                    &#x3C;/div&#x3E;&#x3C;!--ico-row--&#x3E;

                    &#x3C;div class=&#x22;ico-row&#x22;&#x3E;
                        &#x3C;div class=&#x22;ico&#x22;&#x3E;&#x3C;i class=&#x22;fa fa-usd&#x22;&#x3E;&#x3C;/i&#x3E;&#x3C;/div&#x3E;
                        &#x3C;div class=&#x22;details&#x22;&#x3E;
                            &#x3C;h5&#x3E;&#x3C;?php the_field(&#x27;bottom_col_4_headline&#x27;); ?&#x3E;&#x3C;/h5&#x3E;
                            &#x3C;p&#x3E;&#x3C;?php the_field(&#x27;bottom_col_4_text&#x27;); ?&#x3E;&#x3C;/p&#x3E;
                        &#x3C;/div&#x3E;
                    &#x3C;/div&#x3E;&#x3C;!--ico-row--&#x3E;
                &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;
            &#x3C;/div&#x3E;&#x3C;!--col--&#x3E;
            &#x3C;hr class=&#x22;visible-xs&#x22;/&#x3E;
            &#x3C;div class=&#x22;col-sm-5&#x22;&#x3E;
                &#x3C;img src=&#x22;&#x3C;?php echo get_bloginfo(&#x27;template_directory&#x27;).&#x27;/&#x27;; ?&#x3E;images/mini.jpg&#x22; class=&#x22;mini img-thumbnail&#x22; alt=&#x22;Clean MINI Cooper&#x22; /&#x3E;
            &#x3C;/div&#x3E;
        &#x3C;/div&#x3E;&#x3C;!--row--&#x3E;

        &#x3C;div class=&#x22;intro&#x22;&#x3E;
            &#x3C;h3&#x3E;&#x3C;?php the_field(&#x27;current_customers_headline&#x27;); ?&#x3E;&#x3C;/h3&#x3E;
        &#x3C;/div&#x3E;&#x3C;!--intro--&#x3E;
    &#x3C;/div&#x3E;&#x3C;!--container--&#x3E;

    &#x3C;div class=&#x22;fluid-row&#x22;&#x3E;
        &#x3C;ul id=&#x22;car-gallery&#x22;&#x3E;
            &#x3C;?php
                $randarray = array(13,8,22,32); 
                $count = 0; while($count &#x3C; 10):

                $rand = rand(1,34);

                

                if(in_array($rand,$randarray)) {
                    continue;
                } else {
                    $randarray[] = $rand;   
                }
                

            ?&#x3E;
            &#x3C;li&#x3E;&#x3C;img src=&#x22;&#x3C;?php echo get_bloginfo(&#x27;template_directory&#x27;).&#x27;/&#x27;; ?&#x3E;images/customers/customer&#x3C;?php echo $rand; ?&#x3E;.jpg&#x22; alt=&#x22;&#x22; /&#x3E;&#x3C;/li&#x3E;
            &#x3C;?php $count++; endwhile; ?&#x3E;
        &#x3C;/ul&#x3E;
    &#x3C;/div&#x3E;&#x3C;!--fluid-row--&#x3E;
&#x3C;/section&#x3E;&#x3C;!--how-it-works--&#x3E;

&#x3C;?php get_template_part(&#x27;call-to-action&#x27;); ?&#x3E;
&#x3C;?php get_footer(); ?&#x3E;