               <main class="content-wrap mt-m card">
    <div class="grid half v-center no-row-gap">
        <h1 class="list-heading">{{ trans('قطعة') }}</h1>
        <div class="text-m-right my-m">

            @include('partials.sort', ['options' => [
                'name' => trans('common.sort_name'),
                'created_at' => trans('common.sort_created_at'),
                'updated_at' => trans('common.sort_updated_at'),
            ], 'order' => $order, 'sort' => $sort, 'type' => 'books'])

        </div>
    </div>
    @if(count($books) > 0)
        @if($view === 'list')
            <div class="entity-list">
                @foreach($books as $book)
                    @include('books.list-item', ['book' => $book])
                @endforeach
            </div>
<!--        @else
             <div class="grid third">
                @foreach($books as $key => $book)
                    @include('partials.entity-grid-item', ['entity' => $book])
                @endforeach
             </div>-->
        @endif
      
        <div>
            {!! $books->render() !!}
        </div>
        
        <a href="{{ $book->getUrl() }}" class="book entity-list-item" data-entity-type="book" data-entity-id="{{$book->id}}">
    <div class="entity-list-item-image bg-book" style="background-image: url('{{ $book->getBookCover() }}')">
        @icon('book')
    </div>
    <div class="content">
        <h4 class="entity-list-item-name break-text">{{ $book->name }}</h4>
        <div class="entity-item-snippet">
            <p class="text-muted break-text mb-s">{{ $book->getExcerpt() }}</p>
        </div>
    </div>
</a>
        
        
    @else
        <p class="text-muted">{{ trans('entities.books_empty') }}</p>
        @if(userCan('books-create-all'))
            <a href="{{ url("/create-book") }}" class="text-pos">@icon('edit'){{ trans('entities.create_now') }}</a>
        @endif
    @endif
</main>