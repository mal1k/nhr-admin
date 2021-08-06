@extends ('new-layout')

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

<div class="row">
  <div class="col-8">
    <div class="card mb-5 mb-xl-8 p-5 py-1 mt-3">
        <div class="row">
        <div class="mb-2 col">
            <label for="title" class="form-label mt-2 mb-1">Title</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="Type your listing title here." value="{{ old('title', isset( $listing->title ) ? $listing->title : '') }}">
            @error('title')
                <div class="alert alert-danger mb-0">{{ $message }}</div>
            @enderror
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
        </div>
    </div>

    <div class="card mb-5 mb-xl-8 p-5 py-1">
        <div id="basic_information" class='row'>
        <h4 class="mb-1 mt-3">Basic information</h4>

        <div class="mb-2 col-12">
            <label for="basic_categories" class="form-label mt-2 mb-1">Categories</label>
            <select name="basic_categories[]" class="form-select select" multiple="multiple">
                @isset ($listing->basic_categories)
                @php
                if ( is_array($listing->basic_categories) ) {
                    $categories = $listing->basic_categories;
                } else {
                    $categories = json_decode($listing->basic_categories);
                }
                @endphp
                @endisset

                @isset ( $listingCategories )
                @foreach ( $listingCategories as $listingCategory )
                    <option
                    @if ( isset( $categories ) )
                    @if ( in_array($listingCategory->id, $categories) )
                        selected
                    @endif
                    @endif value="{{ $listingCategory->id }}">{{ $listingCategory->title }}</option>
                @endforeach
                @endisset
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

        <div class="form-label mb-1">
            <label for="basic_description">Description</label>
            <textarea name="basic_description" class="form-control" placeholder="Introduce the listing to the public in a clear and efficient way. Describe all features that make the establishment unique and a great option for clients." id="basic_description" style="height: 100px">{{ old('basic_description', isset( $listing->basic_description ) ? $listing->basic_description : '') }}</textarea>
        </div>

        <div class="mb-2 col-12">
            <label class="form-check-label" for="claim_disable">
                Keywords for the search
            </label>

            <div class="form-control multi-search-filter" onclick="Array.from(this.children).find(n=>n.tagName==='INPUT').focus()">
                @isset ($listing->basic_keywords)
                @php
                    if ( is_array($listing->basic_keywords) ) {
                        $basic_keywords = $listing->basic_keywords;
                    } else {
                        $basic_keywords = json_decode($listing->basic_keywords);
                    }
                @endphp
                @endisset


                @isset($basic_keywords)
                    @foreach($basic_keywords as $value)
                        <div class="multi-search-item multi-search-item alert alert-dismissible bg-light-primary p-2">
                            <span>{{ $value }}</span>
                            <input name="basic_keywords[]" type="hidden" value="{{ $value }}">
                            <button type="button" class="fa-close-icon position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                                <i class="bi bi-x fs-1 text-primary"></i>
                            </button>
                        </div>
                    @endforeach
                @endisset
                <input type="text" id="keywords" class="form-control" onkeydown="multiSearchKeyup(this)" placeholder="Type your keyword. Press comma on your keyboard to confirm.">
            </div>
            <div class="text-right"><p class="help-block text-right">Maximum 10 keywords</p></div>
        </div>
        </div>
    </div>

    <div class="card mb-5 mb-xl-8 p-5 py-1">
        <div id="contact_information" class='row'>
            <h4 class="mb-1 mt-3">Contact information</h4>

            <div class="col-6 mb-2">
                <label for="contact_email" class="form-label mt-2 mb-1">Email</label>
                <input name="contact_email" type="text" class="form-control" id="contact_email" placeholder="Ex: www.website.com" value="{{ old('contact_email', isset( $listing->contact_email ) ? $listing->contact_email : '') }}">
            </div>

            <div class="col-6 mb-2">
                <label for="contact_url" class="form-label mt-2 mb-1">URL</label>
                <input name="contact_url" type="text" class="form-control" id="contact_url" placeholder="Ex: www.website.com" value="{{ old('contact_url', isset( $listing->contact_url ) ? $listing->contact_url : '') }}">
            </div>

            <div class="col-6 mb-2">
                <label for="contact_phone" class="form-label mt-2 mb-1">Phone</label>
                <input name="contact_phone" type="text" class="form-control" id="contact_phone" value="{{ old('contact_phone', isset( $listing->contact_phone ) ? $listing->contact_phone : '') }}">
            </div>

            <div class="col-6">
                <div class="row">
                <span class="form-label mt-2 mb-1">Additional phone</span>
                <div class="col-4 mb-2">
                    <input name="contact_additional_label" type="text" class="form-control" id="contact_additional_label" placeholder="Label" value="{{ old('contact_additional_label', isset( $listing->contact_additional_label ) ? $listing->contact_additional_label : '') }}">
                </div>
                <div class="col-8 mb-2">
                    <input name="contact_additional_phone" type="text" class="form-control" id="contact_additional_phone" placeholder="Additional phone" value="{{ old('contact_additional_phone', isset( $listing->contact_additional_phone ) ? $listing->contact_additional_phone : '') }}">
                </div>
                </div>
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


            <div class="col-12 mb-2">
                <label for="contact_reference" class="form-label mt-2 mb-1">Reference</label>
                <textarea name="contact_reference" type="text" class="form-control" id="contact_reference" placeholder="Enter a landmark or point of reference for your listing's location.">{{ old('contact_reference', isset( $listing->contact_reference ) ? $listing->contact_reference : '') }}</textarea>
            </div>

            <div class="col-12 mb-2">
                <label for="contact_map_info" class="form-label mt-2 mb-1">MAPINFO</label>
                <input name="contact_map_info" type="text" class="form-control" id="contact_map_info" value="{{ old('contact_map_info', isset( $listing->contact_map_info ) ? $listing->contact_map_info : '') }}">
            </div>
        </div>
    </div>

    <div class="card mb-5 mb-xl-8 p-5 py-1">
        <div id="seo_information" class='row'>
            <h4 class="mb-1 mt-3">Social networks</h4>

            <div class="col-6 mb-2">
                <label for="social_facebook" class="form-label mt-2 mb-1">Facebook page</label>
                <input name="social_facebook" type="text" class="form-control" id="social_facebook" value="{{ old('social_facebook', isset( $listing->social_facebook ) ? $listing->social_facebook : '') }}">
            </div>

            <div class="col-6 mb-2">
                <label for="social_instagram" class="form-label mt-2 mb-1">Instagram</label>
                <input name="social_instagram" type="text" class="form-control" id="social_instagram" value="{{ old('social_instagram', isset( $listing->social_instagram ) ? $listing->social_instagram : '') }}">
            </div>

            <div class="col-6 mb-2">
                <label for="social_twitter" class="form-label mt-2 mb-1">Twitter</label>
                <input name="social_twitter" type="text" class="form-control" id="social_twitter" value="{{ old('social_twitter', isset( $listing->social_twitter ) ? $listing->social_twitter : '') }}">
            </div>
        </div>
    </div>

    <div class="card mb-5 mb-xl-8 p-5 py-1">
        <div id="features" class='row'>
        <h4 class="mb-1 mt-3">Features</h4>

        <div class="form-group" id="tour-features">
            <div class="row">
                <div class="col-md-12">
                    <div class="list-features" style="display:flex; flex-wrap: wrap; font-family:Roboto,FontAwesome,Arial,sans-serif; font-style:normal">
                        @isset ($listing->features)
                        @php
                            if ( is_array($listing->features) ) {
                                $features = $listing->features;
                            } else {
                                $features = json_decode($listing->features);
                            }
                        @endphp
                        @endisset

                        @isset ($features)
                        @foreach ( $features as $item )
                            @foreach ($item as $key => $value)
                            @if ($key == 'icon')
                                @php $feature_icons[] = $value; @endphp
                            @else
                                @php $feature_title[] = $value; @endphp
                            @endif
                            @endforeach
                        @endforeach
                        @php $n = 0; @endphp
                        @foreach ($feature_icons as $icon)
                            <div class="group-feature p-3" data-feature-id="{{ $n }}">
                                <input type="hidden" name="features[][icon]" class="input-feature-icon" value="{{ $icon }}">
                                <input type="hidden" name="features[][title]" class="input-feature-title" value="{{ $feature_title[$n] }}">
                                <div class="group-feature-icon">
                                    <i class="{{ $icon }}" aria-hidden="true"></i>
                                </div>
                                <a href="javascript:;" class="group-feature-link">{{ $feature_title[$n] }}</a>
                            </div>
                            @php $n += 1; @endphp
                        @endforeach
                        @endisset
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="feature_icon-selectized" class="form-label mt-2 mb-1">Icon</label>
                </div>
                <div class="col-md-4">
                    <label for="feature_title" class="form-label mt-2 mb-1">Name</label>
                </div>
            </div>
            <div class="row" data-feature-edit-id="">
                <div class="col-md-4 selectize">
                    <select name="feature_icon" id="feature_icon" class="form-control feature-icon " style="font-family:Roboto,FontAwesome,Arial,sans-serif;">
                        <option value="">--</option>
                        <option value="fa-glass">&#xf000; Glass</option>
                        <option value="fa-music">&#xf001; Music</option>
                        <option value="fa-search">&#xf002; Search</option>
                        <option value="fa-envelope-o">&#xf003; Envelope o</option>
                        <option value="fa-heart">&#xf004; Heart</option>
                        <option value="fa-star">&#xf005; Star</option>
                        <option value="fa-star-o">&#xf006; Star o</option>
                        <option value="fa-user">&#xf007; User</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="feature_title" id="feature_title" class="form-control " placeholder="Ex: Wifi">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary btn-save-feature" data-add>Add</button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-delete-feature" style="display:none">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="alert alert-danger mt-3" id="alert-features" style="display:none"></div>
        </div>
        </div>

        <div id="hours-block" class='row'>
        <h4 class="mb-1 mt-3">Hours</h4>

        <div class="form-group mb-3 mt-3">
            <div class="row">
            <div class="col-sm-6">
                <select class="form-control" id="weekday">
                <option value="" disabled selected>Select the day of the week</option>
                <option value="">--</option>
                <option value="0">Sunday</option>
                <option value="1">Monday</option>
                <option value="2">Tuesday</option>
                <option value="3">Wednesday</option>
                <option value="4">Thursday</option>
                <option value="5">Friday</option>
                <option value="6">Saturday</option>
                </select>
            </div>
            </div>
        </div>
        <div class="form-group mb-3">
            <div class="row">
            <div class="col-md-2">
                <label for="hours-start">Start Time</label>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control hours-start time-input " id="hours-start">
            </div>
            <div class="col-md-2">
                <label for="hours-end">End Time</label>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control hours-end time-input " id="hours-end" value="">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary btn-add-hours" full-width="true">Add</button>
            </div>
            </div>
            <input type="hidden" id="end-nextday">
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <div class="list-hours-work">
                @isset ($listing->hours_work)
                @php
                    if ( is_array($listing->hours_work) ) {
                        $hours_work = $listing->hours_work;
                    } else {
                        $hours_work = json_decode($listing->hours_work);
                    }
                @endphp
                @endisset

                @isset ($hours_work)
                    @foreach ( $hours_work as $item )
                        @foreach ($item as $key => $value)
                        @if ($key == 'weekday')
                            @php $weekday[] = $value; @endphp
                        @elseif ($key == 'hours_start')
                            @php $hours_start[] = $value; @endphp
                        @elseif ($key == 'hours_end')
                            @php $hours_end[] = $value; @endphp
                        @endif
                        @endforeach
                    @endforeach

                    @php $n = 0; @endphp
                    @foreach ($weekday as $day)
                        <div class="form-group row group-hours-work mb-2" data-hours-work-id="" data-feature-id="{{ $n }}">
                            <input type="hidden" name="hours_work[][weekday]" value="{{ $day }}">
                            <input type="hidden" name="hours_work[][hours_start]" value="{{ $hours_start[$n] }}">
                            <input type="hidden" name="hours_work[][hours_end]" value="{{ $hours_end[$n] }}">
                            <div class="col-md-3">
                                <input type="text" value="{{ jddayofweek($day-1, 1) }}" class="form-control" disabled="">
                            </div>
                            <div class="col-md-3">
                                <input type="text" value="{{ $hours_start[$n] }}" class="form-control" disabled="">
                            </div>
                            <div class="col-md-3">
                                <input type="text" value="{{ $hours_end[$n] }}" class="form-control" disabled="">
                            </div>
                            <div class="col-md-3">
                                <a href="javascript:;" class="btn btn-block btn-link remove-hours-work">Remove</a>
                            </div>
                        </div>
                        @php $n += 1; @endphp
                    @endforeach
                @endisset

                </div>
            </div>
        </div>
        <div class="alert alert-danger alert-hours-of-work" style="display: none;"></div>
        </div>
    </div>

    <div class="card mb-5 mb-xl-8 p-5 py-1">
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
                    @isset ($listing->seo_keywords)
                    @php
                        if ( is_array($listing->seo_keywords) ) {
                            $seo_keywords = $listing->seo_keywords;
                        } else {
                            $seo_keywords = json_decode($listing->seo_keywords);
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
                <textarea name="seo_description" type="text" class="form-control" id="seo_description">{{ old('seo_description', isset( $listing->seo_description ) ? $listing->seo_description : '') }}</textarea>
            </div>
        </div>
    </div>

    <div class="card mb-5 mb-xl-8 p-5 py-1">
        <div id="promotional_section" class='row'>
        <h4 class="mb-1 mt-3">Promotional Code</h4>
        <div class="col-12 mb-2">
            <label for="promotional_code" class="form-label mt-2 mb-1">Do you have a discount code? Type it here.</label>
            <input name="promotional_code" type="text" class="form-control" id="promotional_code" value="{{ old('promotional_code', isset( $listing->promotional_code ) ? $listing->promotional_code : '') }}">
        </div>
        </div>
    </div>

    <div class="card mb-5 mb-xl-8 p-5 py-1">
        <div id="video_section" class='row'>
        <h4 class="mb-1 mt-3">Video</h4>
        <div class="col-12 mb-2">
            <label for="video_url" class="form-label mt-2 mb-1">Video URL</label>
            <input name="video_url" type="text" class="form-control" id="video_url" value="{{ old('video_url', isset( $listing->video_url ) ? $listing->video_url : '') }}">
        </div>
        <div class="col-12 mb-2">
            <label for="video_desc" class="form-label mt-2 mb-1">Video description</label>
            <input name="video_desc" type="text" class="form-control" id="video_desc" value="{{ old('video_desc', isset( $listing->video_desc ) ? $listing->video_desc : '') }}">
        </div>
        </div>
    </div>

    <div class="card mb-5 mb-xl-8 p-5 py-1">
        <div id="attach_file_section" class='row'>
        <h4 class="mb-1 mt-3">Attach Additional File</h4>
        <div class="col-12 mb-2">
            @isset ( $listing->attach_file )
                <div class="multi-search-item"><span>File attached: {{ $listing->attach_file }}</span>
                <input name="attach_file_prev" type="hidden" value="{{ $listing->attach_file }}">
                <div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
            @endisset
            <label for="attach_file" class="form-label mt-2 mb-1">Choose file</label>
            <input name="attach_file" type="file" class="form-control" id="attach_file" value="{{ old('attach_file', isset( $listing->attach_file ) ? $listing->attach_file : '') }}">
        </div>
        <div class="col-12 mb-2">
            <label for="attach_desc" class="form-label mt-2 mb-1"></label>
            <input name="attach_desc" type="text" class="form-control" id="attach_desc" placeholder="This is how the link to download your file will be shown." value="{{ old('attach_desc', isset( $listing->attach_desc ) ? $listing->attach_desc : '') }}">
        </div>
        </div>
    </div>

    <div class="card mb-5 mb-xl-8 p-5 py-1">
        <div id="listing_badges_section" class='row listing_badges'>
        <div class="mb-1 mt-3 listing_badges__title panel-heading">Listing Badges
            <div class="pull-right"><small><a class="text-info" href="#" target="_blank">Want to change your badges? Click here.</a></small></div>
        </div>
        <div class="panel-body">
            <div class="col-12 mb-2">
                <img src="{{asset('img/sitemgr_photo.png')}}">
            </div>
            <div>
                <input name="badges_checkbox" class="form-check-input" type="checkbox" id="badges_checkbox" {{ isset( $listing->badges_checkbox ) ? 'checked' : '' }}>
                <label class="form-check-label" for="badges_checkbox">
                Local Supporter
                </label>
            </div>
        </div>
        </div>
    </div>

    <div class="mb-2 col-12">
        <button type="submit" class="btn btn-sm btn-primary">{{ isset($listing) ?  'Update' : 'Create' }}</button>
    </div>
  </div>

  <div class="col-4">
      <div class="row">
        <div class="col-12">
            <label for="image_logo" class="form-label mt-2 mb-1">Logo:</label>
            <div>
                <!-- <input type="file" accept=".jpg, .jpeg, .png" id="image_logo" name="image_logo" class="choose me-2 mb-2"><br> -->
            </div>
            <!--begin::Image input-->
            <div class="image-input image-input-outline" data-kt-image-input="true" style="">
                <!--begin::Image preview wrapper-->
                <div class="image-input-wrapper w-125px h-125px" @isset ($listing->image_logo) style="background-image: url({{ asset('/storage/' . $listing->image_logo) }})" @endisset></div>
                <!--end::Image preview wrapper-->

                <!--begin::Edit button-->
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                data-kt-image-input-action="change"
                data-bs-toggle="tooltip"
                data-bs-dismiss="click"
                title="Change cover">
                    <i class="bi bi-pencil-fill fs-7"></i>

                    <!--begin::Inputs-->
                    <input type="file" name="image_logo" accept=".png, .jpg, .jpeg" />
                    <input type="hidden" name="avatar_remove" />
                    @isset ($listing->image_logo)
                    <input name="image_logo_prev" id="image_logo_prev" type="hidden" value="{{ $listing->image_logo }}">
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
        <div class="col-12">
            <label for="image_cover" class="form-label mt-2 mb-1">Cover:</label>
            <div>
                <!-- <input type="file" accept=".jpg, .jpeg, .png" id="image_cover" name="image_cover" class="choose me-2 mb-2"><br> -->
            </div>
            <!--begin::Image input-->
            <div class="image-input image-input-outline" data-kt-image-input="true" style="">
                <!--begin::Image preview wrapper-->
                <div class="image-input-wrapper w-125px h-125px" @isset ($listing->image_cover) style="background-image: url({{ asset('/storage/' . $listing->image_cover) }})" @endisset></div>
                <!--end::Image preview wrapper-->

                <!--begin::Edit button-->
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                data-kt-image-input-action="change"
                data-bs-toggle="tooltip"
                data-bs-dismiss="click"
                title="Change cover">
                    <i class="bi bi-pencil-fill fs-7"></i>

                    <!--begin::Inputs-->
                    <input type="file" name="image_cover" accept=".png, .jpg, .jpeg" />
                    <input type="hidden" name="avatar_remove" />
                    @isset ($listing->image_cover)
                    <input name="image_cover_prev" id="image_cover_prev" type="hidden" value="{{ $listing->image_cover }}">
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
                title="Remove cover" id="removeCover">
                    <i class="bi bi-x fs-2"></i>
                </span>
                <!--end::Remove button-->
            </div>
            <!--end::Image input-->
        </div>
        <div class="col-12">
            <label for="image_gallery[]" class="form-label mt-2 mb-1">Gallery (multiple images):</label>
            <div>
                <input type="file" accept=".jpg, .jpeg, .png" id="image_gallery[]" name="image_gallery[]" class="choose me-2 mb-2" multiple><br>
            </div>
            @isset ($listing->image_gallery)
            @php
                if ( is_array($listing->image_gallery) ) {
                    $image_gallery = $listing->image_gallery;
                } else {
                    $image_gallery = json_decode($listing->image_gallery);
                }
            @endphp
            @endisset

            @isset ($image_gallery)
                 @foreach ($image_gallery as $item)
                    <!--begin::Alert-->
                    <div class="w-250px alert alert-dismissible bg-light-primary border border-primary d-flex flex-column flex-sm-row mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column">
                            <!--begin::Content-->
                            <input name="image_gallery_prev[]" type="hidden" value="{{ $item }}">
                            <img width="205px" src="{{ asset('/storage/' . $item) }}">
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Close-->
                        <button style="height: calc(-0.5em + (1.5rem + 2px));" type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                            <i class="bi bi-x fs-1 text-primary"></i>
                        </button>
                        <!--end::Close-->
                    </div>
                    <!--end::Alert-->
                 @endforeach
            @endisset
        </div>
      </div>
  </div>
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
    $('#removeCover').click(function(){
        $('#image_cover_prev').val('');
    })
    $('#removeLogo').click(function(){
        $('#image_logo_prev').val('');
    })

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
        item.setAttribute("class", "multi-search-item multi-search-item alert alert-dismissible bg-light-primary p-2");
        const span = `<span>${text}</span><input name="basic_keywords[]" type="hidden" value="${text}">`;
        const close = `<button type="button" class="fa-close-icon position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                            <i class="bi bi-x fs-1 text-primary"></i>
                        </button>`;
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
        item.setAttribute("class", "multi-search-item ");
        const span = `<span>${text}</span><input name="seo_keywords[]" type="hidden" value="${text}">`;
        const close = `<div class="fa fa-close" onclick="this.parentNode.remove()"></div>`;
        item.innerHTML = span+close;
        return item;
    }
    $('#seo_keywords').keyup(function() { str = $(this).val(); str = str.replace(/,/g,''); $(this).val(str); });

    $(document).ready(function () {
        if (!$('#features').length){
            return;
        }

        const $btn = $('.btn-save-feature');
        const $btnDel = $('.btn-delete-feature');
        const $featureList = $('.list-features');
        const $featureIcon = $('#feature_icon');
        const $featureText = $('#feature_title');
        const $featureTextInput = $('#feature_title');
        const errorText = "Feature Icon or Name can't be empty.";
        let textAdd = 'Add';
        let textSave = 'Save';
        let activeFeature = "0";

        function addFeature(icon, text) {
            let featureTempl = '<div class="group-feature p-3" data-feature-id="">' +
                    '<input type="hidden" name="features[][icon]" class="input-feature-icon" value="'+ icon +'">' +
                    '<input type="hidden" name="features[][title]" class="input-feature-title" value="' + text +'">' +
                    '<div class="group-feature-icon">' +
                        '<i class="' + icon + '" aria-hidden="true"></i></div>' +
                    '<a href="javascript:;" class="group-feature-link">' + text +'</a></div>';
            $featureList.append(featureTempl);
            $featureIcon.find('option').prop('selected', false);
            $featureText.val('');
        }
        function addFeatureIndex() {
            const $features = $featureList.find('.group-feature');
                $features.each(function(){
                    let index = $(this).index();
                    $(this).attr('data-feature-id', index);
                })
        }
        function saveFeature(icon, text) {
           let $feature = $('.group-feature[data-feature-id='+ activeFeature+']');
           $feature.find('i').attr('class', icon);
           $feature.find('.input-feature-icon').val(icon);
           $feature.find('.group-feature-link').text(text);
           $feature.find('.input-feature-title').val(text);
        }
        function chooseFeature() {
            let $feature = $('.group-feature[data-feature-id='+ activeFeature+']');
            let iconVal = $feature.find('.input-feature-icon').val();
            let textVal = $feature.find('.input-feature-title').val();

            $featureIcon.find('option[value='+iconVal+']' ).prop('selected', true);
            $featureText.val(textVal);
        }
        function triggerBtn() {
          if($btn.text() != textSave) {
            $btn.text(textSave);
            $btnDel.css('display','block');
          } else {
              $featureIcon.find('option').prop('selected', false);
              $featureText.val('');
              $btn.text(textAdd);
              $btnDel.css('display','none');
          }
        }

        $(document).on('click','.btn-save-feature', function(){
            let iconVal = $featureIcon.val();
            let textVal = $featureText.val();

            if (iconVal != "" & textVal!= "") {
              if($btn.text() != textSave){
                      addFeature(iconVal, textVal);
                      addFeatureIndex();
              } else {
                  saveFeature(iconVal, textVal);
                  triggerBtn();
              }
            } else {
              $('#alert-features').html(errorText).css('display', 'block');
              setTimeout(function(){
                  $('#alert-features').slideUp();
              }, 2000);
            }
        })
        $(document).on('click', '.group-feature-link', function(){
            activeFeature = $(this).closest('.group-feature').attr('data-feature-id');
            chooseFeature();
            triggerBtn();
        })
        $(document).on('click', '.btn-delete-feature', function(){
            $('.group-feature[data-feature-id='+ activeFeature+']').remove();
            addFeatureIndex()
            triggerBtn();
        })
    });
    $(document).ready(function () {
        if (!$('#hours-block').length){
            return;
        }
        $('.time-input').each(function(){
            $(this).timepicker()
        });

        const $weekday = $('#weekday');
        const $startHour = $('#hours-start');
        const $endHour = $('#hours-end');
        const $hoursWorkList = $('.list-hours-work');
        const $hoursOfWork = $('.alert-hours-of-work');
        const errorText1 = "The week day field can not be empty.";
        const errorText2 = "The hours field can not be empty.";

        function addHours(dayVal, day, start, end) {
            let hourTempl = '<div class="form-group row group-hours-work mb-2" data-hours-work-id>' +
                    '<input type="hidden" name="hours_work[][weekday]" value=' + dayVal + '>' +
                    '<input type="hidden" name="hours_work[][hours_start]" value=' + start + '>' +
                    '<input type="hidden" name="hours_work[][hours_end]" value=' + end + '>' +

                    '<div class="col-md-3"><input type="text" value=' + day + ' class="form-control" disabled=""></div>' +
                    '<div class="col-md-3"><input type="text" value=' + start + ' class="form-control" disabled=""></div>' +
                    '<div class="col-md-3"><input type="text" value=' + end + ' class="form-control" disabled=""></div>' +
                    '<div class="col-md-3"><a href="javascript:;" class="btn btn-block btn-link remove-hours-work">Remove</a></div></div>'
            $hoursWorkList.append(hourTempl);
            $weekday.find('option').prop('selected', false);
            $startHour.val('');
            $endHour.val('');
        }
        function addHoursIndex() {
            const $workGroup = $hoursWorkList.find('.group-hours-work');
                $workGroup.each(function(){
                    let index = $(this).index();
                    $(this).attr('data-feature-id', index);
                })
        }
        $(document).on('click', '.btn-add-hours', function(){
            let dayVal = $weekday.find('option:selected').val();
            let day = $weekday.find('option:selected').text();
            let start = $startHour.val();
            let end = $endHour.val();

            if (dayVal === "") {
              $hoursOfWork.html(errorText1).css('display', 'block');
              setTimeout(function(){
                 $hoursOfWork.slideUp();
              }, 2000);
            } else if (start === "" || end === "") {
                $hoursOfWork.html(errorText2).css('display', 'block');
                setTimeout(function(){
                    $hoursOfWork.slideUp();
                }, 2000);
            } else {
                addHours(dayVal, day, start, end);
                addHoursIndex();
            }
        })
        $(document).on('click', '.remove-hours-work', function(){
            $(this).closest('.group-hours-work').remove();
        })
    });

</script>
@endsection
