 @if(!signedInUser()) 
            <div class="tab">
                @foreach($shelves as $key => $shelf)
                    @include('partials.entity-grid-item', ['entity' => $shelf])
                @endforeach
            </div>
 
           @endif
   
        @endif