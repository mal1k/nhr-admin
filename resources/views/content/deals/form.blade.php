@extends ('layout')

@section('title', isset($deal) ?  'Update '.$deal->title : 'Create deal')

@section('content')
<div class="my-3">
  <a class="text-decoration-none text-dark" href="{{ route('deals.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top: -3px;margin-right: -3px;"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
    Back
  </a>
</div>

<div id="mainForm">

  <form method="POST" enctype="multipart/form-data"
    @if ( isset($deal) )
        action="{{ route('deals.update', $deal) }}"
    @else
        action="{{ route('deals.store') }}"
    @endif
    class="row row-cols-lg-auto g-3 align-items-center">
    @csrf
    @isset($deal)
        @method('PUT')
    @endisset

    <div class="col-8 row">
    <div>
      <div class="mb-2 col">
        <label for="title" class="form-label mt-2 mb-1">Title</label>
        <input name="title" type="text" class="form-control" id="title" placeholder="Type your deal title here." value="{{ old('title', isset( $deal->title ) ? $deal->title : '') }}">
        @error('title')
            <div class="alert alert-danger mb-0">{{ $message }}</div>
        @enderror
      </div>

    <div id="basic_information" class='row'>
      <h4 class="mb-1 mt-3">Basic information</h4>

      <div class="mb-2 col-6">
        <label for="basic_account" class="form-label mt-2 mb-1">Account</label>

        <select name="basic_account" id="basic_account" class="form-select col">
          @foreach ( $users as $user )
            <option {{ isset($deal->basic_account) && $deal->basic_account == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-2 col-6">
        <label for="basic_listing" class="form-label mt-2 mb-1 text-danger">Associate with the listing</label>

        <select name="basic_listing" id="basic_listing" class="form-select col">
            <!-- @foreach ( $users as $user )
            <option {{ isset($deal->basic_listing) && $deal->basic_listing == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach -->
        </select>
      </div>

      <div class="form-label mb-2">
        <label for="basic_summary_desc">Summary Description</label>
        <textarea name="basic_summary_desc" class="form-control" placeholder="Brief description of the deal." id="basic_summary_desc" style="height: 100px">{{ old('basic_renewal_date', isset( $deal->basic_summary_desc ) ? $deal->basic_summary_desc : '') }}</textarea>
        <div class="text-right"><p class="help-block text-right">250 characters left</p></div>
      </div>

      <div class="form-label mb-2">
        <label for="basic_description">Description</label>
        <textarea name="basic_description" class="form-control" placeholder="Introduce the deal to the public in a clear and efficient way. Describe all features that make the establishment unique and a great option for clients." id="basic_description" style="height: 100px">{{ old('basic_description', isset( $deal->basic_description ) ? $deal->basic_description : '') }}</textarea>
      </div>

      <div class="form-label mb-2">
        <label for="basic_conditions">Conditions</label>
        <textarea name="basic_conditions" class="form-control" id="basic_conditions" style="height: 100px">Locals Deals are restricted to Locals Cards Members. All members must live in New Hampshire with a valid state-issued ID. A valid card or profile must be presented to redeem the deal. This deal is not valid for cash back, can only be used during the business' participation period, does not cover tax or gratuities. This deal can not be combined with other offers.</textarea>
      </div>

      <div class="mb-2 col-12">
        <label class="form-check-label" for="basic_keywords">
            Keywords for the search
        </label>

        <div class="form-control multi-search-filter" onclick="Array.from(this.children).find(n=>n.tagName==='INPUT').focus()">
            @isset($deal->basic_keywords)
                @foreach($deal->basic_keywords as $value)
                    <div class="multi-search-item"><span>{{ $value }}</span><input name="basic_keywords[]" type="hidden" value="{{ $value }}"><div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
                @endforeach
            @endisset
            <input type="text" id="keywords" onkeydown="multiSearchKeyup(this)" placeholder="Type your keyword. Press comma on your keyboard to confirm.">
        </div>
        <div class="text-right"><p class="help-block text-right">Maximum 10 keywords</p></div>

        <div class="col-12 mb-2">
            <label for="basic_mapinfo" class="form-label mt-2 mb-1">MAPINFO</label>
            <input name="basic_mapinfo" type="text" class="form-control" id="basic_mapinfo" value="{{ old('basic_mapinfo', isset( $deal->basic_mapinfo ) ? $deal->basic_mapinfo : '') }}">
        </div>
      </div>
    </div>

      <div id="deal_date" class='row'>
        <h4 class="mb-1 mt-3">Deal dates</h4>

        <div class="col-6 mb-2">
            <label for="deal_start_date" class="form-label mt-2 mb-1">Start date</label>
            <input name="deal_start_date" type="date" class="form-control" id="deal_start_date" value="{{ old('deal_start_date', isset( $deal->deal_start_date ) ? $deal->deal_start_date : '') }}">
        </div>

        <div class="col-6 mb-2">
            <label for="deal_end_date" class="form-label mt-2 mb-1">End date</label>
            <input name="deal_end_date" type="date" class="form-control" id="deal_end_date" value="{{ old('deal_end_date', isset( $deal->deal_end_date ) ? $deal->deal_end_date : '') }}">
        </div>
      </div>

      <div id="discount-information" class='row'>
        <h4 class="mb-1 mt-3">Discount information</h4>
          <div class="panel-body">
            <div class="form-group">
                <label class="form-label mt-2 mb-1">Discount Type</label>
                <br>
                <label class="radio-inline mr-3">
                  <input  type="radio" id="type_monetary" name="deal_type" value="monetary value" checked
                          onclick="showAmountType('$', 'not');">
                    Fixed Value Discount
                </label>

                <label class="radio-inline">
                    <input  type="radio" id="type_percentage" name="deal_type" value="percentage"
                            onclick="showAmountType('%', 'not');">
                    Percentage Discount
                </label>
            </div>

            <div class="form-group row mb-3 mt-2">
                <div class="col-sm-6 custom-col-6-fix">
                    <label for="real_price_int" class="mb-2">Item Value</label>
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" class="form-control" id="real_price_int" name="real_price_int"
                               value="" onkeyup="calculateDiscount();" maxlength="5">
                        <span class="input-group-addon"> &nbsp;.&nbsp; </span>
                        <input type="number" class="form-control" id="real_price_cent" name="real_price_cent"
                               value="" onkeyup="calculateDiscount();" maxlength="2">
                    </div>
                </div>

                <div class="col-sm-6 custom-col-6-fix">
                    <label for="deal_price_int"
                           id="dealPriceValueLabel" class="mb-2">Value with Discount</label>
                    <div class="input-group">
                        <span id="amount_monetary" class="input-group-addon">$</span>
                        <input type="number" class="form-control" id="deal_price_int" name="deal_price_int"
                               value=""
                               onkeyup="calculateDiscount();" maxlength="5">

                        <span id="label_deal_cent" class="input-group-addon"> &nbsp;.&nbsp; </span>
                        <input type="number" class="form-control" id="deal_price_cent" name="deal_price_cent"
                               value="" onkeyup="calculateDiscount();" maxlength="2">

                        <span class="input-group-addon" id="amount_percentage">  % </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <p class="help-block small">
                    Discount (Calculated)
                    <span id="discountAmount"> </span>
                    <span id="amountDiscountMessage"
                          class="alert-warning"></span>
                </p>
            </div>

            <div class="form-group">
                <label for="amount">How many deals would you like to offer</label>
                <p class="help-block small">Unlimited deals must be offered during life of deal.</p>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="hidden">
                        <input type="number" class="form-control" name="amount" id="amount" maxlength="10"
                               value="9999999999">
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>

      <div id="seo_information" class='row'>
        <h4 class="mb-1 mt-3">SEO</h4>

        <div class="col-6 mb-2">
            <label for="seo_title" class="form-label mt-2 mb-1">SEO title</label>
            <input name="seo_title" type="text" class="form-control" id="seo_title" placeholder="Type your deal title here." value="{{ old('seo_title', isset( $deal->seo_title ) ? $deal->seo_title : '') }}">
        </div>

        <div class="col-6 mb-2">
            <label for="seo_page_name" class="form-label mt-2 mb-1">Page name</label>
            <input name="seo_page_name" type="text" class="form-control" id="seo_page_name" value="{{ old('seo_page_name', isset( $deal->seo_page_name ) ? $deal->seo_page_name : '') }}">
        </div>

        <div class="mb-2 col-12">
            <label class="form-check-label" for="seo_keywords">
                Keywords
            </label>
            <div class="form-control multi-search-filter" onclick="Array.from(this.children).find(n=>n.tagName==='INPUT').focus()">
                @isset($deal->seo_keywords)
                    @foreach($deal->seo_keywords as $value)
                        <div class="multi-search-item"><span>{{ $value }}</span><input name="seo_keywords[]" type="hidden" value="{{ $value }}"><div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
                    @endforeach
                @endisset
                <input type="text" id="seo_keywords" onkeydown="SEOmultiSearchKeyup(this)" placeholder="Type your keyword. Press comma on your keyboard to confirm.">
            </div>
            <div class="text-right"><p class="help-block text-right">Maximum 10 keywords</p></div>
        </div>

        <div class="col-12 mb-2">
            <label for="seo_description" class="form-label mt-2 mb-1">Description</label>
            <textarea name="seo_description" type="text" class="form-control" id="seo_description">{{ old('seo_description', isset( $deal->seo_description ) ? $deal->seo_description : '') }}</textarea>
        </div>
      </div>

      <div class="mb-2 col-12">
        <button type="submit" class="btn btn-primary">{{ isset($deal) ?  'Update' : 'Create' }}</button>
      </div>

    </div>
</div>

    {{-- right content --}}
    <div class="col-4">
      <div class="row">
        <div class="col-12">
            Logo:<br>
            <input type="file" name="image_logo">
            @isset ($deal->image_logo)
              <div class="multi-search-item"><span><img src="{{ asset('/storage/' . $deal->image_logo) }}"></span>
              <input name="image_logo_prev" type="hidden" value="{{ $deal->image_logo }}">
              <div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
            @endisset
        </div>
        <div class="col-12">
            Cover:<br>
            <input type="file" name="image_cover">
            @isset ($deal->image_cover)
            <div class="multi-search-item"><span><img src="{{ asset('/storage/' . $deal->image_cover) }}"></span>
            <input name="image_cover_prev" type="hidden" value="{{ $deal->image_cover }}">
            <div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
            @endisset
        </div>
      </div>
    </div>
  </form>

  @isset ($deal)
    <form class="col" method="POST" action="{{ route('deals.destroy', $deal) }}">
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

    $(document).ready(function () {
      if(!$('#discount-information').length){
        return;
      }
      showAmountType('$', 'show');
      calculateDiscount();
    });

    function calculateDiscount() {
        var percentage = false;
        var realvalue = Number($('#real_price_int').val() + "." + $('#real_price_cent').val());
        var dealvalue = Number($('#deal_price_int').val() + "." + $('#deal_price_cent').val());

        if (document.getElementById("type_percentage").checked) {
            percentage = true;
        }

        if (realvalue != 'NaN' && dealvalue != 'NaN' ) {
            if (realvalue < 0) {
                realvalue = realvalue * (-1);
            }

            if (dealvalue < 0) {
                dealvalue = dealvalue * (-1);
            }

            if ((dealvalue > realvalue) && (percentage == false)) {
                $('#amountDiscountMessage').html("Please enter a minor value on Value with Discount field.");
                $('#discountAmount').html('');
            } else {
                $('#amountDiscountMessage').html('');

                if (percentage) {
                    discount = realvalue - ((dealvalue*realvalue)/100);
                } else {
                    discount = 100 - (dealvalue/realvalue)*100;
                }

                if (!isNaN(discount) && discount >= 0) {
                    if (discount > 100 && !percentage) {
                        discount = 100;
                    }

                    if (percentage) {
                        $('#discountAmount').html('$'+discount.toFixed(2));
                    } else {
                        $('#discountAmount').html(Math.round(discount)+'%');
                    }
                }
            }
        }
      };

      function showAmountType(type, show) {
        if (type == '%') {
            $("#dealPriceValueLabel").html("Percentage");
            document.getElementById('amount_monetary').innerHTML = ':';
            document.getElementById('amount_monetary').style.display = 'none';
            document.getElementById('amount_percentage').innerHTML = type;
            document.getElementById('amount_percentage').style.display = '';
            document.getElementById('label_deal_cent').style.display = 'none';
            document.getElementById('deal_price_cent').style.display = 'none';

            $('#discountAmount').html('');
            $('#amountDiscountMessage').html('');

            if (show == "not") {
                document.getElementById('deal_price_int').value = '';
                document.getElementById('deal_price_cent').value = '';
            }

            document.getElementById('deal_price_int').setAttribute('maxlength', 2);
        } else {
            $("#dealPriceValueLabel").html("Value with Discount");

            document.getElementById('amount_monetary').innerHTML = type;
            document.getElementById('amount_monetary').style.display = '';
            document.getElementById('amount_percentage').style.display = 'none';
            document.getElementById('label_deal_cent').style.display = '';
            document.getElementById('deal_price_cent').style.display = '';

            $('#discountAmount').html('');
            $('#amountDiscountMessage').html('');

            if (show == "not") {
                document.getElementById('deal_price_int').value = '';
            }

            document.getElementById('deal_price_int').setAttribute('maxlength', 5);
        }
      }

</script>
@endsection
