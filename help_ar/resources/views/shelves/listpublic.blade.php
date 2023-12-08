
<main>

    <div class="grid half v-center">
        <h1 class="list-heading">{{ trans('المشاريع') }}</h1>
        
        <div class="text-right">
            @include('partials.sort', ['options' => $sortOptions, 'order' => $order, 'sort' => $sort, 'type' => 'bookshelves'])
        </div>
        <br>
        <br>
    </div>
    

    @if(count($shelves) > 0)
        @if($view === 'list')
            <div class="entity-list">
                @foreach($shelves as $index => $shelf)
                    @if ($index !== 0)
                        <hr class="my-m">
                    @endif
                    @include('shelves.list-item', ['shelf' => $shelf])
                @endforeach
            </div>
        @else
          
            <div class="tab">
                @foreach($shelves as $key => $shelf)
           
                    @include('partials.entity-grid-item', ['entity1' => $shelf])
                @endforeach
                
            </div>
  
           @endif
          
           @else
        <p class="text-muted">{{ trans('entities.shelves_empty') }}</p>
        @if(userCan('bookshelf-create-all'))
            <a href="{{ url("/create-shelf") }}" class="button outline">@icon('edit'){{ trans('entities.create_now') }}</a>
        @endif
    @endif
    
 <div class="grid half v-center no-row-gap">
        <h1 class="list-heading">{{ trans('entities.books') }}</h1>
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
        @else
             <div class="grid third">
                @foreach($books as $key => $book)
                    @include('partials.entity-grid-item', ['entity' => $book])
                @endforeach
             </div>
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


<script>

function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the link that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>