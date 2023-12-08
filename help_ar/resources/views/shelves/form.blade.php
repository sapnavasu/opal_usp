{{ csrf_field() }}

<div class="form-group title-input">
    <label for="name">{{ trans('common.name') }}</label>
    @include('form.text', ['name' => 'name'])
</div>

<div class="form-group description-input">
    <label for="description">{{ trans('common.description') }}</label>
    @include('form.textarea', ['name' => 'description'])
</div>

<div shelf-sort class="grid half gap-xl">
    <div class="form-group">
        <label for="books">{{ trans('الجزء على هذا المشروع') }}</label>
        <input type="hidden" id="books-input" name="books"
               value="{{ isset($shelf) ? $shelf->visibleBooks->implode('id', ',') : '' }}">
        <div class="scroll-box" shelf-sort-assigned-books data-instruction="{{ trans('اسحب الأجزاء هنا لإضافتها إلىهذا المشروع') }}">
            @if (count($shelf->visibleBooks ?? []) > 0)
                @foreach ($shelf->visibleBooks as $book)
                    <div data-id="{{ $book->id }}" class="scroll-box-item">
                        <a href="{{ $book->getUrl() }}" class="text-book">@icon('book'){{ $book->name }}</a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="books">{{ trans('أضف شريحة في هذا المشروع') }}</label>
        <div class="scroll-box">
            @foreach ($books as $book)
                <div data-id="{{ $book->id }}" class="scroll-box-item">
                    <a href="{{ $book->getUrl() }}" class="text-book">@icon('book'){{ $book->name }}</a>
                </div>
            @endforeach
        </div>
    </div>
</div>



<div class="form-group" collapsible id="logo-control">
    <button type="button" class="collapse-title text-primary" collapsible-trigger aria-expanded="false">
        <label>{{ trans('common.cover_image') }}</label>
    </button>
    <div class="collapse-content" collapsible-content>
        <p class="small">{{ trans('common.cover_image_description') }}</p>

        @include('components.image-picker', [
            'defaultImage' => url('/book_default_cover.png'),
            'currentImage' => (isset($shelf) && $shelf->cover) ? $shelf->getBookCover() : url('/book_default_cover.png') ,
            'name' => 'image',
            'imageClass' => 'cover'
        ])
    </div>
</div>

<div class="form-group" collapsible id="tags-control">
    <button type="button" class="collapse-title text-primary" collapsible-trigger aria-expanded="false">
        <label for="tag-manager">{{ trans('علامات المشروع') }}</label>
    </button>
    <div class="collapse-content" collapsible-content>
        @include('components.tag-manager', ['entity' => $shelf ?? null])
    </div>
</div>

<div>
    
<div>
    
    <p>مستوى المشروع:</p>
  @if(!empty($shelf))  
       <input @if($shelf->column_level==1) checked="true" @endif
        type="radio" id="single" name="column_level" value="1" required>
      <label for="single"> مستوى واحد</label><br>
      <input @if($shelf->column_level==2) checked="true" @endif
          type="radio" id="multi" name="column_level" value="2" required>
      <label for="multi"> متعدد المستويات</label><br>
  @else
    <input type="radio" id="single" name="column_level" value="1" required>
    <label for="single"> مستوى واحد</label><br>
    <input type="radio" id="multi" name="column_level" value="2" required>
    <label for="multi"> متعدد المستويات</label><br>
  @endif
  
</div>
    
       <div>  
        <p>Classification:</p>
          @if(!empty($shelf))  
       <input @if($shelf->classification==1) checked="true" @endif
        type="radio" id="reg" name="classification" value="1" required>
      <label for="reg"> Non-Registration</label><br>
      <input @if($shelf->classification==2) checked="true" @endif
          type="radio" id="non_reg" name="classification" value="2" required>
      <label for="non_reg">Registration</label><br>
  @else
    <input type="radio" id="reg" name="classification" value="1" required>
    <label for="reg"> Non-Registration</label><br>
    <input type="radio" id="non_reg" name="classification" value="2" required>
    <label for="non_reg"> Registration</label><br>
  @endif
    </div>

<div class="form-group text-right">
    <a href="{{ isset($shelf) ? $shelf->getUrl() : url('/shelves') }}" class="button outline">{{ trans('common.cancel') }}</a>
    <button type="submit" class="button">{{ trans('احفظ المشروع') }}</button>
</div>



<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>


<!--if ($(':checkbox').is(':checked')){
    $(':checkbox').prop('checked', true).attr('checked', 'checked');
}
else {
    $(':checkbox').prop('checked', false).removeAttr('checked');
}-->