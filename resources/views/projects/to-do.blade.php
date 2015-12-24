@extends('spark::layouts.spark')

@section('content')
    <div class="row">

        @include('projects/partials/sidebar')

        <div class="col-md-9" data-controller="project/todo" v-cloak state="{{ json_encode(['todo' => $todo->toArray() ]) }}">

            {{ var_dump($todo->toArray()) }}

        </div>

@endsection