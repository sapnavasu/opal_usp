@extends('simple-layout')

@section('body')
    <div class="container small">
        <div class="my-s">
            @if (isset($bookshelf))
                @include('partials.breadcrumbs', ['crumbs' => [
                    $bookshelf,
                    $bookshelf->getUrl('/create-book') => [
                        'text' => trans('Create New Segment'),
                        'icon' => 'add'
                    ]
                ]])
            @else
                @include('partials.breadcrumbs', ['crumbs' => [
                    '/books' => [
                        'text' => trans('Segment'),
                        'icon' => 'book'
                    ],
                    '/create-book' => [
                        'text' => trans('Create Segment'),
                        'icon' => 'add'
                    ]
                ]])
            @endif
        </div>

        <main class="content-wrap card">
            <h1 class="list-heading">{{ trans('Create New Segment') }}</h1>
            <form action="{{ isset($bookshelf) ? $bookshelf->getUrl('/create-book') : url('/books') }}" method="POST" enctype="multipart/form-data">
                @include('books.form', ['returnLocation' => isset($bookshelf) ? $bookshelf->getUrl() : url('/books')])
            </form>
        </main>
    </div>

@stop