@extends('simple-layout')

@section('body')

    <div class="container small">

        <div class="my-s">
            @include('partials.breadcrumbs', ['crumbs' => [
                $book,
                $book->getUrl('/edit') => [
                    'text' => trans('Edit Segment'),
                    'icon' => 'edit',
                ]
            ]])
        </div>

        <main class="content-wrap card">
            <h1 class="list-heading">{{ trans('Edit Segment') }}</h1>
            <form action="{{ $book->getUrl() }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                @include('books.form', ['model' => $book, 'returnLocation' => $book->getUrl()])
            </form>
        </main>
    </div>
@stop