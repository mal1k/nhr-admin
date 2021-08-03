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
        <label for="basic_categories" class="form-label mt-2 mb-1">Categories</label>
        <select name="basic_categories[]" class="form-select select" multiple="multiple">
            @isset ($event->basic_categories)
            @php
            if ( is_array($event->basic_categories) ) {
                $categories = $event->basic_categories;
            } else {
                $categories = json_decode($event->basic_categories);
            }
            @endphp
            @endisset

            @isset ( $eventCategories )
              @foreach ( $eventCategories as $eventCategory )
                <option
                @if ( isset( $categories ) )
                  @if ( in_array($eventCategory->id, $categories) )
                    selected
                  @endif
                @endif value="{{ $eventCategory->id }}">{{ $eventCategory->title }}</option>
              @endforeach
            @endisset
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
            @isset ($event->image_gallery)
            @php
                if ( is_array($event->basic_keywords) ) {
                    $basic_keywords = $event->basic_keywords;
                } else {
                    $basic_keywords = json_decode($event->basic_keywords);
                }
            @endphp
            @endisset

            @isset($basic_keywords)
                @foreach($basic_keywords as $value)
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

    <div id="event_block" class='row'>
        <h4 class="mb-1 mt-3">Event Date</h4>

        <div class="col-6 mb-2">
            <label for="event_start_date" class="form-label mt-2 mb-1">Start date</label>
            <input name="event_start_date" type="date" class="form-control" id="event_start_date" placeholder="Type your event title here." value="{{ old('event_start_date', isset( $event->event_start_date ) ? $event->event_start_date : '') }}">
        </div>

        <div class="col-6 mb-2" id="event_end_date_toggle">
            <label for="event_end_date" class="form-label mt-2 mb-1">End date</label>
            <input name="event_end_date" type="date" class="form-control" id="event_end_date" value="{{ old('event_end_date', isset( $event->event_end_date ) ? $event->event_end_date : '') }}">
        </div>

        <label for="seo_page_name" class="form-label mt-2 mb-1">Start time</label>
        <div class="col-5 mb-2">
            @isset ( $event->event_start_time )
            @php
                if ( is_array($event->event_start_time) ) {
                    $event_start_time = $event->event_start_time;
                } else {
                    $event_start_time = json_decode($event->event_start_time, true);
                }
            @endphp
            @endisset

            <select id="event_start_time[hours]" name="event_start_time[hours]" class="form-control ">
                {{ $last= 12 }}
                {{ $now = 1 }}

                @for ($i = $now; $i <= $last; $i++)
                    <option value="{{ $i }}" {{ old('event_start_time[hours]', isset( $event_start_time['hours'] ) && ( $event_start_time['hours'] == $i ) ? 'selected' : '') }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col-5 mb-2">
            <select id="event_start_time[minutes]" name="event_start_time[minutes]" class="form-control ">
                {{ $last= 55 }}
                {{ $now = 00 }}

                @for ($i = $now; $i <= $last; $i+=5)
                    <option value="{{ $i }}" {{ old('event_start_time[minutes]', isset( $event_start_time['minutes'] ) && ( $event_start_time['minutes'] == $i ) ? 'selected' : '') }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col-2">
            <input type="radio" id="event_start_time[picker]"
            name="event_start_time[picker]" value="AM" {{ old('event_start_time[picker]', isset( $event_start_time['picker'] ) && ( $event_start_time['picker'] == 'AM' ) ? 'checked' : '') }}>
            <label for="event_start_time[picker]">AM</label>

            <input type="radio" id="event_start_time[picker]"
            name="event_start_time[picker]" value="PM" {{ old('event_start_time[picker]', isset( $event_start_time['picker'] ) && ( $event_start_time['picker'] == 'PM' ) ? 'checked' : '') }}>
            <label for="event_start_time[picker]">PM</label>
        </div>

        <label for="seo_page_name" class="form-label mt-2 mb-1">End time</label>
        <div class="col-5 mb-2">

            <select id="event_end_time[hours]" name="event_end_time[hours]" class="form-control ">
                @isset ( $event->event_end_time )
                @php
                    if ( is_array($event->event_end_time) ) {
                        $event_end_time = $event->event_end_time;
                    } else {
                        $event_end_time = json_decode($event->event_end_time, true);
                    }
                @endphp
                @endisset
                {{ $last= 12 }}
                {{ $now = 1 }}

                @for ($i = $now; $i <=  $last; $i++)
                    <option value="{{ $i }}" {{ old('event_end_time[hours]', isset( $event_end_time['hours'] ) && ( $event_end_time['hours'] == $i ) ? 'selected' : '') }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col-5 mb-2">
            <select id="event_end_time[minutes]" name="event_end_time[minutes]" class="form-control ">
                {{ $last= 55 }}
                {{ $now = 00 }}

                @for ($i = $now; $i <= $last; $i+=5)
                    <option value="{{ $i }}" {{ old('event_end_time[minutes]', isset( $event_end_time['minutes'] ) && ( $event_end_time['minutes'] == $i ) ? 'selected' : '') }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col-2">
            <input type="radio" id="event_end_time[picker]"
            name="event_end_time[picker]" value="AM" {{ old('event_end_time[picker]', isset( $event_end_time['picker'] ) && ( $event_end_time['picker'] == 'AM' ) ? 'checked' : '') }}>
            <label for="event_end_time[picker]">AM</label>

            <input type="radio" id="event_end_time[picker]"
            name="event_end_time[picker]" value="PM" {{ old('event_end_time[picker]', isset( $event_end_time['picker'] ) && ( $event_end_time['picker'] == 'PM' ) ? 'checked' : '') }}>
            <label for="event_end_time[picker]">PM</label>
        </div>

        <div class="col-12">
          <label>
            <input type="checkbox" id="event_recurring_event"
                name="event_recurring_event" {{ old('event_recurring_event', isset( $event->event_recurring_event ) ? 'checked' : '') }}> Recurring Event
          </label>
        </div>

      <div id="toggleRecurringEvent">
        <div class="col-12 mt-2">
            <span class="">Repeat</span>
                <select name="event_recurring_repeat" id="event_recurring_repeat" class="form-select">
                    <option value="daily" {{ old('event_recurring_repeat', isset( $event->event_recurring_repeat ) && ( $event->event_recurring_repeat == 'daily' ) ? 'selected' : '' ) }}>Daily</option>
                    <option value="weekly" {{ old('event_recurring_repeat', isset( $event->event_recurring_repeat ) && ( $event->event_recurring_repeat == 'weekly' ) ? 'selected' : '' ) }}>Weekly</option>
                    <option value="monthly" {{ old('event_recurring_repeat', isset( $event->event_recurring_repeat ) && ( $event->event_recurring_repeat == 'monthly' ) ? 'selected' : '' ) }}>Monthly</option>
                    <option value="yearly" {{ old('event_recurring_repeat', isset( $event->event_recurring_repeat ) && ( $event->event_recurring_repeat == 'yearly' ) ? 'selected' : '' ) }}>Yearly</option>
                </select>
        </div>
      <div id="event_recurring_every" class="hidden">
        <div class="col-12 mt-2" id="event_repeat_every_day" class='hidden'>
        <label>
          <input type="radio" id="event_recurring_every_radio" name="event_recurring_every[radio]" value="every_day" onclick="enableUntil('2');" {{ old('event_recurring_every[radio]', isset( $event->event_recurring_every['radio'] ) && ( $event->event_recurring_every['radio'] == 'every_day' ) ? 'checked' : '') }}>
          <b>Every day:</b>
          <div class="input-group">
            <input type="number" id="day" name="event_recurring_every[days]" class="form-control" value="{{ old('event_recurring_every[days]', isset( $event->event_recurring_every['days'] ) ? $event->event_recurring_every['days'] : '') }}" maxlength="2">
            <span class="input-group-addon customized-addon">
              <span>of the Month</span>
              @php $months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'); @endphp
              <select id="event_recurring_every_month" name="event_recurring_every[month]" class="input" style="">
                  @foreach ($months as $num => $name)
                    <option {{ old('event_recurring_every[month]', isset( $event->event_recurring_every['month'] ) && ( $event->event_recurring_every['month'] == $num ) ? 'selected' : '') }} value="{{ $num }}">{{ $name }}</option>
                  @endforeach
              </select>
            </span>
          </div>
        </label>
        </div>

      <div class="mt-2">
          <label>
              <input type="radio" id="event_recurring_every_every" name="event_recurring_every[radio]" value="every" onclick="enableUntil('2');" {{ old('event_recurring_every[radio]', isset( $event->event_recurring_every['radio'] ) && ( $event->event_recurring_every['radio'] == 'every' ) ? 'checked' : '') }}>
              <b>Every:</b>
          </label>
          <div>

            @php $last= 6; @endphp
            @php $now = 0; @endphp

            @isset ($event->event_recurring_dayofweek)
            @php
                if ( is_array($event->event_recurring_dayofweek) ) {
                    $event_recurring_dayofweek = $event->event_recurring_dayofweek;
                } else {
                    $event_recurring_dayofweek = json_decode($event->event_recurring_dayofweek);
                }
            @endphp
            @endisset

            @for ($i = $now; $i <=  $last; $i++)
                <input type="checkbox" @isset($event_recurring_dayofweek) @if(in_array($i, $event_recurring_dayofweek)) checked @endif @endisset name="event_recurring_dayofweek[]" value="{{ $i }}">{{ jddayofweek($i-1, 2) }}</label>
            @endfor
          <div id="listOfRepeat">
          Week:
            @php $listOfRepeat = array('First', 'Second', 'Third', 'Fourth', 'Last'); @endphp
            @foreach ($listOfRepeat as $item)
              <input type="checkbox" @isset($event_recurring_dayofweek) @if(in_array($item, $event_recurring_dayofweek)) checked @endif @endisset name="event_recurring_dayofweek[]" value="{{ $item }}">{{ $item }}</label>
            @endforeach

            <select id="event_recurring_every_once_month" name="event_recurring_every[every_month]" class="input" style="">
                @foreach ($months as $num => $name)
                  <option {{ old('event_recurring_every[every_month]', isset( $event->event_recurring_every['every_month'] ) && ( $event->event_recurring_every['every_month'] == $num ) ? 'selected' : '') }} value="{{ $num }}">{{ $name }}</option>
                @endforeach
            </select>

          </div>
        </div>
      </div>
    </div>

      {{--  global  --}}
      <div class="col-12 mt-2" id="dayofreccuring">
        <b>Ends on:</b>
        <div class="form-horizontal">
          <label>
            <input type="radio" id="event_recurring_ends_on_until" name="event_recurring_ends_on" value="until" onclick="enableUntil('2');" {{ old('event_recurring_ends_on', isset( $event->event_recurring_ends_on ) && ( $event->event_recurring_ends_on == 'until' ) ? 'checked' : '') }}>
            Until
          </label>
          <input class="form-control date-input" type="date" name="event_recurring_ends_on_until" id="event_recurring_ends_on_until" value="{{ old('event_recurring_ends_on', isset( $event->event_recurring_ends_on_until ) ? $event->event_recurring_ends_on_until : '') }}">
        </div>
        <div class="row form-group">
          <div class="radio col-xs-12">
              <label>
                <input type="radio" id="event_recurring_ends_on_never" name="event_recurring_ends_on" value="never" onclick="enableUntil('1');" {{ old('event_recurring_ends_on', isset( $event->event_recurring_ends_on ) && ( $event->event_recurring_ends_on == 'never' ) ? 'checked' : '') }}>
                Never
              </label>
          </div>
        </div>
      </div>
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
                @isset ($event->seo_keywords)
                @php
                    if ( is_array($event->seo_keywords) ) {
                        $seo_keywords = $event->seo_keywords;
                    } else {
                        $seo_keywords = json_decode($event->seo_keywords);
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
            @php
                if ( is_array($event->image_gallery) ) {
                    $image_gallery = $event->image_gallery;
                } else {
                    $image_gallery = json_decode($event->image_gallery);
                }
            @endphp
            @endisset

            @isset ($image_gallery)
                 @foreach ($image_gallery as $item)
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


    toggleRecurring();
    selectChanger();

    $('#event_recurring_event').click(function() {
      toggleRecurring();
    });

    function toggleRecurring() {
      if ($('#event_recurring_event').is(':checked')){
        $("#toggleRecurringEvent").removeClass('hidden');
        $("#event_end_date_toggle").addClass('hidden');
      } else {
        $("#toggleRecurringEvent").addClass('hidden');
        $("#event_end_date_toggle").removeClass('hidden');
      }
    }

    $( "#event_recurring_repeat" ).change(function() {
      selectChanger();
    });

    function selectChanger() {
      if ( $('#event_recurring_repeat').val() == 'daily' ) {
        $('#event_recurring_every').addClass('hidden');
        $('#event_recurring_every_once_month').addClass('hidden');
        $('#event_repeat_every_day').addClass('hidden');
        $('#event_recurring_every_every').addClass('hidden');
        $('#listOfRepeat').addClass('hidden');
      }
      if ( $('#event_recurring_repeat').val() == 'weekly' ) {
        $('#event_recurring_every').removeClass('hidden');
        $('#event_recurring_every_once_month').addClass('hidden');
        $('#event_repeat_every_day').addClass('hidden');
        $('#event_recurring_every_every').addClass('hidden');
        $('#listOfRepeat').addClass('hidden');
      }
      if ( $('#event_recurring_repeat').val() == 'monthly' ) {
        $('#event_recurring_every').removeClass('hidden');
        $('#event_recurring_every_once_month').addClass('hidden');
        $('#event_repeat_every_day').removeClass('hidden');
        $('#event_recurring_every_every').removeClass('hidden');
        $('#listOfRepeat').removeClass('hidden');
        $('#event_recurring_every_month').addClass('hidden');
      }
      if ( $('#event_recurring_repeat').val() == 'yearly' ) {
        $('#event_recurring_every').removeClass('hidden');
        $('#event_recurring_every_once_month').removeClass('hidden');
        $('#event_repeat_every_day').removeClass('hidden');
        $('#event_recurring_every_every').removeClass('hidden');
        $('#listOfRepeat').removeClass('hidden');
        $('#event_recurring_every_month').removeClass('hidden');
      }
    }

</script>
@endsection
