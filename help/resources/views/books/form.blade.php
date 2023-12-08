
{{ csrf_field() }}
<div class="form-group title-input">
    <label for="name">{{ trans('common.name') }}</label>
    @include('form.text', ['name' => 'name'])
</div>

<div class="form-group description-input">
    <label for="description">{{ trans('common.description') }}</label>
    @include('form.textarea', ['name' => 'description'])
</div>

<div class="form-group" collapsible id="logo-control">
    <button type="button" class="collapse-title text-primary" collapsible-trigger aria-expanded="false">
        <label>{{ trans('common.cover_image') }}</label>
    </button>
    <div class="collapse-content" collapsible-content>
        <p class="small">{{ trans('common.cover_image_description') }}</p>

        @include('components.image-picker', [
            'defaultImage' => url('/book_default_cover.png'),
            'currentImage' => (isset($model) && $model->cover) ? $model->getBookCover() : url('/book_default_cover.png') ,
            'name' => 'image',
            'imageClass' => 'cover'
        ])
    </div>
</div>

<div class="form-group" collapsible id="tags-control">
    <button type="button" class="collapse-title text-primary" collapsible-trigger aria-expanded="false">
        <label for="tag-manager">{{ trans('Segment Tags') }}</label>
    </button>
    <div class="collapse-content" collapsible-content>
        @include('components.tag-manager', ['entity' => $book ?? null])
    </div>
</div>

<div>
    
    <p>Project Level:</p>
  @if(!empty($book))  
       <input @if($book->booklevel==1) checked="true" @endif
        type="radio" id="single" name="booklevel" value="1" required>
      <label for="single"> Single Level</label><br>
      <input @if($book->booklevel==2) checked="true" @endif
          type="radio" id="multi" name="booklevel" value="2" required>
      <label for="multi"> Multi Level</label><br>
  @else
    <input type="radio" id="single" name="booklevel" value="1" required>
    <label for="single"> Single Level</label><br>
    <input type="radio" id="multi" name="booklevel" value="2" required>
    <label for="multi"> Multi Level</label><br>
  @endif
  
</div>


<div class="form-group text-right">
    <a href="{{ $returnLocation }}" class="button outline">{{ trans('common.cancel') }}</a>
    <button type="submit" class="button">{{ trans('Save Segment') }}</button>
</div>


<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>