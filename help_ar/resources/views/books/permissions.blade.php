@extends('simple-layout')

@section('body')

    <div class="container">

        <div class="my-s">
            @include('partials.breadcrumbs', ['crumbs' => [
                $book,
                $book->getUrl('/permissions') => [
                    'text' => trans('أذونات المقطع'),
                    'icon' => 'lock',
                ]
            ]])
        </div>

        <main class="card content-wrap">
            <h1 class="list-heading">{{ trans('أذونات المقطع') }}</h1>
            @include('form.entity-permissions', ['model' => $book])
        </main>
    </div>

@stop
