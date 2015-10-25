@extends('layouts/marketing')
@section('content')
    <header class="page-header page-heading">
        <div class="container">
            <h2 class="sub-ttl">Rules of the road</h2>
            <h1 class="ttl text-success">Legal</h1>
        </div>
    </header><!-- /page-heading -->

    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">

                    <br />

                    <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="tab" href="#nda"><span><i class="fa fa-info-circle"></i> Non-Disclosure Agreement</span></a></li>
                        <li><a  data-toggle="tab" href="#terms"><span><i class="fa fa-star"></i> Terms &amp; Conditions</span></a></li>
                        <li><a  data-toggle="tab" href="#privacy"><span><i class="fa fa-list-alt"></i> Privacy Policy</span></a></li>
                    </ul>

                    <hr />

                    <div class="col-sm-12 tab-content">
                        <section id="nda" class="tab-pane active">
                            
                            <h4>Your Projects are our secret.</h4>

                            <h5>Never under any circumstances are the details of your projects shared with anyone outside the bounds of our company.</h5>

                            <p>Our guarantee to you is that any project you engage with Code My Views Inc. is confidential.  All of our services are 100% white-labeled, so even if you are sub-contracting out a project to us, your customer will not have any insight into this.  We want you to feel comfortable working with us on all of your projects, anything you submit through our site (all projects and quotes) is bound by the non-disclosure agreement that you see below.</p>

                            @include('partials/nda')

                        </section>

                        <section id="terms" class="tab-pane">
                            
                            @include('partials/terms')

                        </section>

                        <section id="privacy" class="tab-pane">
                            
                            @include('partials/privacy')

                        </section>
                    </div>
                </div>
            </div>
        </div><!--container-->
    </section>


    @include('partials/contact-info')
@endsection