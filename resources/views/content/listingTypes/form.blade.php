@extends ('layout')

@section('title', isset($listingType) ?  'Update '.$listingType->title : 'Create listing type')

@section('content')
<div class="my-3">
  <a class="text-decoration-none text-dark" href="{{ route('listing-types.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top: -3px;margin-right: -3px;"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
    Back
  </a>
</div>

<div id="mainForm">

  <form method="POST" enctype="multipart/form-data"
    @if ( isset($listingType) )
        action="{{ route('listing-types.update', $listingType) }}"
    @else
        action="{{ route('listing-types.store') }}"
    @endif
    class="row row-cols-lg-auto g-3 align-items-center">
    @csrf
    @isset($listingType)
        @method('PUT')
    @endisset

    <div class="col-8">
    <div class="row">
      <div class="mb-2 col-12">
        <label for="title" class="form-label mt-2 mb-1">Title</label>
        <input name="title" type="text" class="form-control" id="title" value="{{ old('title', isset( $listingType->title ) ? $listingType->title : '') }}">
        @error('title')
            <div class="alert alert-danger mb-0">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-2 col-12">
        <label for="categories" class="form-label mt-2 mb-1">Categories || <b>WAITING FOR RESPONSE</b></label>
        <select name="categories[]" class="form-select select" multiple="multiple">
            @isset ($listingType->categories)
            @php
            if ( is_array($listingType->categories) ) {
                $categories = $listingType->categories;
            } else {
                $categories = json_decode($listingType->categories);
            }
            @endphp
            @endisset
          <option @if ( isset( $categories ) )
                @if ( in_array(1, $categories) )
                  selected
                @endif
              @endif value="1">One</option>
          <option @if ( isset( $categories ) )
                @if ( in_array(2, $categories) )
                  selected
                @endif
              @endif value="2">Two</option>
          <option @if ( isset( $categories ) )
                @if ( in_array(3, $categories) )
                  selected
                @endif
              @endif value="3">Three</option>
          <option @if ( isset( $categories ) )
                @if ( in_array(4, $categories) )
                  selected
                @endif
              @endif value="4">Four</option>
          <option @if ( isset( $categories ) )
                @if ( in_array(5, $categories) )
                  selected
                @endif
              @endif value="5">Five</option>
          <option @if ( isset( $categories ) )
                @if ( in_array(6, $categories) )
                  selected
                @endif
              @endif value="6">Six</option>
          <option @if ( isset( $categories ) )
                @if ( in_array(7, $categories) )
                  selected
                @endif
              @endif value="7">Seven</option>
          <option @if ( isset( $categories ) )
                @if ( in_array(8, $categories) )
                  selected
                @endif
              @endif value="8">Eight</option>
        </select>
      </div>
      <div class="mb-2 col-6">
        <label for="additional_price" class="form-label mt-2 mb-1">Additinal price</label>
        <input name="additional_price" type="number" class="form-control" id="additional_price" value="{{ old('additional_price', isset( $listingType->additional_price ) ? $listingType->additional_price : '') }}">
      </div>

      <div id="common_fields_block" class='row'>
        <h4 class="mb-1 mt-3">Common Fields</h4>

            <div class="col-2 mb-2">
                <label for="seo_title" class="form-label mt-2 mb-1">Field</label><br>
                Listing title
            </div>
            <div class="col-5 mb-2">
                <label for="common_fields_listing_title_label" class="form-label mt-2 mb-1">Label</label>
                <input name="common_fields_listing_title_label" type="text" class="form-control" id="common_fields_listing_title_label" value="{{ old('common_fields_listing_title_label', isset( $listingType->common_fields_listing_title_label ) ? $listingType->common_fields_listing_title_label : '') }}">
            </div>
            <div class="col-5 mb-2">
                <label for="common_fields_listing_title_tooltip" class="form-label mt-2 mb-1">Tool tip</label>
                <input name="common_fields_listing_title_tooltip" type="text" class="form-control" id="common_fields_listing_title_tooltip" value="{{ old('common_fields_listing_title_tooltip', isset( $listingType->common_fields_listing_title_tooltip ) ? $listingType->common_fields_listing_title_tooltip : '') }}">
            </div>

            <div class="col-2 mb-2">
                <label for="seo_title" class="form-label mt-2 mb-1">Address Line</label>
            </div>
            <div class="col-5 mb-2">
                <input name="common_fields_address_line_label" type="text" class="form-control" id="common_fields_address_line_label" value="{{ old('common_fields_address_line_label', isset( $listingType->common_fields_address_line_label ) ? $listingType->common_fields_address_line_label : '') }}">
            </div>
            <div class="col-5 mb-2">
                <input name="common_fields_address_line_tooltip" type="text" class="form-control" id="common_fields_address_line_tooltip" value="{{ old('common_fields_address_line_tooltip', isset( $listingType->common_fields_address_line_tooltip ) ? $listingType->common_fields_address_line_tooltip : '') }}">
            </div>

            <div class="col-2 mb-2">
                <label for="seo_title" class="form-label mt-2 mb-1">Address Line2</label>
            </div>
            <div class="col-5 mb-2">
                <input name="common_fields_address_line2_label" type="text" class="form-control" id="common_fields_address_line2_label" value="{{ old('common_fields_address_line2_label', isset( $listingType->common_fields_address_line2_label ) ? $listingType->common_fields_address_line2_label : '') }}">
            </div>
            <div class="col-5 mb-2">
                <input name="common_fields_address_line2_tooltip" type="text" class="form-control" id="common_fields_address_line2_tooltip" value="{{ old('common_fields_address_line2_tooltip', isset( $listingType->common_fields_address_line2_tooltip ) ? $listingType->common_fields_address_line2_tooltip : '') }}">
            </div>
      </div>

      <div id="extra_checkbox_fields_block" class='row'>
        <h4 class="mb-1 mt-3">Extra Checkbox Fields</h4>

            <div class="col-6 mb-2">
                <label for="extra_checkbox_fields_label" class="form-label mt-2 mb-1">Label</label>
                <input name="extra_checkbox_fields_label" type="text" class="form-control" id="extra_checkbox_fields_label" value="{{ old('extra_checkbox_fields_label', isset( $listingType->extra_checkbox_fields_label ) ? $listingType->extra_checkbox_fields_label : '') }}">
            </div>
            <div class="col-6 mb-2">
                <label for="extra_checkbox_fields_tooltip" class="form-label mt-2 mb-1">Tool Tip</label>
                <input name="extra_checkbox_fields_tooltip" type="text" class="form-control" id="extra_checkbox_fields_tooltip" value="{{ old('extra_checkbox_fields_tooltip', isset( $listingType->extra_checkbox_fields_tooltip ) ? $listingType->extra_checkbox_fields_tooltip : '') }}">
            </div>
      </div>

      <div id="extra_dropdown_fields_block" class='row'>
        <h4 class="mb-1 mt-3">Extra Dropdown Fields</h4>

            <div class="col-3 mb-2">
                <label for="extra_dropdown_fields_label" class="form-label mt-2 mb-1">Label</label>
                <input name="extra_dropdown_fields_label" type="text" class="form-control" id="extra_dropdown_fields_label" value="{{ old('extra_dropdown_fields_label', isset( $listingType->extra_dropdown_fields_label ) ? $listingType->extra_dropdown_fields_label : '') }}">
            </div>
            <div class="col-3 mb-2">
                <label for="extra_dropdown_fields_dropdown_items" class="form-label mt-2 mb-1">Dropdown items</label>
                <textarea name="extra_dropdown_fields_dropdown_items" type="text" class="form-control" id="extra_dropdown_fields_dropdown_items">{{ isset( $listingType->extra_dropdown_fields_dropdown_items ) ? $listingType->extra_dropdown_fields_dropdown_items : '' }}</textarea>
            </div>
            <div class="col-3 mb-2">
                <label for="extra_dropdown_fields_tooltip" class="form-label mt-2 mb-1">Tool Tip</label>
                <input name="extra_dropdown_fields_tooltip" type="text" class="form-control" id="extra_dropdown_fields_tooltip" value="{{ old('extra_dropdown_fields_tooltip', isset( $listingType->extra_dropdown_fields_tooltip ) ? $listingType->extra_dropdown_fields_tooltip : '') }}">
            </div>
            <div class="col-3 mb-2">
                <label for="extra_dropdown_fields_checkbox" class="form-label mt-2 mb-1">Required</label><br>
                <input type="checkbox" name="extra_dropdown_fields_checkbox" id="extra_dropdown_fields_checkbox" {{ isset($listingType->extra_dropdown_fields_checkbox) ? 'checked' : '' }}>
            </div>
      </div>

      <div id="extra_text_fields_block" class='row'>
        <h4 class="mb-1 mt-3">Extra Text Fields</h4>

            <div class="col-4 mb-2">
                <label for="extra_text_fields_label" class="form-label mt-2 mb-1">Label</label>
                <input name="extra_text_fields_label" type="text" class="form-control" id="extra_text_fields_label" value="{{ old('extra_text_fields_label', isset( $listingType->extra_text_fields_label ) ? $listingType->extra_text_fields_label : '') }}">
            </div>
            <div class="col-4 mb-2">
                <label for="extra_text_fields_tooltip" class="form-label mt-2 mb-1">Tool Tip</label>
                <input name="extra_text_fields_tooltip" type="text" class="form-control" id="extra_text_fields_tooltip" value="{{ old('extra_text_fields_tooltip', isset( $listingType->extra_text_fields_tooltip ) ? $listingType->extra_text_fields_tooltip : '') }}">
            </div>
            <div class="col-4 mb-2">
                <label for="extra_text_fields_checkbox" class="form-label mt-2 mb-1">Required</label><br>
                <input type="checkbox" name="extra_text_fields_checkbox" id="extra_text_fields_checkbox" {{ isset($listingType->extra_text_fields_checkbox) ? 'checked' : '' }}>
            </div>
      </div>

      <div id="extra_short_description_fields_block" class='row'>
        <h4 class="mb-1 mt-3">Extra Short Description Fields</h4>

            <div class="col-4 mb-2">
                <label for="extra_short_description_fields_label" class="form-label mt-2 mb-1">Label</label>
                <input name="extra_short_description_fields_label" type="text" class="form-control" id="extra_short_description_fields_label" value="{{ old('extra_short_description_fields_label', isset( $listingType->extra_short_description_fields_label ) ? $listingType->extra_short_description_fields_label : '') }}">
            </div>
            <div class="col-4 mb-2">
                <label for="extra_short_description_fields_tooltip" class="form-label mt-2 mb-1">Tool Tip</label>
                <input name="extra_short_description_fields_tooltip" type="text" class="form-control" id="extra_short_description_fields_tooltip" value="{{ old('extra_short_description_fields_tooltip', isset( $listingType->extra_short_description_fields_tooltip ) ? $listingType->extra_short_description_fields_tooltip : '') }}">
            </div>
            <div class="col-4 mb-2">
                <label for="extra_short_description_fields_checkbox" class="form-label mt-2 mb-1">Required</label><br>
                <input type="checkbox" name="extra_short_description_fields_checkbox" id="extra_short_description_fields_checkbox" {{ isset($listingType->extra_short_description_fields_checkbox) ? 'checked' : '' }}>
            </div>
      </div>

      <div id="extra_long_description_fields_block" class='row'>
        <h4 class="mb-1 mt-3">Extra Long Description Fields</h4>

            <div class="col-4 mb-2">
                <label for="extra_long_description_fields_label" class="form-label mt-2 mb-1">Label</label>
                <input name="extra_long_description_fields_label" type="text" class="form-control" id="extra_long_description_fields_label" value="{{ old('extra_long_description_fields_label', isset( $listingType->extra_long_description_fields_label ) ? $listingType->extra_long_description_fields_label : '') }}">
            </div>
            <div class="col-4 mb-2">
                <label for="extra_long_description_fields_tooltip" class="form-label mt-2 mb-1">Tool Tip</label>
                <input name="extra_long_description_fields_tooltip" type="text" class="form-control" id="extra_long_description_fields_tooltip" value="{{ old('extra_long_description_fields_tooltip', isset( $listingType->extra_long_description_fields_tooltip ) ? $listingType->extra_long_description_fields_tooltip : '') }}">
            </div>
            <div class="col-4 mb-2">
                <label for="extra_long_description_fields_checkbox" class="form-label mt-2 mb-1">Required</label><br>
                <input type="checkbox" name="extra_long_description_fields_checkbox" id="extra_long_description_fields_checkbox" {{ isset($listingType->extra_long_description_fields_checkbox) ? 'checked' : '' }}>
            </div>
      </div>

      <div class="mb-2 col-12">
        <button type="submit" class="btn btn-primary">{{ isset($listingType) ?  'Update' : 'Create' }}</button>
      </div>

    </div>
</div>
</form>

  @isset ($listingType)
    <form class="col" method="POST" action="{{ route('listing-types.destroy', $listingType) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mb-3">Delete</button>
    </form>
  @endisset
</div>
@endsection
