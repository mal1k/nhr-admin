@extends ('layout')

@section('title', isset($category) ?  'Update '.$category->title : 'Create category')

@section('content')
<div class="my-3">
  <a class="text-decoration-none text-dark" href="{{ route('blog-categories.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top: -3px;margin-right: -3px;"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
    Back
  </a>
</div>

<form method="POST" enctype="multipart/form-data"
    @if ( isset($category) )
        action="{{ route('blog-categories.update', $category) }}"
    @else
        action="{{ route('blog-categories.store') }}"
    @endif
    class="row row-cols-lg-auto g-3 align-items-center">
    @csrf
    @isset($category)
        @method('PUT')
    @endisset

<div class="row">

  <div class="col-8">

    <div class="mb-2 col-12">
        <label for="title" class="form-label mt-2 mb-1">Title</label>
        <input name="title" type="text" class="form-control" id="title" value="{{ old('title', isset( $category->title ) ? $category->title : '') }}">
        @error('title')
            <div class="alert alert-danger mb-0">{{ $message }}</div>
        @enderror
    </div>

    <label for="categories" class="form-label mt-2 mb-1">Keywords for the search</label>
    <div class="col-12 form-control multi-search-filter" onclick="Array.from(this.children).find(n=>n.tagName==='INPUT').focus()">
        @isset ($category->categories)
        @php
            if ( is_array($category->categories) ) {
                $basic_categories = $category->categories;
            } else {
                $basic_categories = json_decode($category->categories);
            }
        @endphp
        @endisset

        @isset($basic_categories)
            @foreach($basic_categories as $value)
                <div class="multi-search-item"><span>{{ $value }}</span><input name="categories[]" type="hidden" value="{{ $value }}"><div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
            @endforeach
        @endisset
        <input type="text" id="keywords" onkeydown="multiSearchKeyup(this)" placeholder="Type your keyword. Press comma on your keyboard to confirm.">
    </div>

    <label for="main_category" class="form-label mt-2 mb-1">Parent category</label>
    <select name="main_category" id="" class="col-12 form-control multi-search-filter">
        <option value="">None</option>
        @isset ( $categories )
          @php
            isset($category) ? $catID = $category->id : $catID = 0;
            isset($category->main_category) ? $main_category = $category->main_category : $main_category = 0;
          @endphp

          @foreach ( $categories as $cat )
            @if ( $cat->id != $catID )
            <option @if ($cat->id == $main_category) selected @endif value="{{ $cat->id }}">{{ $cat->title }}</option>
            @endif
          @endforeach
        @endisset
    </select>

    <div class="mb-2 mt-3 col-12">
    <div class="form-check">
        <input name="features_checkbox" class="form-check-input" type="checkbox" id="features_checkbox" {{ isset( $category->features_checkbox ) ? 'checked' : '' }}>
        <label class="form-check-label" for="features_checkbox">
            Featured
        </label><br>
        (If "Featured" is checked, this category will be shown.)
    </div>
    </div>

    <div class="mb-2 mt-3 col-12">
    <div class="form-check">
        <input name="disable_checkbox" class="form-check-input" type="checkbox" id="disable_checkbox" {{ isset( $category->disable_checkbox ) ? 'checked' : '' }}>
        <label class="form-check-label" for="disable_checkbox">
            Disable Category
        </label>
    </div>
    </div>

    <div class="form-label mb-1">
        <label for="content">Content</label>
        <textarea name="content" class="form-control" id="content" style="height: 100px">{{ old('content', isset( $category->content ) ? $category->content : '') }}</textarea>
    </div>

    <div id="seo_information" class='row'>
        <h4 class="mb-1 mt-3">SEO</h4>

        <div class="col-6 mb-2">
            <label for="seo_page_title" class="form-label mt-2 mb-1">Page Title</label>
            <input name="seo_page_title" type="text" class="form-control" id="seo_page_title" value="{{ old('seo_page_title', isset( $category->seo_page_title ) ? $category->seo_page_title : '') }}">
        </div>

        <div class="col-6 mb-2">
            <label for="seo_friendly_title" class="form-label mt-2 mb-1">Friendly Title</label>
            <input name="seo_friendly_title" type="text" class="form-control" id="seo_friendly_title" value="{{ old('seo_friendly_title', isset( $category->seo_friendly_title ) ? $category->seo_friendly_title : '') }}">
        </div>

        <div class="col-12">
            <label class="form-check-label" for="seo_keywords">
                Meta Keywords
            </label>
            <div class="form-control multi-search-filter" onclick="Array.from(this.children).find(n=>n.tagName==='INPUT').focus()">
                @isset ($category->seo_keywords)
                @php
                    if ( is_array($category->seo_keywords) ) {
                        $seo_keywords = $category->seo_keywords;
                    } else {
                        $seo_keywords = json_decode($category->seo_keywords);
                    }
                @endphp
                @endisset

                @isset($seo_keywords)
                    @foreach($seo_keywords as $value)
                        <div class="multi-search-item"><span>{{ $value }}</span><input name="seo_keywords[]" type="hidden" value="{{ $value }}"><div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
                    @endforeach
                @endisset
                <input type="text" id="seo_keywords" onkeydown="SEOmultiSearchKeyup(this)" placeholder="Type your keyword. Press comma on your keyboard to confirm.">
            </div>
            <div class="text-right"><p class="help-block text-right">Maximum 10 keywords</p></div>
        </div>

        <div class="col-12 mt-0">
            <label for="seo_description" class="form-label mt-2 mb-1">Meta Description</label>
            <textarea name="seo_description" type="text" class="form-control" id="seo_description">{{ old('seo_description', isset( $category->seo_description ) ? $category->seo_description : '') }}</textarea>
        </div>
    </div>

    </div>
    <div class="col-4">
        <div class="col-12">
            Logo:<br>
            <input type="file" name="image_logo">
            @isset ($category->image_logo)
              <div class="multi-search-item"><span><img width="200px" src="{{ asset('/storage/' . $category->image_logo) }}"></span>
              <input name="image_logo_prev" type="hidden" value="{{ $category->image_logo }}">
              <div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
            @endisset
        </div>
        <div class="col-12">
            Icon:<br>
            <input type="file" name="image_icon">
            @isset ($category->image_icon)
            <div class="multi-search-item"><span><img width="200px" src="{{ asset('/storage/' . $category->image_icon) }}"></span>
            <input name="image_icon_prev" type="hidden" value="{{ $category->image_icon }}">
            <div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
            @endisset
        </div>
    </div>

    <div class="my-2 col-12">
        <button type="submit" class="btn btn-primary">{{ isset($category) ?  'Update' : 'Create' }}</button>
    </div>
</form>

@isset ($category)
  <form class="col" method="POST" action="{{ route('blog-categories.destroy', $category) }}">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger mb-3">Delete</button>
  </form>
@endisset

  </div>
</div>

<script>
    function multiSearchKeyup(inputElement) {
        if(event.keyCode === 188) {
            if ( $('#keywords').val() !== '' ) {
                inputElement.parentNode
                .insertBefore(createFilterItem(inputElement.value), inputElement);
                inputElement.value = "";
                $(this).focus();
            }

        }
    }
    function createFilterItem(text) {
        const item = document.createElement("div");
        item.setAttribute("class", "multi-search-item");
        const span = `<span>${text}</span><input name="categories[]" type="hidden" value="${text}">`;
        const close = `<div class="fa fa-close" onclick="this.parentNode.remove()"></div>`;
        item.innerHTML = span+close;
        return item;
    }

    $('#keywords').keyup(function() { str = $(this).val(); str = str.replace(/,/g,''); $(this).val(str); });


    function SEOmultiSearchKeyup(inputElement) {
        if(event.keyCode === 188) {
            if ( $('#seo_keywords').val() !== '' ) {
                inputElement.parentNode
                .insertBefore(SEOcreateFilterItem(inputElement.value), inputElement);
                inputElement.value = "";
                $(this).focus();
            }

        }
    }
    function SEOcreateFilterItem(text) {
        const item = document.createElement("div");
        item.setAttribute("class", "multi-search-item");
        const span = `<span>${text}</span><input name="seo_keywords[]" type="hidden" value="${text}">`;
        const close = `<div class="fa fa-close" onclick="this.parentNode.remove()"></div>`;
        item.innerHTML = span+close;
        return item;
    }
    $('#seo_keywords').keyup(function() { str = $(this).val(); str = str.replace(/,/g,''); $(this).val(str); });

</script>
@endsection
