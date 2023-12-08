@extends('simple-layout')

@section('body')

    <div class="container small">

        <div class="my-s">
            @include('partials.breadcrumbs', ['crumbs' => [
                '/shelves' => [
                    'text' => trans('Project'),
                    'icon' => 'bookshelf',
                ],
                '/create-shelf' => [
                    'text' => trans('Create New Project'),
                    'icon' => 'add',
                ]
            ]])
        </div>

        <main class="card content-wrap">
            <h1 class="list-heading">{{ trans('Create New Project') }}</h1>
            <form action="{{ url("/shelves") }}" method="POST" enctype="multipart/form-data">
                @include('shelves.form', ['shelf' => null, 'books' => $books])
            </form>
        </main>

    </div>

@stop