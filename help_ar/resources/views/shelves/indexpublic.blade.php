@extends('tri-layout')

@if(!signedInUser())
@section('body')
    @include('shelves.public', ['shelves' => $shelves, 'view' => $view])
@stop
@endif

@section('right')
@if(!signedInUser())
    <div class="actions mb-xl">
        <h5>{{ trans('common.actions') }}</h5>
        <div class="icon-list text-primary">
            @if($currentUser->can('bookshelf-create-all'))
                <a href="{{ url("/create-shelf") }}" class="icon-list-item">
                    <span>@icon('add')</span>
                    <span>{{ trans('New Project') }}</span>
                </a>
            @endif
            @include('partials.view-toggle', ['view' => $view, 'type' => 'shelves'])
        </div>
    </div>
 @endif
@stop

@section('left')


@if(signedInUser())
    @if($recents)
        <div id="recents" class="mb-xl">
            <h5>{{ trans('entities.recently_viewed') }}</h5>
            @include('partials.entity-list', ['entities' => $recents, 'style' => 'compact'])
        </div>
    @endif

    <div id="popular" class="mb-xl">
        <h5>{{ trans('Popular Projects') }}</h5>
        @if(count($popular) > 0)
            @include('partials.entity-list', ['entities' => $popular, 'style' => 'compact'])
        @else
            <div class="text-muted">{{ trans('entities.shelves_popular_empty') }}</div>
        @endif
    </div>

    <div id="new" class="mb-xl">
        <h5>{{ trans('New Projects') }}</h5>
        @if(count($new) > 0)
            @include('partials.entity-list', ['entities' => $new, 'style' => 'compact'])
        @else
            <div class="text-muted">{{ trans('entities.shelves_new_empty') }}</div>
        @endif
    </div>
     @endif
@stop