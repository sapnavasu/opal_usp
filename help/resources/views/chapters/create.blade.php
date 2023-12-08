@extends('simple-layout')

@section('body')
    <div class="container small">

        <div class="my-s">
            @include('partials.breadcrumbs', ['crumbs' => [
                $book,
                $book->getUrl('create-chapter') => [
                    'text' => trans('Create New Module'),
                    'icon' => 'add',
                ]
            ]])
        </div>

        <main class="content-wrap card">
            <h1 class="list-heading">{{ trans('Create New Module') }}</h1>
            <form action="{{ $book->getUrl('/create-chapter') }}" method="POST">
                @include('chapters.form')
            </form>
        </main>

    </div>
@stop