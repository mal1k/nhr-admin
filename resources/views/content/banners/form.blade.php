@extends ('layout')

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
        <label for="caption" class="form-label mt-2 mb-1">Caption</label>
        <input name="caption" type="text" class="form-control" id="caption" value="{{ old('caption', isset( $banner->caption ) ? $banner->caption : '') }}">
        @error('caption')
            <div class="alert alert-danger mb-0">{{ $message }}</div>
        @enderror
      </div>

      <div class="row" id="descriptionLines">
        <div class="mb-2 col-6">
            <label for="description_line" class="form-label mt-2 mb-1">Description line 1</label>
            <input name="description_line" type="text" class="form-control" id="description_line" value="{{ old('description_line', isset( $banner->description_line ) ? $banner->description_line : '') }}">
        </div>
        <div class="mb-2 col-6">
            <label for="description_line2" class="form-label mt-2 mb-1">Description line 2</label>
            <input name="description_line2" type="text" class="form-control" id="description_line2" value="{{ old('description_line2', isset( $banner->description_line2 ) ? $banner->description_line2 : '') }}">
        </div>
      </div>

      <div id="basic_information" class='row'>
        <h4 class="mb-1 mt-3">Basic information</h4>

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
      </div>


      <div id="basic_information" class='row'>
        <h4 class="mb-1 mt-3">Banner Details</h4>

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
      </div>

      <div class="mb-2 col-12">
        <button type="submit" class="btn btn-primary">{{ isset($banner) ?  'Update' : 'Create' }}</button>
      </div>

    </div>

    {{-- right content --}}
    <div class="col-4">
      <div class="row">
        <div class="col-12">
            File:<br>
            <input type="file" name="file_image">
            @isset ($banner->file_image)
              <div class="multi-search-item"><span><img src="{{ asset('/storage/' . $banner->file_image) }}"></span>
              <input name="file_image_prev" type="hidden" value="{{ $banner->file_image }}">
              <div class="fa fa-close" onclick="this.parentNode.remove()"></div></div>
            @endisset
        </div>
      </div>
    </div>
  </div>
  </form>

  @isset ($banner)
    <form class="col" method="POST" action="{{ route('banners.destroy', $banner) }}">
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
      if ($('#type_monetary').is(':checked')){
        showAmountType('$', 'show');
      } else{
        showAmountType('%', 'show');
      }

      calculateDiscount();
    });

    function calculateDiscount() {
        var percentage = false;
        var realvalue = Number($('#real_price_int').val() + "." + $('#real_price_cent').val());
        var bannervalue = Number($('#banner_price_int').val() + "." + $('#banner_price_cent').val());

        if (document.getElementById("type_percentage").checked) {
            percentage = true;
        }

        if (realvalue != 'NaN' && bannervalue != 'NaN' ) {
            if (realvalue < 0) {
                realvalue = realvalue * (-1);
            }

            if (bannervalue < 0) {
                bannervalue = bannervalue * (-1);
            }

            if ((bannervalue > realvalue) && (percentage == false)) {
                $('#amountDiscountMessage').html("Please enter a minor value on Value with Discount field.");
                $('#discountAmount').html('');
            } else {
                $('#amountDiscountMessage').html('');

                if (percentage) {
                    discount = realvalue - ((bannervalue*realvalue)/100);
                } else {
                    discount = 100 - (bannervalue/realvalue)*100;
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
            $("#bannerPriceValueLabel").html("Percentage");
            document.getElementById('amount_monetary').innerHTML = ':';
            document.getElementById('amount_monetary').style.display = 'none';
            document.getElementById('amount_percentage').innerHTML = type;
            document.getElementById('amount_percentage').style.display = '';
            document.getElementById('label_banner_cent').style.display = 'none';
            document.getElementById('banner_price_cent').style.display = 'none';

            $('#discountAmount').html('');
            $('#amountDiscountMessage').html('');

            if (show == "not") {
                document.getElementById('banner_price_int').value = '';
                document.getElementById('banner_price_cent').value = '';
            }

            document.getElementById('banner_price_int').setAttribute('maxlength', 2);
        } else {
            $("#bannerPriceValueLabel").html("Value with Discount");

            document.getElementById('amount_monetary').innerHTML = type;
            document.getElementById('amount_monetary').style.display = '';
            document.getElementById('amount_percentage').style.display = 'none';
            document.getElementById('label_banner_cent').style.display = '';
            document.getElementById('banner_price_cent').style.display = '';

            $('#discountAmount').html('');
            $('#amountDiscountMessage').html('');

            if (show == "not") {
                document.getElementById('banner_price_int').value = '';
            }

            document.getElementById('banner_price_int').setAttribute('maxlength', 5);
        }
      }

</script>
@endsection
