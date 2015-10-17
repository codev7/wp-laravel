@extends('layouts.master')

@section('body')
<body class="blog-detail-page hide-nav">
@endsection

@section('title')
<title>How Jason the Designer Earns 8X More Money with Code My Views</title>
@stop

@section('meta')

<meta name="description" content="Read abour Jason the designer who now bills 5x more by partnering with Code My Views." />
<link rel="canonical" href="{{  route('jason-the-designer')  }}" />

@stop

@section('content')
    <section class="visual2 text-center">
        <div class="container">
            <img class="bg-img" src="{{ asset('images/a-design-image.jpg') }}" alt="" >
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                    <h1>How Jason The Designer went from getting $1K jobs, to getting $8K jobs</h1>
                    <p>
                        <span class="label label-danger category-label">Knowledgebase</span>
                    </p>
                </div>
            </div>
        </div>
    </section><!-- /page-heading -->
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 wysiwyg">
                    

                    <h2>Jason is a designer</h2>

                    <p>Jason was doing $1-2k design gigs.  They'd take him 2-4 weeks each to design.  Basic marketing sites, nothing too crazy.</p> 

                    <p>Often times, Jason's clients would ask him to take care of the coding as well.  Jason could try to work his awesome design into a premade WordPress theme, but it's not that easy, and often times it will end up butchering his amazing design - his true craft.</p>


                    <p>Jason would usually tell his clients that he doesn't like to deal with the coding, and might even include a referral to another developer.</p>


                    <h2>But Jason's client doesn't want to deal with coding either</h2>


                    <p>Then Jason Found Code My Views.</p>

                    
                    <p>He started offering his clients two different packages:</p>

                        
                    <blockquote>
                    <div class="row flat">
                        <div class="col-md-5 col-xs-6 col-md-offset-1">
                            <ul class="plan ">
                                <li class="plan-name">
                                    Design Lite
                                </li>
                                <li class="plan-price">
                                    <strong>$1k-$2k</strong>
                                </li>
                                <li>
                                    <strong>Beautiful designs from start to finish</strong>
                                </li>
                                <li>
                                    <strong class="text-muted">Hand off to client is finished PSDs</strong>
                                </li>
                             </ul>
                         </div>

                        <div class="col-md-5 col-xs-6">
                            <ul class="plan">
                                <li class="plan-name">
                                    Design Full
                                </li>
                                <li class="plan-price">
                                    <strong>$6k-$8k</strong>
                                </li>
                                <li>
                                    <strong>Beautiful designs from start to finish</strong>
                                </li>
                                <li>
                                    <strong>Fully coded, pixel perfect, ready to go live</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </blockquote>

                    <p>This way, Jason never has to scare away clients with high prices.</p>

                    <p>If they want to use his standard price, they could.</p>


                    <hr />

                    <h3>...but what happened was crazy:</h3>


                    <p>50% of Jason's design clients started buying his Design Full package!! </p>

                    <p>But the problem is, Jason doesn't want to deal with coding, and got burned in the past by a "developer" who he contracted the project to.</p>


                    <h3>Code My Views is your trusted (and white-labeled) development resource - right here in the United States.</h3>


                    <p>Jason now sends all of his designs to Code My Views, and can get them converted into a website with projects starting at $1,000.  He then delivers the entire FINISHED package to the clients, and makes a nice margin in the end.</p> 

                    
                    <blockquote>
                        <q>"I don't need to worry about the development side of my designs anymore.  Working with the team at Code My Views has been a great decision and helped me earn more in my consulting business."</q>

                        <cite class="text-muted">- Jason, Top Designs LLC</cite>
                    </blockquote>


                    <h3>So next time, just remember this stupidly simple rule:</h3>





                    <h5>Just Design = $$ </h5>

                    <h5>Design + Coding = $$$$</h5>


                    <h5>You = $$</h5>


                    <h5>you + Code My Views = $$$$$$</h5>

                    <hr />

                    <h3 class="text-center">Let's work together soon!</h3>

                    <p class="text-center">P.S. - you see that green button down there in the right?  Click that to chat with one of our developers right now about your project.</p>
                </div>
            </div>
  
        </div>
    </section><!-- /main -->

    @include('partials/call-to-action')

    @include('partials/contact-info')

@endsection