@extends ('layout')

@section('title', isset($blog) ?  'Update '.$blog->title : 'Create blog')

@section('content')
<div class="my-3">
  <a class="text-decoration-none text-dark" href="{{ route('blog.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top: -3px;margin-right: -3px;"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
    Back
  </a>
</div>

<div id="mainForm">

  <form method="POST" enctype="multipart/form-data"
    @if ( isset($blog) )
        action="{{ route('blog.update', $blog) }}"
    @else
        action="{{ route('blog.store') }}"
    @endif
    class="row row-cols-lg-auto g-3 align-items-center">
    @csrf
    @isset($blog)
        @method('PUT')
    @endisset

    <div class="col-8">
    <div class="row">
      <div class="mb-2 col">
        <label for="title" class="form-label mt-2 mb-1">Title</label>
        <input name="title" type="text" class="form-control" id="title" placeholder="Type your blog title here." value="{{ old('title', isset( $blog->title ) ? $blog->title : '') }}">
        @error('title')
            <div class="alert alert-danger mb-0">{{ $message }}</div>
        @enderror
      </div>

    <div id="basic_information" class=''>
      <h4 class="mb-1 mt-3">Basic information</h4>

      <div class="mb-2 col-12">
        <label for="categories" class="form-label mt-2 mb-1">Categories || <b>WAITING FOR RESPONSE</b></label>
        <select name="categories[]" class="form-select select" multiple="multiple">
        @isset ($blog->categories)
        @php
            if ( is_array($blog->categories) ) {
                $categories = $blog->categories;
            } else {
                $categories = json_decode($blog->categories);
            }
        @endphp
        @endisset

        @isset ( $blogCategories )
          @foreach ( $blogCategories as $blogCategory )
            <option
            @if ( isset( $categories ) )
              @if ( in_array($blogCategory->id, $categories) )
                selected
              @endif
            @endif value="{{ $blogCategory->id }}">{{ $blogCategory->title }}</option>
          @endforeach
        @endisset
        </select>
      </div>

      <div class="mb-2 col">
        <label for="status" class="form-label mt-2 mb-1">Status</label>
        <select name="status" id="status" class="form-select col">
          <option selected disabled>Choose...</option>
          <option @if ( isset( $blog ) )
                @if ($blog->status === 'active' )
                  selected
                @endif
              @endif value="active">Active</option>
          <option @if ( isset( $blog ) )
                @if ($blog->status === 'suspended' )
                  selected
                @endif
              @endif value="suspended">Suspended</option>
          <option @if ( isset( $blog ) )
                @if ($blog->status === 'pending' )
                  selected
                @endif
              @endif value="pending">Pending</option>
        </select>
      </div>

      <div class="form-label mb-1">
        <label for="content">Content</label>
        <textarea name="content" class="form-control" id="content" style="height: 150px">{{ old('content', isset( $blog->content ) ? $blog->content : '') }}</textarea>
      </div>

      <div class="mb-2 col-12">
        <label class="form-check-label" for="claim_disable">
            Keywords for the search
        </label>

        <div class="form-control multi-search-filter" onclick="Array.from(this.children).find(n=>n.tagName==='INPUT').focus()">

            @isset ( $blog->keywords )
            @php
                if ( is_array($blog->keywords) ) {
                    $keywords = $blog->keywords;
                } else {
                    $keywords = json_decode($blog->keywords);
                }
            @endphp
            @endisset

            @isset($keywords)
                @foreach($keywords as $value)
                    <div class="multi-search-item"><span>{{ $value }}</span><input name="keywords[]" type="hidden" value="{{ $value }}"><div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
                @endforeach
            @endisset
            <input type="text" id="keywords" onkeydown="multiSearchKeyup(this)" placeholder="Type your keyword. Press comma on your keyboard to confirm.">
        </div>
        <div class="text-right"><p class="help-block text-right">Maximum 10 keywords</p></div>
      </div>
    </div>

    <div id="seo_information" class='row'>
        <h4 class="mb-1 mt-3">SEO</h4>

        <div class="col-6 mb-2">
            <label for="seo_title" class="form-label mt-2 mb-1">SEO title</label>
            <input name="seo_title" type="text" class="form-control" id="seo_title" placeholder="Type your blog title here." value="{{ old('seo_title', isset( $blog->seo_title ) ? $blog->seo_title : '') }}">
        </div>

        <div class="col-6 mb-2">
            <label for="seo_page_name" class="form-label mt-2 mb-1">Page name</label>
            <input name="seo_page_name" type="text" class="form-control" id="seo_page_name" value="{{ old('seo_page_name', isset( $blog->seo_page_name ) ? $blog->seo_page_name : '') }}">
        </div>

        <div class="mb-2 col-12">
            <label class="form-check-label" for="seo_keywords">
                Keywords
            </label>
            <div class="form-control multi-search-filter" onclick="Array.from(this.children).find(n=>n.tagName==='INPUT').focus()">

                @isset ( $blog->seo_keywords )
                @php
                    if ( is_array($blog->seo_keywords) ) {
                        $seo_keywords = $blog->seo_keywords;
                    } else {
                        $seo_keywords = json_decode($blog->seo_keywords);
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

        <div class="col-12 mb-2">
            <label for="seo_description" class="form-label mt-2 mb-1">Description</label>
            <textarea name="seo_description" type="text" class="form-control" id="seo_description">{{ old('seo_description', isset( $blog->seo_description ) ? $blog->seo_description : '') }}</textarea>
        </div>
    </div>

      <div class="mb-2 col-12">
        <button type="submit" class="btn btn-primary">{{ isset($blog) ?  'Update' : 'Create' }}</button>
      </div>

    </div>
</div>

    {{-- right content --}}
    <div class="col-4">
      <div class="row">
        <div class="col-12">
            Logo:<br>
            <input type="file" name="image_logo">
            @isset ($blog->image_logo)
            <div class="multi-search-item"><span><img width="200px" src="{{ asset('/storage/' . $blog->image_logo) }}"></span>
            <input name="image_logo_prev" type="hidden" value="{{ $blog->image_logo }}">
            <div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
            @endisset
        </div>
        <div class="col-12">
            Cover:<br>
            <input type="file" name="image_cover">
            @isset ($blog->image_cover)
            <div class="multi-search-item"><span><img width="200px" src="{{ asset('/storage/' . $blog->image_cover) }}"></span>
            <input name="image_cover_prev" type="hidden" value="{{ $blog->image_cover }}">
            <div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
            @endisset
        </div>
      </div>
    </div>
  </form>

  @isset ($blog)
    <form class="col" method="POST" action="{{ route('blog.destroy', $blog) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mb-3">Delete</button>
    </form>
  @endisset
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
        const span = `<span>${text}</span><input name="keywords[]" type="hidden" value="${text}">`;
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
