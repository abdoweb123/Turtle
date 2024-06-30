@extends('Client.Layout.index')

@section('title')
  @lang('trans.checkout')
@stop


@section('style')
  <style>
    .alert-danger{
      display: none;
    }
    .errors{
      background-color: #cf2e2e;
      color: white;
    }

    .toggle-password{
      float:{{lang()=='ar'? 'left' : 'right'}}
    }

  </style>
@stop



@section('content')
  <!------------ header ------------>
  @include('Client.Layout.header')
  <!------------ header end ------------>

  <!-- start Checkout -->
  <section class="py-3 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="d-flex justify-content-between mx-2">
            <h4 class="fw-bold"> @lang('trans.checkout')</h4>
            <div>
              <a href="{{route('Client.home')}}" class="text-decoration-none link-info text-danger">
                <i class="fa-solid fa-house"></i>
                <span class="mx-1">@lang('trans.home')</span>
              </a>
              <span class="mx-1">/</span>
              <span class="mx-1">@lang('trans.checkout')</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end Checkout -->

  <div class="errors mx-6">
    @if($errors->any())
      <div class="alert alert-error">
        @foreach($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif
  </div>

  {{--
  <section class="py-5">
    <div class="container">
      <div class="alert alert-primary green-alert rounded-0" role="alert">
        <div class="d-flex align-items-center">
          <i class="fa-solid fa-paper-plane fs-5 text-white"></i>
          <span class="text-white mx-2">Customer matched zone "UAE"</span>
        </div>
      </div>
    </div>
  </section>
  --}}


  <!-- start Billing details -->
  <section class="py-5">
    <div class="container">
      <form action="{{route('Client.saveCheckout')}}" method="post" id="checkoutForm">
        @csrf
        <div class="row">
          <div class="col-lg-6">
            <div class="row">
                @if(shippingType() !='2')
                <h4 class="text-danger fw-semibold">@lang('trans.shipping_address')</h4>
                @endif
                <!-- To register if not authenticated -->
                @if(!auth('client')->check())
                <h6 class="text-danger fw-semibold">@lang('trans.enter_data_to_register_follow_up_your_order')</h6>
                <div class="col-sm-12 mb-3">
                  <label for="" class="text-secondary">@lang('trans.first_name') <span class="red-label">*</span>
                  </label>
                  <input type="text" class="form-control rounded-0" name="first_name" id="" value="{{old('first_name_shipping',addressShipping()?addressShipping()->first_name:'')}}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                </div>
                <div class="col-sm-12 mb-3">
                  <label for="" class="text-secondary">@lang('trans.last_name') <span class="red-label">*</span>
                  </label>
                  <input type="text" class="form-control rounded-0" name="last_name" id="" value="{{old('last_name_shipping',addressShipping()?addressShipping()->last_name:'')}}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                </div>
                <div class="col-sm-12 mb-3">
                  <label for="" class="text-secondary">@lang('trans.email') <span class="red-label">*</span>
                  </label>
                  <input type="email" class="form-control rounded-0" name="email" id="" value="{{old('email')}}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                </div>
                <div class="col-sm-12 mb-3">
                  <label for="" class="text-secondary">@lang('trans.password') <span class="red-label">*</span>
                  </label>
                  <input type="password" class="form-control rounded-0" name="password" id="" value="{{old('password')}}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                  <i class="toggle-password fa fa-fw fa-eye mx-3"></i>
                </div>
              @endif


                <!-- within mainCountry (Bahrain) -->
                @if(shippingType()=='1')
                    <div class="col-sm-12 mb-3">
                      <label for="" class="text-secondary">@lang('trans.country')<span class="red-label">*</span>
                      </label>
                      <select class="rounded-0 form-select" disabled>
                          <option value="{{mainCountry()->id}}" >{{ mainCountry()['title_'.lang()] }}</option>
                      </select>
                      <input type="hidden" name="country_id" value="{{mainCountry()->id}}">
                    </div>

                    <div class="col-sm-12 col-md-6 mb-3">
                      <label for="" class="text-secondary">@lang('trans.region')
                      </label>
                      <select class="rounded-0 form-select" name="region_id" id="region_id" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                        <option value="">@lang('trans.select_region')</option>
{{--                        @foreach(mainCountry()->regions as $region)--}}
{{--                          <option value="{{ old('region_id', (addressShipping() && addressShipping()->region_id ? addressShipping()->region_id : ($region->id ?? ''))) }}" {{ old('region_id', (addressShipping() && addressShipping()->region_id ? addressShipping()->region_id == $region->id : false)) ? 'selected' : '' }}>--}}
{{--                            {{ addressShipping() && addressShipping()->region_id ? addressShipping()->region['title_'.lang()] : ($region['title_'.lang()] ?? '') }}--}}
{{--                          </option>--}}
                        @php
                          $selectedRegionId = old('region_id', addressShipping() ? (addressShipping()->region_id ?? '') : '');
                        @endphp
                        @foreach(mainCountry()->regions as $region)
                          <option value="{{ $region->id }}" {{ $region->id == $selectedRegionId ? 'selected' : '' }} >
                            {{ $region['title_'.lang()] }}
                          </option>
                        @endforeach
{{--                        @endforeach--}}
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-6 mb-3">
                      <label for="" class="text-secondary">@lang('trans.block')
                      </label>
                      <input type="text" class="form-control rounded-0" name="block" value="{{ addressShipping() ? addressShipping()->block : old('block', '') }}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                    </div>
                    <div class="col-sm-12 col-md-6 mb-3">
                      <label for="" class="text-secondary">@lang('trans.road')
                      </label>
                      <input type="text" class="form-control rounded-0" name="road" value="{{ addressShipping() ? addressShipping()->road : old('road', '') }}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                    </div>
                    <div class="col-sm-12 col-md-6 mb-3">
                      <label for="" class="text-secondary">@lang('trans.building_no')
                      </label>
                      <input type="text" class="form-control rounded-0" name="building_no" value="{{ addressShipping() ? addressShipping()->building_no : old('building_no', '') }}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                    </div>
                    <div class="col-sm-12 col-md-6 mb-3">
                      <label for="" class="text-secondary">@lang('trans.floor_no')
                      </label>
                      <input type="text" class="form-control rounded-0" name="floor_no" value="{{ addressShipping() ? addressShipping()->floor_no : old('floor_no', '') }}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                    </div>
                    <div class="col-sm-12 col-md-6 mb-3">
                      <label for="" class="text-secondary">@lang('trans.apartment')
                      </label>
                      <input type="text" class="form-control rounded-0" name="apartment" value="{{ addressShipping() ? addressShipping()->apartment : old('apartment', '') }}" oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                    </div>
                    <div class="col-sm-12 col-md-6 mb-3">
                      <label for="" class="text-secondary">@lang('trans.apartmentType')
                      </label>
                      <input type="text" class="form-control rounded-0" name="apartmentType" value="{{ addressShipping() ? addressShipping()->apartmentType : old('apartmentType', '') }}" oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                    </div>
                    <div class="col-sm-12 col-md-6 mb-3">
                      <label for="" class="text-secondary">@lang('trans.additional_directions')
                      </label>
                      <input type="text" class="form-control rounded-0" name="additional_directions" value="{{ addressShipping() ? addressShipping()->additional_directions : old('additional_directions', '') }}">
                    </div>
                <!-- international shipping -->
                @elseif(shippingType()=='3')
                    <div class="col-sm-12 mb-3">
                      <label for="" class="text-secondary">@lang('trans.country')<span class="red-label">*</span>
                      </label>
                      <select class="rounded-0 form-select" name="country_id" id="country_id" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                        <option value="">@lang('trans.select_country')</option>
                        @foreach(Countries() as $country)
                          @if($country->id != mainCountry()->id)
                          <option value="{{$country->id}}" {{ old('country_id', addressShipping() ? addressShipping()->country_id : '') == $country->id ? 'selected' : '' }}>{{ $country['title_'.lang()] }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>

                      <div class="col-sm-12 mb-3">
                        <label for="" class="text-secondary">@lang('trans.city')   <span class="red-label">*</span>
                        </label>
                        <input type="text" class="form-control rounded-0" name="city" id="" value="{{ addressShipping() ? addressShipping()->city : old('city', '') }}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                      </div>
                      <div class="col-sm-12 mb-3">
                        <label for="" class="text-secondary">@lang('trans.state')  (@lang('trans.optional'))
                        </label>
                        <input type="text" class="form-control rounded-0" name="state" id="" value="{{ addressShipping() ? addressShipping()->state : old('state', '') }}">
                      </div>
                      <div class="col-sm-12 mb-3">
                        <label for="" class="text-secondary">@lang('trans.street_address') <span class="red-label">*</span>
                        </label>
                        <input type="text" class="form-control rounded-0 mb-3" name="address1" id="" placeholder="@lang('trans.address1')" value="{{old('address1',addressShipping()?addressShipping()->address1:'')}}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                        <input type="text" class="form-control rounded-0" name="address2" id="" placeholder="@lang('trans.address2')" value="{{old('address1',addressShipping()?addressShipping()->address2:'')}}">
                      </div>

                @endif





              <div class="col-sm-12 mb-3">
{{--                <label for="" class="text-secondary mb-2">@lang('trans.gift_wrap')  (@lang('trans.optional'))--}}
{{--                </label>--}}
{{--                <div class="form-check">--}}
{{--                  <input class="form-check-input mx-1 {{lang()=='ar'? 'float-end' : 'float-start'}}" type="radio" name="gift_color" value="white" id="flexRadioDefault1"  {{ old('gift_color', addressShipping() ? addressShipping()->gift_color : '') == 'white' ? 'checked' : '' }}>--}}
{{--                  <label class="form-check-label text-secondary" for="flexRadioDefault1">@lang('trans.white')</label>--}}
{{--                </div>--}}
{{--                <div class="form-check">--}}
{{--                  <input class="form-check-input mx-1 {{lang()=='ar'? 'float-end' : 'float-start'}}" type="radio" name="gift_color" value="green" id="flexRadioDefault2" {{ old('gift_color', addressShipping() ? addressShipping()->gift_color : '') == 'green' ? 'checked' : '' }}>--}}
{{--                  <label class="form-check-label text-secondary" for="flexRadioDefault2">@lang('trans.green')</label>--}}
{{--                </div>--}}
              </div>
              <div class="col-sm-12 mb-3">
                <label for="" class="text-secondary">@lang('trans.gift_comment') (@lang('trans.optional'))
                </label>
                <textarea name="gift_comment" class="form-control rounded-0" id="" cols="30" rows="5">{{old('gift_comment', addressShipping() ? addressShipping()->gift_comment : '')}}</textarea>
              </div>



            </div>
          </div>
          <div class="col-lg-6 overflow-x-hidden">
            <img src="{{asset('assets_client/images/book-spiral.png')}}" alt="" class="img-fluid" />
            </h4>
            <div class="card bg-gry border-0 rounded-0">
              <div class="card-body">
                <h4 class="text-danger fw-semibold text-center bg-gry mt-3" id="order_review_heading">@lang('trans.your_order')
                  <div class="col-md-12">
                    <div class="row bg-white mt-3 d-flex justify-content-center mx-auto">
                      <div class="d-flex justify-content-between mt-3">
                        <h6 class="text-black fw-semibold">@lang('trans.product')</h6>
                        <h6 class="text-black fw-semibold">@lang('trans.subtotal')</h6>
                      </div>
                      <div class="border-bottom"></div>

                      @foreach($cart as $cartItem)
                        <div class="d-flex justify-content-between align-items-center mt-3">
                          <div class="d-flex flex-column justify-content-start">
                            <img src="{{asset($cartItem->product->Gallery()->whereNull('color_id')->first()->image  ?? Setting('not_found_img'))}}" alt="" width="100">
                            <div>
                              <h6 class="text-secondary fs-7">{{$cartItem->product['title_'.lang()]}} - {{$cartItem->color['title_'.lang()]}}, {{$cartItem->size->title.$cartItem->size->parent->title}} × {{$cartItem->quantity}}</h6>
                            </div>
                          </div>
                          <h6 class="text-secondary"
                          <span class="fw-semibold" id="subtotalItem_{{$cartItem->id}}">
                                {{$cartItem->product->RealPriceWithQuantity($cartItem->quantity)}}
                          </span>
                          <span class="fw-semibold">
                              {{Country()->currancy_code}}
                        </span>
                          </h6>
                        </div>
                        <div class="border-bottom"></div>
                      @endforeach

                      <div class="d-flex justify-content-between mt-3">
                        <h6 class="text-black fw-semibold">@lang('trans.sub_total')
                        </h6>
                        <h6 class="text-black fw-semibold">
                         <span id="subtotal_cart">
                            {{format_number($subTotalCart)}}
                        </span>
                          <span>
                            {{Country()->currancy_code}}
                        </span>
                        </h6>
                      </div>
                      <div class="border-bottom"></div>
                      <div class="d-flex justify-content-between mt-3">
                        <h6 class="text-black fw-semibold">@lang('trans.vat')
                        </h6>
                        <h6 class="text-black fw-semibold">
                         <span id="vat">
                            {{format_number($vat)}}
                        </span>
                          <span>
                            {{Country()->currancy_code}}
                        </span>
                        </h6>
                      </div>
                      <div class="border-bottom"></div>
                      <div class="d-flex justify-content-between mt-3 align-items-center">
                        <h6 class="text-black fw-semibold">@lang('trans.shipping')</h6>
                        <div class="d-flex flex-column justify-content-end align-items-end" style="padding:0 0 7px 0;; display: {{shippingType()=='1'? 'block !important;' :'none !important;'}}">
                          <div class="form-check">
                            <input class="" type="radio" id="flexRadioDefault1" checked>
                            <label class="form-check-label text-secondary" for="flexRadioDefault1" style="color:black !important; font-size: 16px">
                              @lang('trans.shipping') @lang('trans.within') {{mainCountry()['title_'.lang()]}}
                            </label>
                          </div>
                        </div>
                        <div class="d-flex flex-column justify-content-end align-items-end" style="padding:0 0 7px 0;; display: {{shippingType()=='2'? 'block !important;':'none !important;'}}">
                          <div class="form-check" style="padding:0 0 7px 0;; display: {{shippingType()=='2'? 'block':'none'}}">
                            <input class="" type="radio" name="shipping_type" id="flexRadioDefault2" checked>
                            <label class="form-check-label text-secondary" for="flexRadioDefault2" style="color:black !important; font-size: 16px">
                              @lang('trans.pickup_store')
                            </label>
                          </div>
                        </div>
                        <div class="d-flex flex-column justify-content-end align-items-end" style="padding:0 0 7px 0;; display: {{shippingType()=='3'? 'block !important;' :'none !important;'}}">
                          <div class="form-check">
                            <input class="" type="radio" id="flexRadioDefault1" checked>
                            <label class="form-check-label text-secondary" for="flexRadioDefault1" style="color:black !important; font-size: 16px">
                              @lang('trans.international_shipping')
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between align-items-center" style="display: {{shippingType()=='1' ? 'flex !important;':'none !important;'}}">
                        <h6 class="text-black fw-semibold">@lang('trans.shipping_cost')</h6>
                        <div class="d-flex flex-column justify-content-end align-items-end">
                          <div class="form-check">
                            <label class="form-check-label text-secondary" for="flexRadioDefault1" style="color:black !important; font-size: 16px">
                              {{format_number(setting('internal_shipping_cost')*Country()->currancy_value) }} {{Country()->currancy_code}}
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between align-items-center" id="international_shipping" style="display: {{shippingType()=='3' && auth('client')->user()->address ? 'flex !important;':'none !important;'}}">
                        <h6 class="text-black fw-semibold">@lang('trans.shipping_cost')</h6>
                        <div class="d-flex flex-column justify-content-end align-items-end">
                          <div class="form-check" id="international_shipping">
                            <label class="form-check-label text-secondary" for="flexRadioDefault1" style="color:black !important; font-size: 16px">
                              <span id="international_shipping_cost">{{ format_number($totalWeightPrice['totalCartWeightPrice'] * Country()->currancy_value) }}</span>
                              <span>{{Country()->currancy_code}}</span>
                            </label>
                          </div>
                        </div>
                      </div>


                      <div class="border-bottom"></div>
                      <div class="d-flex justify-content-between mt-3">
                        <h6 class="text-black fw-semibold">@lang('trans.total')</h6>
                        <h6 class="text-black fw-semibold">
                        <span id="total">
                        {{ format_number($subTotalCart + $vat + (shippingType() == '1' ? setting('internal_shipping_cost')*Country()->currancy_value : (shippingType() == '3' ?  ($totalWeightPrice['totalCartWeightPrice'] != null ? $totalWeightPrice['totalCartWeightPrice'] *Country()->currancy_value : 0) : 0))) }}
                        </span>
                          <span>
                            {{Country()->currancy_code}}
                        </span>
                        </h6>
                      </div>
                      <div class="border-bottom"></div>
                      <div class="mt-3 {{lang()=='ar'? 'text-end' : 'text-start'}}">
                        <h6 class="text-black fw-semibold ">@lang('trans.payment')</h6>
                        <div class="{{--d-flex justify-content-between align-items-center--}}">
                            @foreach($payments as $index => $payment)
                                <h6 class="form-check fs-7 p-0">
                                  <input class="{{--form-check-input--}}" type="radio" name="payment_id" value="{{$payment->id}}" id="flexRadioDefault-{{$payment->id}}" {{$index == 0 ? 'checked' : ''}}>
                                  <label class="form-check-label mt-1 mx-1" for="flexRadioDefault-{{$payment->id}}">
                                    <img src="{{ asset($payment->image) }}" alt="payment" class="mb-2" style="max-width: 50px;margin: 0px 5px">
                                    {{ $payment->title() }}
                                  </label>
                                </h6>
                            @endforeach
                        </div>
                      </div>
                      <div class="border-bottom"></div>

                      <div class="border-bottom"></div>
                      <p class="fs-7 mt-3 text-start">@lang('trans.privacy_policy_order_desc')
                        <a href="{{route('Client.privacy')}}" class="text-decoration-none fw-semibold">@lang('trans.privacy_policy')</a>.
                      </p>
                      <div class="border-bottom"></div>
                      <div class="d-flex justify-content-between mt-3">
                        <div class="form-check fs-7">
                          <input class="" type="checkbox" name="terms_conditions" value="1" {{old('terms_conditions') == 1 ? 'checked' : ''}} required>
                          <label class="form-check-label mt-1" for="flexCheckDefault">
                            @lang('trans.have_read_website_terms')
                            <a href="{{route('Client.terms')}}" class="text-decoration-none">@lang('trans.Terms and Conditions') </a>
                          </label>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-checkout rounded-0 mt-4 col-12" id="submitForm">@lang("trans.proceed_to_pay")</button>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
  <!-- end Billing details -->

@stop




@section('script')

  <script>
    const checkbox = document.getElementById('checkbox');
    const hiddenForm = document.getElementById('hiddenForm');

    checkbox.addEventListener('change', function() {
      if (this.checked) {
        hiddenForm.style.display = 'block';
      } else {
        hiddenForm.style.display = 'none';
      }
    });
  </script>

  <script>
    $(document).ready(function() {

      $('#country_id').change(function() {

        var countryId = $(this).val();
        var weight = {{ $totalWeightPrice['totalCartWeight'] }}; // Assuming $totalCartWeight is a PHP variable available in your Blade template
        console.log('Selected country ID:', countryId);
        console.log('Total cart weight:', weight);

        if (countryId) {
          $.ajax({
            url: '{{ route('Client.findWeightPrice', ['weight' => ':weight', 'country_id' => ':country_id']) }}'
                    .replace(':weight', weight)
                    .replace(':country_id', countryId),
            type: 'GET',
            success: function(response) {
              console.log('Ajax response:', response); // Log response for debugging

              // update international_shipping_cost
              var shippingCost = response * {{Country()->currancy_value}}; // Assuming your JSON response has a 'shipping_cost' field
              var formattedShippingCost = parseFloat(shippingCost).toFixed({{Country()->decimals}}).replace(/\d(?=(\d{3})+\.)/g, '$&,');
              $('#international_shipping_cost').text(formattedShippingCost);

              // show international_shipping_cost
              $('#international_shipping').attr('style', 'display: flex !important;');

              // Update the total span with the updated total including shipping cost
              updateTotal(shippingCost);

            },
            error: function(xhr) {
              console.error('Ajax error:', xhr.responseText); // Log error for debugging
              // Handle error
            }
          });
        }
      });


      // Function to update the total span with formatted number
      function updateTotal(shippingCost) {
        // Calculate total including shipping cost
        var subTotal = {{ $subTotalCart }};
        var vat = {{ $vat }};
        var shippingType = '{{ shippingType() }}';
        var internalShippingCost = {{ setting('internal_shipping_cost') * Country()->currancy_value }};
        var internationalShippingCost = {{ $totalWeightPrice['totalCartWeightPrice'] != null ? $totalWeightPrice['totalCartWeightPrice'] *Country()->currancy_value : 0 }};

        var total = subTotal + vat;

        if (shippingType === '1') {
          total += internalShippingCost;
        } else if (shippingType === '3') {
          total += internationalShippingCost;
        }

        total += parseFloat(shippingCost); // Add the shipping cost from AJAX response

        // Format the total number
        var formattedTotal = formatNumber(total);

        // Update the span content
        $('#total').text(formattedTotal);
      }

      // Function to format numbers with commas for thousands
      function formatNumber(number) {
        return number.toFixed({{Country()->decimals}}).replace(/\d(?=(\d{3})+\.)/g, '$&,');
      }
    });
  </script>

@stop
