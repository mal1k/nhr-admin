@extends ('layout')

@section('title', 'Listing form')

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

  <form method="POST"
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
        <input name="title" type="text" class="form-control" id="title" placeholder="Type your listing title here.">
      </div>
      <div class="mb-2 col-4">
        <label for="level" class="form-label mt-2 mb-1">Listing level</label>
        <select name="level" id="level" class="form-select">
          <option selected disabled>Choose...</option>
          <option value="bronze">Bronze</option>
          <option value="silver">Silver</option>
          <option value="gold">Gold</option>
          <option value="ptatinum">Ptatinum</option>
        </select>
      </div>

    <div id="basic_information" class=''>
      <h4 class="mb-1 mt-3">Basic information</h4>

      <div class="mb-2 col-12">
        <label for="categories" class="form-label mt-2 mb-1">Categories</label>
        <select name="categories" class="form-select select" multiple>
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
        <label for="account" class="form-label mt-2 mb-1">Account</label>
        <select name="account" id="account" class="form-select col">
          <option selected disabled>Choose...</option>
          <option value="1">Business User1</option>
          <option value="2">Business User2</option>
          <option value="3">Business User3</option>
          <option value="4">Ptatinum</option>
        </select>
      </div>

      <div class="mb-2 col">
        <label for="status" class="form-label mt-2 mb-1">Status</label>
        <select name="status" id="status" class="form-select col">
          <option selected disabled>Choose...</option>
          <option value="active">Active</option>
          <option value="suspended">Suspended</option>
          <option value="pending">Pending</option>
        </select>
      </div>

      <div class="mb-2 col">
        <label for="renewal_date" class="form-label mt-2 mb-1">Renewal date</label>
        <input name="renewal_date" type="text" class="form-control" id="renewal_date" placeholder="Change Expiration Date">
      </div>

      <div class="mb-2 mt-3 col-12">
        <div class="form-check">
          <input name="disable_claim" class="form-check-input" type="checkbox" id="claim_disable">
          <label class="form-check-label" for="claim_disable">
            Disable claim feature for this listing
          </label>
        </div>
      </div>

      <div class="form-label mb-1">
        <label for="floatingTextarea2">Summary Description</label>
        <textarea name="summary_desc" class="form-control" placeholder="Brief description of the listing." id="floatingTextarea2" style="height: 100px"></textarea>
        <div class="text-right"><p class="help-block text-right">250 characters left</p></div>
      </div>

      <div class="mb-2 col-12">
        <label class="form-check-label" for="claim_disable">
            Keywords for the search
        </label>
        <div class="form-control multi-search-filter" onclick="Array.from(this.children).find(n=>n.tagName==='INPUT').focus()">
            <input name="keywords" type="text" id="keywords" onkeydown="multiSearchKeyup(this)" placeholder="Type your keyword. Press comma on your keyboard to confirm.">
        </div>
        <div class="text-right"><p class="help-block text-right">Maximum 10 keywords</p></div>
      </div>
    </div>

    <div id="contact_information" class='row'>
        <h4 class="mb-1 mt-3">Contact information</h4>

        <div class="col-5 mb-2">
            <label for="contact_url" class="form-label mt-2 mb-1">URL</label>
            <input name="contact_url" type="text" class="form-control" id="contact_url" placeholder="Ex: www.website.com">
        </div>

        <div class="col-12 mb-2">
            <label for="contact_address" class="form-label mt-2 mb-1">Address</label>
            <input name="contact_address" id="mapInput" type="text" class="form-control" id="contact_address" placeholder="Street Address, P.O. box">
        </div>

        <div class="col-6 mb-2">
            <label for="contact_address" class="form-label mt-2 mb-1">Address 2</label>
            <input name="contact_address" type="text" class="form-control" id="contact_address" placeholder="Apartment, suite, unit, building, floor, etc.">
        </div>

        <div class="col-6 mb-2">
            <label for="contact_zip_code" class="form-label mt-2 mb-1">Zip Code</label>
            <input name="contact_zip_code" type="text" class="form-control" id="contact_zip_code">
        </div>

        <div class="mb-2">
          <label for="status" class="form-label mt-2 mb-1">Region</label>
          <select name="status" id="status" class="form-select col">
            <option selected disabled>Choose...</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>
        </div>


        <div class="col-6 mb-2">
            <label for="contact_zip_code" class="form-label mt-2 mb-1">Zip Code</label>
            <input name="contact_zip_code" type="text" class="form-control" id="contact_zip_code">
        </div>

        <div id="map"></div>

      </div>

      <div class="mb-2 col-12">
        <button type="submit" class="btn btn-primary">Create</button>
      </div>

    </div>
    </div>

    <div class="col-4">
      {{-- images --}}
    </div>
  </form>




    {{-- <form method="POST"
                @if ( isset($user) )
                    action="{{ route('users.update', $user) }}"
                @else
                    action="{{ route('users.store') }}"
                @endif
                class="row row-cols-lg-auto g-3 align-items-center">
                @csrf
                @isset($user)
                    @method('PUT')
                @endisset
                <div class="col-12">
                    <label class="visually-hidden" for="inlineFormInputGroupUsername">Login</label>
                    <div class="input-group">
                    <div class="input-group-text">Login</div>
                    <input name="name" type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Login" value="{{ old('name', isset( $user ) ? $user->name : '') }}">
                    @error('name')
                        <div class="alert alert-danger mb-0">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="col-12">
                    <label class="visually-hidden" for="inlineFormInputGroupEmail">Email</label>
                    <div class="input-group">
                    <div class="input-group-text">Email</div>
                    <input name="email" type="text" class="form-control" id="inlineFormInputGroupEmail" placeholder="Email" value="{{ old('email', isset( $user ) ? $user->email : '') }}">
                    @error('email')
                        <div class="alert alert-danger mb-0">{{ $message }}</div>
                    @enderror
                    </div>
                </div>

                <div class="col-12">
                    <label class="visually-hidden" for="inlineFormSelectPref">Choose role</label>
                    <select name="level" class="form-select" id="selectSubOption">
                    <option @if ( isset( $user ) )
                                @if ($user->role === 'user' )
                                selected
                                @endif
                            @endif
                            @if (empty($user->role) )
                                selected
                            @endif
                            value="bronze">Bronze</option>

                    <option @if ( isset( $user ) )
                                @if ($user->role === 'moderator' )
                                selected
                                @endif
                            @endif
                            value="silver">Silver</option>

                    <option @if ( isset( $user ) )
                                @if ($user->role === 'admin' )
                                selected
                                @endif
                            @endif
                            value="gold">Gold</option>

                    <option @if ( isset( $user ) )
                            @if ($user->role === 'admin' )
                            selected
                            @endif
                        @endif
                        value="platinum">Platinum</option>
                    </select>
                </div>

                <div class="col">
                    <button type="submit" class="btn btn-primary">{{ isset( $user ) ? 'Update user' : 'Create user' }}</button>
                </div>
                </form>

                @isset ($user)
                <form class="col" method="POST" action="{{ route('users.destroy', $user) }}">
                    @csrf
                    @method('DELETE')
                    @if ( isset( $user ) )
                        @if ($user->role !== 'super-admin' )
                            <button type="submit" class="btn btn-danger mt-3">Delete</button>
                        @endif
                    @endif
    </form>
    @endisset --}}
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

    // add map
    $('#mapInput').focusout(function()
    {
        mapQuery = $('#mapInput').val();

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
    })

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
            const span = `<span>${text}</span>`;
            const close = `<div class="fa fa-close" onclick="this.parentNode.remove()"></div>`;
            item.innerHTML = span+close;
            return item;
        }

        $('#keywords').keyup(function() { str = $(this).val(); str = str.replace(/,/g,''); $(this).val(str); });
</script>
@endsection
