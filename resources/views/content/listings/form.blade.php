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
    @endisset
</div>

<div class="mapouter">
    <div class="gmap_canvas">

    {{--  <input type="text" id="mapInput">  --}}

    <div id="map"></div>
    </div>
    <style>.mapouter{position:relative;text-align:right;width:600px;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:600px;height:400px;}.gmap_iframe {width:600px!important;height:400px!important;}</style>
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
          $('#selectSubOption').val(mapQuery);
    })

    // add map
    $('#mapInput').focusout(function()
    {
        mapQuery = $('#mapInput').val();

        $('#map').html(`
            <iframe class="gmap_iframe"
                frameborder="0"
                scrolling="no"
                marginheight="0"
                marginwidth="0"
                src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=`+mapQuery+`&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
            </iframe>
        `);
    })
</script>
@endsection
