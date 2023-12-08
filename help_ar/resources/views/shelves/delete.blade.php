@extends('simple-layout')

@section('body')

    <div class="container small">

        <div class="my-s">
            @include('partials.breadcrumbs', ['crumbs' => [
                $shelf,
                $shelf->getUrl('/delete') => [
                    'text' => trans('حذف المشروع'),
                    'icon' => 'delete',
                ]
            ]])
        </div>

        <div class="card content-wrap auto-height">
            <h1 class="list-heading">{{ trans('حذف المشروع') }}</h1>
            <p>{{ trans('entities.shelves_delete_explain', ['name' => $shelf->name]) }}</p>

            <div class="grid half">
                <p class="text-neg">
                    <strong>{{ trans('هل أنت متأكد أنك تريد حذف هذا المشروع؟') }}</strong>
                </p>

                <form action="{{ $shelf->getUrl() }}" method="POST" class="text-right">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">

                    <a href="{{ $shelf->getUrl() }}" class="button outline">{{ trans('common.cancel') }}</a>
                    <button type="submit" class="button">{{ trans('common.confirm') }}</button>
                </form>
            </div>


        </div>
    </div>

@stop