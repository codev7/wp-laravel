@extends('spark::layouts.spark')

<!-- Main Content -->
@section('content')
<div class="row">
    <div class="col-md-3">
      <div class="panel panel-default panel-profile m-b  m-t-lg">
        <div class="panel-body text-center">
          <a href="javascript:;">
            <img
              class="panel-profile-img"
              src="{{ asset('images/connor-h.png') }}">
          </a>

          <h5 class="panel-title">
            <small>Project Engineer</small><br />
            Dave Gamache
          </h5>

          <p class="m-b-0">Hey, I'm Dave.  I am your project engineer.</p>

        </div>
      </div>

      <div class="panel panel-default panel-profile m-b-md ">
        <div class="panel-body text-center">
          <h5 class="panel-title">
            <small>Developer</small><br />
            John Jiggins
          </h5>

          <p class="m-b-0">I am the coder on your project.</p>

        </div>
      </div>

      <div class="panel panel-default visible-md-block visible-lg-block">
        <div class="panel-body">
          <h5 class="m-t-0">Details <small>· <a href="#">Edit</a></small></h5>

          <table class="table table-condensed table-middle table-striped">
            <tbody>
                <tr>
                    <th rowspan="2"><i class="text-muted fa-2x fa fa-calendar m-r"></i></th>
                    <td><small>Requested Delivery Date</small></td>
                </tr>

                <tr>
                    <td><strong>Next week</strong></td>
                </tr>

                <tr>
                    <th rowspan="2"><i class="text-muted fa-2x fa fa-anchor m-r"></i></th>
                    <td><small>Project Type</small></td>
                </tr>

                <tr>
                    <td><strong>{{ $project->type->name }}</strong></td>
                </tr>

                <tr>
                    <th rowspan="2"><i class="text-muted fa-2x fa fa-git m-r"></i></th>
                    <td><small>Git URL</small></td>
                </tr>

                <tr>
                    <td><input type="text" class="form-control" value="git@bitbucket.org:codemyviews/cmv-web-application.git"/></td>
                </tr>

                <tr>
                    <th rowspan="2"><i class="text-muted fa-2x fa fa-link m-r"></i></th>
                    <td><small>Staging Site</small></td>
                </tr>

                <tr>
                    <td><strong><a href="#">site.approvemyviews.com</a></strong></td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>

       <div class="panel panel-default visible-md-block visible-lg-block">
        <div class="panel-body">
          <h5 class="m-t-0 text-center">File Uploader Dropzone<small></h5>
         
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <ul class="list-group media-list media-list-stream">

        <li class="media list-group-item p-a">
          <div class="form-group">
            <textarea class="form-control" rows="4" placeholder="Message"></textarea>
          </div>

          <a href="#" class="btn btn-block btn-default-outline">Submit Message</a>
        </li>

        <li class="media list-group-item p-a">
          <a class="media-left" href="#">
            <img
              class="media-object img-circle"
              src="{{ asset('images/avatar-dhg.png') }}">
          </a>
          <div class="media-body">
            <div class="media-heading">
              <small class="pull-right text-muted">4 min</small>
              <h5>Dave Gamache</h5>
            </div>

            <p>
              Aenean lacinia bibendum nulla sed consectetur. Vestibulum id ligula porta felis euismod semper. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
            </p>

            <div class="media-body-inline-grid" data-grid="images">
              <div style="display: none">
                <img data-action="zoom" data-width="1050" data-height="700" src="{{ asset('images/unsplash_1.jpg') }}">
              </div>

              <div style="display: none">
                <img data-action="zoom" data-width="640" data-height="640" src="{{ asset('images/instagram_1.jpg') }}">
              </div>

              <div style="display: none">
                <img data-action="zoom" data-width="640" data-height="640" src="{{ asset('images/instagram_13.jpg') }}">
              </div>

              <div style="display: none">
                <img data-action="zoom" data-width="1048" data-height="700" src="{{ asset('images/unsplash_2.jpg') }}">
              </div>
            </div>

            <ul class="media-list m-b">
              <li class="media">
                <a class="media-left" href="#">
                  <img
                    class="media-object img-circle"
                    src="{{ asset('images/avatar-fat.jpg') }}">
                </a>
                <div class="media-body">
                  <strong>Jacon Thornton: </strong>
                  Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis.
                </div>
              </li>
              <li class="media">
                <a class="media-left" href="#">
                  <img
                    class="media-object img-circle"
                    src="{{ asset('images/avatar-mdo.png') }}">
                </a>
                <div class="media-body">
                  <strong>Mark Otto: </strong>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                </div>
              </li>
            </ul>
          </div>
        </li>

        <li class="media list-group-item p-a">
          <a class="media-left" href="#">
            <img
              class="media-object img-circle"
              src="{{ asset('images/avatar-fat.jpg') }}">
          </a>
          <div class="media-body">
            <div class="media-body-text">
              <div class="media-heading">
                <small class="pull-right text-muted">12 min</small>
                <h5>Jacob Thornton</h5>
              </div>
              <p>
                Donec id elit non mi porta gravida at eget metus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
              </p>
            </div>
          </div>
        </li>

        <li class="media list-group-item p-a">
          <a class="media-left" href="#">
            <img
              class="media-object img-circle"
              src="{{ asset('images/avatar-mdo.png') }}">
          </a>
          <div class="media-body">
            <div class="media-heading">
              <small class="pull-right text-muted">34 min</small>
              <h5>Mark Otto</h5>
            </div>

            <p>
              Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
            </p>

            <div class="media-body-inline-grid" data-grid="images">
              <img style="display: none" data-width="640" data-height="640" data-action="zoom" src="{{ asset('images/instagram_3.jpg') }}">
            </div>

            <ul class="media-list">
              <li class="media">
                <a class="media-left" href="#">
                  <img
                    class="media-object img-circle"
                    src="{{ asset('images/avatar-dhg.png') }}">
                </a>
                <div class="media-body">
                  <strong>Dave Gamache: </strong>
                  Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis.
                </div>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-md-3">
      <div class="alert alert-dark alert-dismissible hidden-xs" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Hang tight! We are preparing a project estimate for you.
      </div>

      <div class="panel panel-default m-b-md hidden-xs">
        <div class="panel-body">
          <h5 class="m-t-0">Concierge Service</h5>
            <img class="img-thumbnail" data-width="640" data-height="640" data-action="zoom" src="{{ asset('images/img-10.png') }}">
          <p class="m-t"><strong>Looking for ongoing support?</strong> Check out our VIP Concierge service.</p>
          <a href="{{ route('wp-concierge') }}" class="btn btn-primary-outline btn-sm">Learn More</a>
        </div>
      </div>

      <div class="panel panel-default m-b-md hidden-xs">
        <div class="panel-body">
        <h5 class="m-t-0">Team Members</h5>
        <ul class="media-list media-list-stream">
          <li class="media m-b">
            <a class="media-left" href="#">
              <img
                class="media-object img-circle"
                src="{{ asset('images/avatar-fat.jpg') }}">
            </a>
            <div class="media-body">
              <strong>Jacob Thornton</strong>
              <div class="media-body-actions">
                <button class="btn btn-danger-outline btn-xs">
                  <i class="fa fa-times"></i> REMOVE</button>
              </div>
            </div>
          </li>
           <li class="media">
            <a class="media-left" href="#">
              <img
                class="media-object img-circle"
                src="{{ asset('images/avatar-mdo.png') }}">
            </a>
            <div class="media-body">
              <strong>Mark Otto</strong>
              <div class="media-body-actions">
                <button class="btn btn-danger-outline btn-xs">
                  <i class="fa fa-times"></i> REMOVE</button>
              </div>
            </div>
          </li>
        </ul>
        </div>
        <div class="panel-footer text-center">
          <a href="#"><i class="fa fa-plus"></i></button> Add a Team Member</a>
        </div>
      </div>
    </div>
  </div>

@endsection