@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">

    @include('projects/partials/sidebar')

    <div class="col-md-9" data-controller="project/files">
        <ul class="list-group media-list media-list-stream">

            <li class="media list-group-item p-a">
                <a href="#" class="btn btn-block btn-success btn-lg"><i class="fa fa-upload"></i> Upload More Files</a>
            </li>

            <li class="media list-group-item p-a">
       
                <div class="media-body">
                    <table class="table table-condensed table-middle m-b-0">
                        <thead>
                            <tr>
                                <th>File Name</th>
                                <th>Size</th>
                                <th>Uploaded By</th>
                                <th>Time Uploaded</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>Home Page PSD</td>
                                <td>50mb</td>
                                <td>Connor</td>
                                <td>5 minutes ago</td>
                                <td><a href="#" class="btn btn-primary-outline btn-sm">Download File</a></td>
                                <td><a href="#" class="btn btn-danger-outline btn-xs"><i class="fa fa-times"></i></a></td>
                            </tr>

                            <tr>
                                <td>Home Page PSD</td>
                                <td>50mb</td>
                                <td>Connor</td>
                                <td>5 minutes ago</td>
                                <td><a href="#" class="btn btn-primary-outline btn-sm">Download File</a></td>
                                <td><a href="#" class="btn btn-danger-outline btn-xs"><i class="fa fa-times"></i></a></td>
                            </tr>

                            <tr>
                                <td>Home Page PSD</td>
                                <td>50mb</td>
                                <td>Connor</td>
                                <td>5 minutes ago</td>
                                <td><a href="#" class="btn btn-primary-outline btn-sm">Download File</a></td>
                                <td><a href="#" class="btn btn-danger-outline btn-xs"><i class="fa fa-times"></i></a></td>
                            </tr>

                            <tr>
                                <td>Home Page PSD</td>
                                <td>50mb</td>
                                <td>Connor</td>
                                <td>5 minutes ago</td>
                                <td><a href="#" class="btn btn-primary-outline btn-sm">Download File</a></td>
                                <td><a href="#" class="btn btn-danger-outline btn-xs"><i class="fa fa-times"></i></a></td>
                            </tr>

                            <tr>
                                <td>Home Page PSD</td>
                                <td>50mb</td>
                                <td>Connor</td>
                                <td>5 minutes ago</td>
                                <td><a href="#" class="btn btn-primary-outline btn-sm">Download File</a></td>
                                <td><a href="#" class="btn btn-danger-outline btn-xs"><i class="fa fa-times"></i></a></td>
                            </tr>

                            <tr>
                                <td>Home Page PSD</td>
                                <td>50mb</td>
                                <td>Connor</td>
                                <td>5 minutes ago</td>
                                <td><a href="#" class="btn btn-primary-outline btn-sm">Download File</a></td>
                                <td><a href="#" class="btn btn-danger-outline btn-xs"><i class="fa fa-times"></i></a></td>
                            </tr>

                            <tr>
                                <td>Home Page PSD</td>
                                <td>50mb</td>
                                <td>Connor</td>
                                <td>5 minutes ago</td>
                                <td><a href="#" class="btn btn-primary-outline btn-sm">Download File</a></td>
                                <td><a href="#" class="btn btn-danger-outline btn-xs"><i class="fa fa-times"></i></a></td>
                            </tr>
                        </tbody>
                    </table>

                  
                    </ul>
                </div>
            </li>


         
        </ul>
    </div>
@endsection