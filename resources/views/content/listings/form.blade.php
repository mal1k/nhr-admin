@extends ('layout')

@section('title', isset($listing) ?  'Update '.$listing->title : 'Create listing')

@section('content')
<div class="my-3">
  <a class="text-decoration-none text-dark" href="{{ route('listings.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top: -3px;margin-right: -3px;"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
    Back
  </a>
</div>

<div id="selectPlan">
    <div class="row mb-3 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-white bg-primary border-primary">
            <h4 class="my-0 fw-normal">Bronze</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/mo</small></h1>
                {{-- <ul class="list-unstyled mt-3 mb-4">
                <li>30 users included</li>
                <li>15 GB of storage</li>
                <li>Phone and email support</li>
                <li>Help center access</li>
                </ul> --}}
            <button type="submit" value='bronze' class="selectPlanBtn w-100 btn btn-lg btn-primary">Select</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Silver</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$119.95<small class="text-muted fw-light">/mo</small></h1>
                {{-- <ul class="list-unstyled mt-3 mb-4">
                <li>10 users included</li>
                <li>2 GB of storage</li>
                <li>Email support</li>
                <li>Help center access</li>
                </ul> --}}
            <button type="submit" value='silver' class="selectPlanBtn w-100 btn btn-lg btn-outline-primary">Select</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Gold</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$249.95<small class="text-muted fw-light">/mo</small></h1>
                {{-- <ul class="list-unstyled mt-3 mb-4">
                <li>10 users included</li>
                <li>2 GB of storage</li>
                <li>Email support</li>
                <li>Help center access</li>
                </ul> --}}
            <button type="submit" value='gold' class="selectPlanBtn w-100 btn btn-lg btn-outline-primary">Select</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Platinum</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$299.95<small class="text-muted fw-light">/mo</small></h1>
                {{-- <ul class="list-unstyled mt-3 mb-4">
                <li>10 users included</li>
                <li>2 GB of storage</li>
                <li>Email support</li>
                <li>Help center access</li>
                </ul> --}}
            <button type="submit" value='platinum' class="selectPlanBtn w-100 btn btn-lg btn-outline-primary">Select</button>
          </div>
        </div>
      </div>
    </div>
  {{-- </form> --}}
</div>


<div id="mainForm" class="hidden">

  <form method="POST" enctype="multipart/form-data"
    @if ( isset($listing) )
        action="{{ route('listings.update', $listing) }}"
    @else
        action="{{ route('listings.store') }}"
    @endif
    class="row row-cols-lg-auto g-3 align-items-center">
    @csrf
    @isset($listing)
        @method('PUT')
    @endisset

    <div class="col-8">
    <div class="row">
      <div class="mb-2 col">
        <label for="title" class="form-label mt-2 mb-1">Title</label>
        <input name="title" type="text" class="form-control" id="title" placeholder="Type your listing title here." value="{{ old('title', isset( $listing->title ) ? $listing->title : '') }}">
      </div>
      <div class="mb-2 col-4">
        <label for="level" class="form-label mt-2 mb-1">Listing level</label>
        <select name="level" id="level" class="form-select">
          <option selected disabled>Choose...</option>
          <option @if ( isset( $listing ) )
                @if ($listing->level === 'bronze' )
                  selected
                @endif
              @endif value="bronze">Bronze</option>
          <option @if ( isset( $listing ) )
                @if ($listing->level === 'silver' )
                  selected
                @endif
              @endif value="silver">Silver</option>
          <option @if ( isset( $listing ) )
                @if ($listing->level === 'gold' )
                  selected
                @endif
              @endif value="gold">Gold</option>
          <option @if ( isset( $listing ) )
                @if ($listing->level === 'platinum' )
                  selected
                @endif
              @endif value="platinum">Platinum</option>
        </select>
      </div>

    <div id="basic_information" class=''>
      <h4 class="mb-1 mt-3">Basic information</h4>

      <div class="mb-2 col-12">
        <label for="basic_categories" class="form-label mt-2 mb-1">Categories || <b>WAITING FOR RESPONSE</b></label>
        <select name="basic_categories[]" class="form-select select" multiple>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
          <option value="4">Four</option>
          <option value="5">Five</option>
          <option value="6">Six</option>
          <option value="7">Seven</option>
          <option value="8">Eight</option>
        </select>
      </div>

      <div class="mb-2 col">
        <label for="basic_account" class="form-label mt-2 mb-1">Account</label>

        <select name="basic_account" id="basic_account" class="form-select col">
          @foreach ( $users as $user )
            <option {{ isset($listing->basic_account) && $listing->basic_account == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-2 col">
        <label for="basic_status" class="form-label mt-2 mb-1">Status</label>
        <select name="basic_status" id="basic_status" class="form-select col">
          <option selected disabled>Choose...</option>
          <option @if ( isset( $listing ) )
                @if ($listing->basic_status === 'active' )
                  selected
                @endif
              @endif value="active">Active</option>
          <option @if ( isset( $listing ) )
                @if ($listing->basic_status === 'suspended' )
                  selected
                @endif
              @endif value="suspended">Suspended</option>
          <option @if ( isset( $listing ) )
                @if ($listing->basic_status === 'pending' )
                  selected
                @endif
              @endif value="pending">Pending</option>
        </select>
      </div>

      <div class="mb-2 col">
        <label for="basic_renewal_date" class="form-label mt-2 mb-1">Renewal date</label>
        <input name="basic_renewal_date" type="date" class="form-control" id="basic_renewal_date" placeholder="Change Expiration Date" value="{{ old('basic_renewal_date', isset( $listing->basic_renewal_date ) ? $listing->basic_renewal_date : '') }}">
      </div>

      <div class="mb-2 mt-3 col-12">
        <div class="form-check">
          <input name="basic_disable_claim" class="form-check-input" type="checkbox" id="claim_disable" {{ isset( $listing->basic_disable_claim ) ? 'checked' : '' }}>
          <label class="form-check-label" for="claim_disable">
            Disable claim feature for this listing
          </label>
        </div>
      </div>

      <div class="form-label mb-1">
        <label for="basic_summary_desc">Summary Description</label>
        <textarea name="basic_summary_desc" class="form-control" placeholder="Brief description of the listing." id="basic_summary_desc" style="height: 100px">{{ old('basic_renewal_date', isset( $listing->basic_summary_desc ) ? $listing->basic_summary_desc : '') }}</textarea>
        <div class="text-right"><p class="help-block text-right">250 characters left</p></div>
      </div>

      <div class="mb-2 col-12">
        <label class="form-check-label" for="claim_disable">
            Keywords for the search
        </label>

        <div class="form-control multi-search-filter" onclick="Array.from(this.children).find(n=>n.tagName==='INPUT').focus()">
            @isset($listing->basic_keywords)
                @foreach($listing->basic_keywords as $value)
                    <div class="multi-search-item"><span>{{ $value }}</span><input name="basic_keywords[]" type="hidden" value="{{ $value }}"><div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
                @endforeach
            @endisset
            <input type="text" id="keywords" onkeydown="multiSearchKeyup(this)" placeholder="Type your keyword. Press comma on your keyboard to confirm.">
        </div>
        <div class="text-right"><p class="help-block text-right">Maximum 10 keywords</p></div>
      </div>
    </div>

    <div id="contact_information" class='row'>
        <h4 class="mb-1 mt-3">Contact information</h4>

        <div class="col-5 mb-2">
            <label for="contact_url" class="form-label mt-2 mb-1">URL</label>
            <input name="contact_url" type="text" class="form-control" id="contact_url" placeholder="Ex: www.website.com" value="{{ old('contact_url', isset( $listing->contact_url ) ? $listing->contact_url : '') }}">
        </div>

        <div class="col-12 mb-2">
            <label for="contact_address" class="form-label mt-2 mb-1">Address</label>
            <input name="contact_address" type="text" class="form-control" id="contact_address" placeholder="Street Address, P.O. box" value="{{ old('contact_address', isset( $listing->contact_address ) ? $listing->contact_address : '') }}">
        </div>

        <div class="col-6 mb-2">
            <label for="contact_address2" class="form-label mt-2 mb-1">Address 2</label>
            <input name="contact_address2" type="text" class="form-control" id="contact_address2" placeholder="Apartment, suite, unit, building, floor, etc." value="{{ old('contact_address2', isset( $listing->contact_address2 ) ? $listing->contact_address2 : '') }}">
        </div>

        <div class="col-6 mb-2">
            <label for="contact_zip_code" class="form-label mt-2 mb-1">Zip Code</label>
            <input name="contact_zip_code" type="text" class="form-control" id="contact_zip_code" value="{{ old('contact_zip_code', isset( $listing->contact_zip_code ) ? $listing->contact_zip_code : '') }}">
        </div>

        <div class="my-2">
            <div id="map"></div>
        </div>


        <div class="col-6 mb-2">
            <label for="contact_map_info" class="form-label mt-2 mb-1">MAPINFO</label>
            <input name="contact_map_info" type="text" class="form-control" id="contact_map_info" value="{{ old('contact_map_info', isset( $listing->contact_map_info ) ? $listing->contact_map_info : '') }}">
        </div>

      </div>

      <div id="seo_information" class='row'>
        <h4 class="mb-1 mt-3">SEO</h4>

        <div class="col-6 mb-2">
            <label for="seo_title" class="form-label mt-2 mb-1">SEO title</label>
            <input name="seo_title" type="text" class="form-control" id="seo_title" placeholder="Type your listing title here." value="{{ old('seo_title', isset( $listing->seo_title ) ? $listing->seo_title : '') }}">
        </div>

        <div class="col-6 mb-2">
            <label for="seo_page_name" class="form-label mt-2 mb-1">Page name</label>
            <input name="seo_page_name" type="text" class="form-control" id="seo_page_name" value="{{ old('seo_page_name', isset( $listing->seo_page_name ) ? $listing->seo_page_name : '') }}">
        </div>

        <div class="mb-2 col-12">
            <label class="form-check-label" for="seo_keywords">
                Keywords
            </label>
            <div class="form-control multi-search-filter" onclick="Array.from(this.children).find(n=>n.tagName==='INPUT').focus()">
                @isset($listing->seo_keywords)
                    @foreach($listing->seo_keywords as $value)
                        <div class="multi-search-item"><span>{{ $value }}</span><input name="seo_keywords[]" type="hidden" value="{{ $value }}"><div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
                    @endforeach
                @endisset
                <input type="text" id="seo_keywords" onkeydown="SEOmultiSearchKeyup(this)" placeholder="Type your keyword. Press comma on your keyboard to confirm.">
            </div>
            <div class="text-right"><p class="help-block text-right">Maximum 10 keywords</p></div>
        </div>

        <div class="col-12 mb-2">
            <label for="seo_description" class="form-label mt-2 mb-1">Description</label>
            <textarea name="seo_description" type="text" class="form-control" id="seo_description">{{ old('seo_description', isset( $listing->seo_description ) ? $listing->seo_description : '') }}</textarea>
        </div>

      </div>

      <div id="promotional_section" class='row'>
        <h4 class="mb-1 mt-3">Promotional Code</h4>
        <div class="col-12 mb-2">
            <label for="promotional_code" class="form-label mt-2 mb-1">Do you have a discount code? Type it here.</label>
            <input name="promotional_code" type="text" class="form-control" id="promotional_code" value="{{ old('promotional_code', isset( $listing->promotional_code ) ? $listing->promotional_code : '') }}">
        </div>
      </div>

      <div class="mb-2 col-12">
        <button type="submit" class="btn btn-primary">{{ isset($listing) ?  'Update' : 'Create' }}</button>
      </div>

    </div>
</div>

    <div class="col-4">
      {{-- images --}}
      Logo:<br>
      <input type="file" name="image_logo">
      @isset ($listing->image_logo)
        <div class="multi-search-item"><span><img src="{{ asset('/storage/' . $listing->image_logo) }}"></span>
        <input name="image_logo_prev" type="hidden" value="{{ $listing->image_logo }}">
        <div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>

      @endisset
    </div>
  </form>

  @isset ($listing)
    <form class="col" method="POST" action="{{ route('listings.destroy', $listing) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mb-3">Delete</button>
    </form>
  @endisset
</div>

<script>
    // change subs block to form
    $('.selectPlanBtn').click(function()
    {
        event.preventDefault();
        mapQuery = $(this).val();

        // change plans to form
          $('#selectPlan').hide();
          $('#mainForm').fadeIn();
        // select sub
          $('#level').val(mapQuery);
    })

    if ( $('#title').val() ) {
        $('#selectPlan').hide();
        $('#mainForm').fadeIn();
    }

    // add map
    $('#contact_address').focusout(function() { createMap() })

    if ( $('#contact_address').val() !== '' ) {
        createMap()
    }

    function createMap() {
        mapQuery = $('#contact_address').val();

        $('#map').html(`
        <div class="mapouter">
            <div class="gmap_canvas">
                <iframe class="gmap_iframe"
                    frameborder="0"
                    scrolling="no"
                    marginheight="0"
                    marginwidth="0"
                    src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=`+mapQuery+`&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                </iframe>
            </div>
            <style>.mapouter{position:relative;text-align:right;width:600px;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:600px;height:400px;}.gmap_iframe {width:600px!important;height:400px!important;}</style>
        </div>
        `);
    }

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
        const span = `<span>${text}</span><input name="basic_keywords[]" type="hidden" value="${text}">`;
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
