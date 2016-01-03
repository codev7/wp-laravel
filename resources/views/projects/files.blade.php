@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">

    

    <div class="col-md-9 col-md-push-3" data-controller="project/files"
         state="{{ json_encode(['reference_type' => 'project', 'reference_id' => $project->id]) }}"
         v-cloak>
        <ul class="list-group media-list media-list-stream">

            @if (!isDev())
            <li class="media list-group-item p-a uploadcare-widget-big">
                <input role="uploadcare-uploader" type="hidden" data-multiple/>
            </li>
            @endif

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

                        <tbody v-if="files.length && filesFetched">
                            <tr v-for="file in files">
                                <td>@{{ file.name }}</td>
                                <td>@{{ file.size | readableSize }}</td>
                                <td>@{{ file.user.name }}</td>
                                <td>@{{ file.created_at | ago }}</td>
                                <td><a :href="file.path" target="_blank" class="btn btn-primary btn-sm">Download File</a></td>
                                <td>
                                    @if (!isDev())
                                    <a href="#" class="btn btn-danger-outline btn-xs"
                                       v-on:click.prevent="deleteFile(file)"><i class="fa fa-times"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>

                        <tbody v-if="!files.length && filesFetched">
                            <tr>
                                <td colspan="6" class="text-center">No files are uploaded yet</td>
                            </tr>
                        </tbody>

                        <tbody v-if="!filesFetched">
                            <tr>
                                <td class="text-center" colspan="6">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </li>

        </ul>
    </div>

    @include('projects/partials/sidebar', ['pull' => 'col-md-pull-9'])
</div>
@endsection