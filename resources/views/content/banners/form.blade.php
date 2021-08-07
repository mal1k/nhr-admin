@extends ('new-layout')

@section('title', isset($banner) ?  'Update '.$banner->title : 'Create banner')

@section('content')
<div class="my-3">
  <a class="text-decoration-none text-dark" href="{{ route('banners.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top: -3px;margin-right: -3px;"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
    Back
  </a>
</div>

<div id="mainForm">

  <form method="POST" enctype="multipart/form-data"
    @if ( isset($banner) )
        action="{{ route('banners.update', $banner) }}"
    @else
        action="{{ route('banners.store') }}"
    @endif
    class="row g-3 align-items-center">
    @csrf
    @isset($banner)
        @method('PUT')
    @endisset

    <div class="row">
    <div class="col-8">
      <div class="mb-2 col-12">
        <label for="caption" class="form-label mt-2 mb-1">Banner Type</label>
        <select name="banner_type" id="banner_type" class="form-select col">
            @php ( $bannerNames = array(0 => 'Leaderboard (728px x 90px)', 1 => 'Sponsored Links (320px x 100px)') )
                @foreach ($bannerNames as $num => $name)
                <span class="mr-3">
                    <option {{ old('banner_type', isset( $banner->banner_type ) && ( $banner->banner_type == $num )  ? 'selected' : '' ) }} value="{{ $num }}">{{ $name }}</option>
                </span>
                @endforeach
        </select>
      </div>
      <div class="mb-2 col-12">
        <label for="caption" class="form-label mt-2 mb-1">Caption</label>
        <input name="caption" type="text" class="form-control" id="caption" value="{{ old('caption', isset( $banner->caption ) ? $banner->caption : '') }}">
        @error('caption')
            <div class="alert alert-danger mb-0">{{ $message }}</div>
        @enderror
      </div>

      <div class="hidden" id="descriptionLines">
        <div class="row">
          <div class="mb-2 col-6">
              <label for="description_line" class="form-label mt-2 mb-1">Description line 1</label>
              <input name="description_line" type="text" class="form-control" id="description_line" value="{{ old('description_line', isset( $banner->description_line ) ? $banner->description_line : '') }}">
          </div>
          <div class="mb-2 col-6">
              <label for="description_line2" class="form-label mt-2 mb-1">Description line 2</label>
              <input name="description_line2" type="text" class="form-control" id="description_line2" value="{{ old('description_line2', isset( $banner->description_line2 ) ? $banner->description_line2 : '') }}">
          </div>
        </div>
      </div>

      <div id="basic_information" class='row'>
        <h4 class="mb-1 mt-3">Basic information</h4>

        <div class="mb-2 col">
            <label for="basic_account" class="form-label mt-2 mb-1">Account</label>

            <select name="basic_account" id="basic_account" class="form-select col">
            @foreach ( $users as $user )
                <option {{ isset($banner->basic_account) && $banner->basic_account == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
            </select>
        </div>

        <div class="mb-2 col">
            <label for="basic_status" class="form-label mt-2 mb-1">Status</label>
            <select name="basic_status" id="basic_status" class="form-select col">
            <option selected disabled>Choose...</option>
            <option @if ( isset( $banner ) )
                    @if ($banner->basic_status === 'active' )
                    selected
                    @endif
                @endif value="active">Active</option>
            <option @if ( isset( $banner ) )
                    @if ($banner->basic_status === 'suspended' )
                    selected
                    @endif
                @endif value="suspended">Suspended</option>
            <option @if ( isset( $banner ) )
                    @if ($banner->basic_status === 'pending' )
                    selected
                    @endif
                @endif value="pending">Pending</option>
            </select>
        </div>

        <div class="mb-2 col">
            <label for="basic_renewal_date" class="form-label mt-2 mb-1">Renewal date</label>
            <input name="basic_renewal_date" type="date" class="form-control" id="basic_renewal_date" placeholder="Change Expiration Date" value="{{ old('basic_renewal_date', isset( $banner->basic_renewal_date ) ? $banner->basic_renewal_date : '') }}">
        </div>
      </div>


      <div id="basic_information" class='row'>
        <h4 class="mb-1 mt-3">Banner Details</h4>
          <label for="banner_section" class="form-label mt-2 mb-1">Section</label>
          <div class="form-label">
            @php($months = array('General Pages', 'Listing', 'Deal', 'Event', 'Blog', 'Global Banner'))
              @foreach ($months as $num => $name)
              <span class="mr-3">
                <label for="banner_section_{{ $num }}"><input type="radio" id="banner_section_{{ $num }}" name="banner_section" {{ old('banner_section', (isset( $banner->banner_section ) && ( $banner->banner_section == $num )) || (empty($banner) && 0 == $num )  ? 'checked' : '') }} value="{{ $num }}">{{ $name }}</label>
              </span>
              @endforeach
          </div>
          <label class="form-label mt-2 mb-1">Category</label>
          <div class="form-label">

              @php( $generalCategory = array('All pages but item pages') )
              @php( $listingDealsCategory = array('Non-category search', 'Arts, Culture, and Heritage', 'Bookstores and Libraries', 'Breweries', 'Distilleries', 'Family Fun', 'Food and Drink', 'Golf', 'Gyms and Spas', 'Health', 'Hikes', 'Local Agriculture', 'Lodging', 'Nonprofits', 'Religion and Spirituality', 'Rock Climbing', 'Services', 'Shooting', 'Shopping', 'Skiing', 'Smoke Lounges', 'State Parks and Campgrounds', 'Swimming', 'Wineries' ) )
              @php( $eventCategory = array('Non-category search', '21+', 'Arts + Culture', '- Art', '- Fashion', '- Music', 'Car Show', 'Community + Nonprofit', '- Causes', 'Cuisine + Drink', '- Food', '- Tastings', 'Family Friendly', 'Farmers Market', 'Free', 'Fun Run', 'NH Rocks Events', 'Outdoors', 'Party', 'Wedding Expo') )
              @php( $blogCategory = array('Non-category search', 'Local Guides &amp; Itineraries', 'NH Rocks', 'Resources') )
              @php( $globalCategory = array('All pages') )

            {{-- general categories --}}
            <div id="generalCategoryBlock">
              <select id="generalCategory" name="general_category" class="input-dd-form-banner form-select">
                @foreach ($generalCategory as $num => $name)
                <span class="mr-3">
                    <option {{ old('general_category', isset( $banner->general_category ) && ( $banner->general_category == $num ) ? 'selected' : '') }} value="{{ $num }}">{{ $name }}</option>
                </span>
                @endforeach
              </select>
            </div>

            {{-- listing/deals categories --}}
            <div id="listingDealsCategoryBlock" class='hidden'>
              <select id="listingDealsCategory" name="listing_deals_category" class="input-dd-form-banner form-select">
                @foreach ($listingDealsCategory as $num => $name)
                <span class="mr-3">
                    <option {{ old('listing_deals_category', isset( $banner->listing_deals_category ) && ( $banner->listing_deals_category == $num ) ? 'selected' : '') }} value="{{ $num }}">{{ $name }}</option>
                </span>
                @endforeach
              </select>
            </div>

            {{-- event categories --}}
            <div id="eventCategoryBlock" class='hidden'>
              <select id="eventCategory" name="event_category" class="input-dd-form-banner form-select">
                @foreach ($eventCategory as $num => $name)
                <span class="mr-3">
                    <option {{ old('eventCategory', isset( $banner->event_category ) && ( $banner->event_category == $num ) ? 'selected' : '') }} value="{{ $num }}">{{ $name }}</option>
                </span>
                @endforeach
              </select>
            </div>

            {{-- blog categories --}}
            <div id="blogCategoryBlock" class='hidden'>
              <select id="blogCategory" name="blog_category" class="input-dd-form-banner form-select">
                @foreach ($blogCategory as $num => $name)
                <span class="mr-3">
                    <option {{ old('blog_category', isset( $banner->blog_category ) && ( $banner->blog_category == $num ) ? 'selected' : '') }} value="{{ $num }}">{{ $name }}</option>
                </span>
                @endforeach
              </select>
            </div>

            {{-- global categories --}}
            <div id="globalCategoryBlock" class='hidden'>
              <select id="globalCategory" name="global_category" class="input-dd-form-banner form-select">
                @foreach ($globalCategory as $num => $name)
                <span class="mr-3">
                    <option {{ old('global_category', isset( $banner->global_category ) && ( $banner->global_category == $num ) ? 'selected' : '') }} value="{{ $num }}">{{ $name }}</option>
                </span>
                @endforeach
              </select>
            </div>

          </div>

          <label for="banner_new_window" class="form-label mt-2 mb-1">Open in a new window</label>
          <div class="form-label">
            @php($months = array('No', 'Yes'))
              @foreach ($months as $num => $name)
              <span class="mr-3">
                <input type="radio" name="banner_new_window" {{ old('banner_new_window', (isset( $banner->banner_new_window ) && ( $banner->banner_new_window == $num )) || (empty($banner) && 1 == $num ) || (isset($banner) && $num != 1 )  ? 'checked' : '') }} value="{{ $num }}">{{ $name }}
              </span>
              @endforeach
          </div>

          <label for="banner_destinational_url" class="form-label mt-2 mb-1">Destination URL</label>
          <div class="form-label">
              <span class="mr-3">
                <input type="text" name="banner_destinational_url" class="form-control" value="{{old('banner_destinational_url', isset( $banner->banner_destinational_url ) ? $banner->banner_destinational_url : '') }}">
              </span>
          </div>

          <div id="displayURLblock">
            <label for="banner_display_url" class="form-label mt-2 mb-1">Display URL (optional)</label>
            <div class="form-label">
                <span class="mr-3">
                    <input type="text" name="banner_display_url" class="form-control" value="{{ old('banner_display_url', isset( $banner->banner_display_url ) ? $banner->banner_display_url : '') }}">
                </span>
            </div>
          </div>

        <div id="scriptBanner">
        <label class="form-label mt-2 mb-1">Script Banner</label>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="banner_script_checkbox" {{ old('banner_script_checkbox', isset( $banner->banner_script_checkbox ) ? 'checked' : '') }}> Show by Script Code
                </label>
            </div>

            <div class="form-label mt-2">
                <textarea name="banner_script_textarea" class="form-control" placeholder="Script">{{ isset( $banner->banner_script_textarea ) ? $banner->banner_script_textarea : '' }}</textarea>
            </div>
        </div>
      </div>

      <div id="promotional_section" class='row'>
        <h4 class="mb-1 mt-3">Promotional Code</h4>
        <div class="col-12 mb-2">
            <label for="promotional_code" class="form-label mt-2 mb-1">Do you have a discount code? Type it here.</label>
            <input name="promotional_code" type="text" class="form-control" id="promotional_code" value="{{ old('promotional_code', isset( $banner->promotional_code ) ? $banner->promotional_code : '') }}">
        </div>
      </div>

      <div class="mb-2 col-12">
        <button type="submit" class="btn btn-sm btn-primary">{{ isset($banner) ?  'Update' : 'Create' }}</button>
      </div>

    </div>

    {{-- right content --}}
    <div class="col-4">
        <div class="col-12" id='file_image'>
            <label for="image_logo" class="form-label mt-2 mb-1">Image:</label>
            <div>
                <!-- <input type="file" accept=".jpg, .jpeg, .png" id="image_logo" name="image_logo" class="choose me-2 mb-2"><br> -->
            </div>
            <!--begin::Image input-->
            <div class="image-input image-input-outline" data-kt-image-input="true" style="">
                <!--begin::Image preview wrapper-->
                <div class="image-input-wrapper w-125px h-125px" @isset ($banner->file_image) style="background-image: url({{ asset('/storage/' . $banner->file_image) }})" @endisset></div>
                <!--end::Image preview wrapper-->

                <!--begin::Edit button-->
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                data-kt-image-input-action="change"
                data-bs-toggle="tooltip"
                data-bs-dismiss="click"
                title="Change cover">
                    <i class="bi bi-pencil-fill fs-7"></i>

                    <!--begin::Inputs-->
                    <input type="file" name="file_image" accept=".png, .jpg, .jpeg, .swf, .gif" />
                    <input type="hidden" name="avatar_remove" />
                    @isset ($banner->file_image)
                    <input name="file_image_prev" id="file_image_prev" type="hidden" value="{{ $banner->file_image }}">
                    @endisset
                    <!--end::Inputs-->
                </label>
                <!--end::Edit button-->

                <!--begin::Cancel button-->
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                data-kt-image-input-action="cancel"
                data-bs-toggle="tooltip"
                data-bs-dismiss="click"
                title="Delete cover">
                    <i class="bi bi-x fs-2"></i>
                </span>
                <!--end::Cancel button-->

                <!--begin::Remove button-->
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                data-kt-image-input-action="remove"
                data-bs-toggle="tooltip"
                data-bs-dismiss="click"
                title="Remove cover" id="removeLogo">
                    <i class="bi bi-x fs-2"></i>
                </span>
                <!--end::Remove button-->
            </div>
            <!--end::Image input-->
        </div>
    </div>

  </form>

  @isset ($banner)
    <form class="col" method="POST" action="{{ route('banners.destroy', $banner) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger mb-3">Delete</button>
    </form>
  @endisset
</div>
</div>

<script>
    $('#removeLogo').click(function(){
        $('#file_image_prev').val('');
    })

    categoryChanger($('input[name=banner_section]:checked').val())
    selectChanger();

    $( "#banner_type" ).change(function() {
      selectChanger();
    });

    $('input[name="banner_section"]').change(function(event){
        cat = this.value
        categoryChanger(cat)
    })

    function categoryChanger(cat) {
        if (cat == 0) {
            $('#generalCategoryBlock').removeClass('hidden');
            $('#listingDealsCategoryBlock').addClass('hidden');
            $('#eventCategoryBlock').addClass('hidden');
            $('#blogCategoryBlock').addClass('hidden');
            $('#globalCategoryBlock').addClass('hidden');
        }
        if (cat == 1 || cat == 2) {
            $('#generalCategoryBlock').addClass('hidden');
            $('#listingDealsCategoryBlock').removeClass('hidden');
            $('#eventCategoryBlock').addClass('hidden');
            $('#blogCategoryBlock').addClass('hidden');
            $('#globalCategoryBlock').addClass('hidden');
        }
        if (cat == 3) {
            $('#generalCategoryBlock').addClass('hidden');
            $('#listingDealsCategoryBlock').addClass('hidden');
            $('#eventCategoryBlock').removeClass('hidden');
            $('#blogCategoryBlock').addClass('hidden');
            $('#globalCategoryBlock').addClass('hidden');
        }
        if (cat == 4) {
            $('#generalCategoryBlock').addClass('hidden');
            $('#listingDealsCategoryBlock').addClass('hidden');
            $('#eventCategoryBlock').addClass('hidden');
            $('#blogCategoryBlock').removeClass('hidden');
            $('#globalCategoryBlock').addClass('hidden');
        }
        if (cat == 5) {
            $('#generalCategoryBlock').addClass('hidden');
            $('#listingDealsCategoryBlock').addClass('hidden');
            $('#eventCategoryBlock').addClass('hidden');
            $('#blogCategoryBlock').addClass('hidden');
            $('#globalCategoryBlock').removeClass('hidden');
        }
    }

    function selectChanger() {
      if ( $('#banner_type').val() ) {
        $('#descriptionLines').removeClass('hidden');
        $('#file_image').addClass('hidden');
        $('#scriptBanner').addClass('hidden');
        $('#displayURLblock').removeClass('hidden');
      }
      if ( $('#banner_type').val() == 0 ) {
        $('#descriptionLines').addClass('hidden');
        $('#file_image').removeClass('hidden');
        $('#scriptBanner').removeClass('hidden');
        $('#displayURLblock').addClass('hidden');
      }
    }
</script>
@endsection
