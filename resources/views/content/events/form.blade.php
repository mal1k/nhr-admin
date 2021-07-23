@extends ('layout')

@section('title', isset($event) ?  'Update '.$event->title : 'Create event')

@section('content')
<div class="my-3">
  <a class="text-decoration-none text-dark" href="{{ route('events.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top: -3px;margin-right: -3px;"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
    Back
  </a>
</div>

<div id="selectPlan">
    <div class="row mb-3 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-white bg-primary border-primary">
            <h4 class="my-0 fw-normal">Base event</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/mo</small></h1>
                {{-- <ul class="list-unstyled mt-3 mb-4">
                <li>30 users included</li>
                <li>15 GB of storage</li>
                <li>Phone and email support</li>
                <li>Help center access</li>
                </ul> --}}
            <button type="submit" value='Baseevent' class="selectPlanBtn w-100 btn btn-lg btn-primary">Select</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Moderate Visibility</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$2.00<small class="text-muted fw-light">/mo</small></h1>
                {{-- <ul class="list-unstyled mt-3 mb-4">
                <li>10 users included</li>
                <li>2 GB of storage</li>
                <li>Email support</li>
                <li>Help center access</li>
                </ul> --}}
            <button type="submit" value='ModerateVisibility' class="selectPlanBtn w-100 btn btn-lg btn-outline-primary">Select</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">High Visibility</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$5.00<small class="text-muted fw-light">/mo</small></h1>
                {{-- <ul class="list-unstyled mt-3 mb-4">
                <li>10 users included</li>
                <li>2 GB of storage</li>
                <li>Email support</li>
                <li>Help center access</li>
                </ul> --}}
            <button type="submit" value='HighVisibility' class="selectPlanBtn w-100 btn btn-lg btn-outline-primary">Select</button>
          </div>
        </div>
      </div>
    </div>
  {{-- </form> --}}
</div>


<div id="mainForm" class="hidden">

  <form method="POST" enctype="multipart/form-data"
    @if ( isset($event) )
        action="{{ route('events.update', $event) }}"
    @else
        action="{{ route('events.store') }}"
    @endif
    class="row row-cols-lg-auto g-3 align-items-center">
    @csrf
    @isset($event)
        @method('PUT')
    @endisset

    <div class="col-8">
    <div class="row">
      <div class="mb-2 col">
        <label for="title" class="form-label mt-2 mb-1">Title</label>
        <input name="title" type="text" class="form-control" id="title" placeholder="Type your event title here." value="{{ old('title', isset( $event->title ) ? $event->title : '') }}">
        @error('title')
            <div class="alert alert-danger mb-0">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-2 col-4">
        <label for="level" class="form-label mt-2 mb-1">event level</label>
        <select name="level" id="level" class="form-select">
          <option selected disabled>Choose...</option>
          <option @if ( isset( $event ) )
                @if ($event->level === 'Baseevent' )
                  selected
                @endif
              @endif value="Baseevent">Base event</option>
          <option @if ( isset( $event ) )
                @if ($event->level === 'ModerateVisibility' )
                  selected
                @endif
              @endif value="ModerateVisibility">Moderate Visibility</option>
          <option @if ( isset( $event ) )
                @if ($event->level === 'HighVisibility' )
                  selected
                @endif
              @endif value="HighVisibility">High Visibility</option>
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
            <option {{ isset($event->basic_account) && $event->basic_account == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-2 col">
        <label for="basic_status" class="form-label mt-2 mb-1">Status</label>
        <select name="basic_status" id="basic_status" class="form-select col">
          <option selected disabled>Choose...</option>
          <option @if ( isset( $event ) )
                @if ($event->basic_status === 'active' )
                  selected
                @endif
              @endif value="active">Active</option>
          <option @if ( isset( $event ) )
                @if ($event->basic_status === 'suspended' )
                  selected
                @endif
              @endif value="suspended">Suspended</option>
          <option @if ( isset( $event ) )
                @if ($event->basic_status === 'pending' )
                  selected
                @endif
              @endif value="pending">Pending</option>
        </select>
      </div>

      <div class="mb-2 col">
        <label for="basic_renewal_date" class="form-label mt-2 mb-1">Renewal date</label>
        <input name="basic_renewal_date" type="date" class="form-control" id="basic_renewal_date" placeholder="Change Expiration Date" value="{{ old('basic_renewal_date', isset( $event->basic_renewal_date ) ? $event->basic_renewal_date : '') }}">
      </div>

      <div class="form-label mb-1">
        <label for="basic_summary_desc">Summary Description</label>
        <textarea name="basic_summary_desc" class="form-control" placeholder="Brief description of the event." id="basic_summary_desc" style="height: 100px">{{ old('basic_renewal_date', isset( $event->basic_summary_desc ) ? $event->basic_summary_desc : '') }}</textarea>
        <div class="text-right"><p class="help-block text-right">250 characters left</p></div>
      </div>

      <div class="form-label mb-1">
        <label for="basic_description">Description</label>
        <textarea name="basic_description" class="form-control" placeholder="Introduce the event to the public in a clear and efficient way. Describe all features that make the establishment unique and a great option for clients." id="basic_description" style="height: 100px">{{ old('basic_description', isset( $event->basic_description ) ? $event->basic_description : '') }}</textarea>
      </div>

      <div class="mb-2 col-12">
        <label class="form-check-label" for="claim_disable">
            Keywords for the search
        </label>

        <div class="form-control multi-search-filter" onclick="Array.from(this.children).find(n=>n.tagName==='INPUT').focus()">
            @isset($event->basic_keywords)
                @foreach($event->basic_keywords as $value)
                    <div class="multi-search-item"><span>{{ $value }}</span><input name="basic_keywords[]" type="hidden" value="{{ $value }}"><div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
                @endforeach
            @endisset
            <input type="text" id="keywords" onkeydown="multiSearchKeyup(this)" placeholder="Type your keyword. Press comma on your keyboard to confirm.">
        </div>
        <div class="text-right"><p class="help-block text-right">Maximum 10 keywords</p></div>

        <div class="col mb-2">
            <label for="social_facebook" class="form-label mt-2 mb-1">Facebook page</label>
            <input name="social_facebook" type="text" class="form-control" id="social_facebook" value="{{ old('social_facebook', isset( $event->social_facebook ) ? $event->social_facebook : '') }}">
        </div>
      </div>
    </div>

    <div id="contact_information" class='row'>
        <h4 class="mb-1 mt-3">Contact information</h4>

        <div class="col-6 mb-2">
            <label for="contact_name" class="form-label mt-2 mb-1">Name</label>
            <input name="contact_name" type="text" class="form-control" id="contact_name" placeholder="Ex: www.website.com" value="{{ old('contact_name', isset( $event->contact_name ) ? $event->contact_name : '') }}">
        </div>

        <div class="col-6 mb-2">
            <label for="contact_email" class="form-label mt-2 mb-1">Email</label>
            <input name="contact_email" type="text" class="form-control" id="contact_email" placeholder="Ex: www.website.com" value="{{ old('contact_email', isset( $event->contact_email ) ? $event->contact_email : '') }}">
        </div>

        <div class="col-6 mb-2">
            <label for="contact_phone" class="form-label mt-2 mb-1">Phone</label>
            <input name="contact_phone" type="text" class="form-control" id="contact_phone" value="{{ old('contact_phone', isset( $event->contact_phone ) ? $event->contact_phone : '') }}">
        </div>

        <div class="col-6 mb-2">
            <label for="contact_url" class="form-label mt-2 mb-1">URL</label>
            <input name="contact_url" type="text" class="form-control" id="contact_url" placeholder="Ex: www.website.com" value="{{ old('contact_url', isset( $event->contact_url ) ? $event->contact_url : '') }}">
        </div>

        <div class="col-6 mb-2">
            <label for="contact_phone" class="form-label mt-2 mb-1">Venue</label>
            <input name="contact_phone" type="text" class="form-control" id="contact_phone" value="{{ old('contact_phone', isset( $event->contact_phone ) ? $event->contact_phone : '') }}">
        </div>

        <div class="col-6 mb-2">
            <label for="contact_address" class="form-label mt-2 mb-1">Address</label>
            <input name="contact_address" type="text" class="form-control" id="contact_address" placeholder="Street Address, P.O. box" value="{{ old('contact_address', isset( $event->contact_address ) ? $event->contact_address : '') }}">
        </div>

        <div class="col-6 mb-2">
            <label for="contact_zip_code" class="form-label mt-2 mb-1">Zip Code</label>
            <input name="contact_zip_code" type="text" class="form-control" id="contact_zip_code" value="{{ old('contact_zip_code', isset( $event->contact_zip_code ) ? $event->contact_zip_code : '') }}">
        </div>

        <div class="my-2">
            <div id="map"></div>
        </div>

    </div>

      <div id="seo_information" class='row'>
        <h4 class="mb-1 mt-3">SEO</h4>

        <div class="col-6 mb-2">
            <label for="seo_title" class="form-label mt-2 mb-1">SEO title</label>
            <input name="seo_title" type="text" class="form-control" id="seo_title" placeholder="Type your event title here." value="{{ old('seo_title', isset( $event->seo_title ) ? $event->seo_title : '') }}">
        </div>

        <div class="col-6 mb-2">
            <label for="seo_page_name" class="form-label mt-2 mb-1">Page name</label>
            <input name="seo_page_name" type="text" class="form-control" id="seo_page_name" value="{{ old('seo_page_name', isset( $event->seo_page_name ) ? $event->seo_page_name : '') }}">
        </div>

        <div class="mb-2 col-12">
            <label class="form-check-label" for="seo_keywords">
                Keywords
            </label>
            <div class="form-control multi-search-filter" onclick="Array.from(this.children).find(n=>n.tagName==='INPUT').focus()">
                @isset($event->seo_keywords)
                    @foreach($event->seo_keywords as $value)
                        <div class="multi-search-item"><span>{{ $value }}</span><input name="seo_keywords[]" type="hidden" value="{{ $value }}"><div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
                    @endforeach
                @endisset
                <input type="text" id="seo_keywords" onkeydown="SEOmultiSearchKeyup(this)" placeholder="Type your keyword. Press comma on your keyboard to confirm.">
            </div>
            <div class="text-right"><p class="help-block text-right">Maximum 10 keywords</p></div>
        </div>

        <div class="col-12 mb-2">
            <label for="seo_description" class="form-label mt-2 mb-1">Description</label>
            <textarea name="seo_description" type="text" class="form-control" id="seo_description">{{ old('seo_description', isset( $event->seo_description ) ? $event->seo_description : '') }}</textarea>
        </div>
      </div>

      <div id="promotional_section" class='row'>
        <h4 class="mb-1 mt-3">Promotional Code</h4>
        <div class="col-12 mb-2">
            <label for="promotional_code" class="form-label mt-2 mb-1">Do you have a discount code? Type it here.</label>
            <input name="promotional_code" type="text" class="form-control" id="promotional_code" value="{{ old('promotional_code', isset( $event->promotional_code ) ? $event->promotional_code : '') }}">
        </div>
      </div>

      <div class="mb-2 col-12">
        <button type="submit" class="btn btn-primary">{{ isset($event) ?  'Update' : 'Create' }}</button>
      </div>

    </div>
</div>

    {{-- right content --}}
    <div class="col-4">
      <div class="row">
        <div class="col-12">
            Gallery (multiple images):<br>
            <input type="file" multiple name="image_gallery[]">
            @isset ($event->image_gallery)
                 @foreach ($event->image_gallery as $item)
                    <div class="multi-search-item"><span><img width="200px" src="{{ asset('/storage/' . $item) }}"></span>
                    <input name="image_gallery_prev[]" type="hidden" value="{{ $item }}">
                    <div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
                 @endforeach
            @endisset
        </div>
        <div class="col-12">
            Cover:<br>
            <input type="file" name="image_cover">
            @isset ($event->image_cover)
            <div class="multi-search-item"><span><img width="200px" src="{{ asset('/storage/' . $event->image_cover) }}"></span>
            <input name="image_cover_prev" type="hidden" value="{{ $event->image_cover }}">
            <div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
            @endisset
        </div>
        <div id="video_section" class='row'>
        <h4 class="mb-1 mt-3">Video</h4>
            <div class="col-12 mb-2">
                <label for="video_url" class="form-label mt-2 mb-1">Video URL</label>
                <input name="video_url" type="text" class="form-control" id="video_url" value="{{ old('video_url', isset( $event->video_url ) ? $event->video_url : '') }}">
            </div>
        </div>
      </div>
    </div>
  </form>

  @isset ($event)
    <form class="col" method="POST" action="{{ route('events.destroy', $event) }}">
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
