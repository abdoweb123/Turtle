@extends('Client.Layout.index')

@section('title')
    @lang('trans.cart')
@stop
   

@section('style')
    <!-- start css live search -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" rel="stylesheet">
    <style>
        .dropdown-toggle, .filter-option,
        .dropdown-toggle:hover, .filter-option:hover,
        .dropdown-toggle:focus, .filter-option:focus,
        .dropdown-toggle:active, .filter-option:active
        {
            background: none;
            border:none;
            padding: 0;
            outline: none !important;
        }
        .bootstrap-select .dropdown-toggle:focus{
            outline: none !important;
            background: none;
        }
        .form-select{
            background: none;
        }
        /*.dropdown-menu{*/
        /*    transform: translate3d(0px, 34px, 0px) !important;*/
        /*    display: none;*/
        /*}*/
    </style>
    <!-- End css live search -->
@stop


@section('content')
    <!------------ header ------------>
    @include('Client.Layout.header')
    <!------------ header end ------------>

    <!-- start cart -->
    <section class="py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <h4 class="fw-semibold">@lang('trans.cart')</h4>
                        <div>
                            <a href="" class="text-decoration-none link-info text-danger">
                                <i class="fa-solid fa-house"></i>
                                <span class="mx-1">@lang('trans.home')</span></a>
                            <span class="mx-1">/</span>
                            <span class="mx-1">@lang('trans.cart')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end cart -->

    {{--
    <section class="py-3">
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
    <section class="py-4">
        <div class="container">
            @if(count($cart)>0)
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card-body p-0 table-responsive">
                            <table class="table border">
                                <thead>
                                <tr>
                                    <th class="text-center" style="white-space:nowrap">@lang('trans.img')</th>
                                    <th class="text-center" style="white-space:nowrap">@lang('trans.product')</th>
                                    <th class="text-center" style="white-space:nowrap">@lang('trans.quantity')</th>
                                    <th class="text-center" style="white-space:nowrap">@lang('trans.price')</th>
                                    <th class="text-center" style="white-space:nowrap">@lang('trans.sub_total')</th>
                                    <th class="text-center" style="white-space:nowrap">@lang('trans.delete')</th>
                                </tr>
                                </thead>

                                @foreach($cart as $cartItem)
                                    <tbody>
                                    <tr>
                                        <td class="" style="white-space:nowrap">
                                            <div class="media text-center">
                                                <img src="{{asset($cartItem->product->Gallery()->where('color_id',$cartItem->color_id)->first()->image  ?? Setting('not_found_img'))}}" class="img-fluid" style="width:80px; height:80px">
                                            </div>
                                        </td>
                                        <td class="" style="white-space:nowrap">
                                            <div class="media">
                                                <div class="media-body mt-4">
                                                    <span>{{$cartItem->product['title_'.lang()]}} - {{$cartItem->color['title_'.lang()]}}, {{$cartItem->size->title.$cartItem->size->parent->title}}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center" style="white-space:nowrap">
                                            <div class="mt-3">
                                                <div>
                                                  <span class="input-wrapper border rounded-0  border-wrapper">
                                                    <button id="decrement" type="button" class="decrement text-danger bg-white fs-4 align-items-center d-flex mt-1 mb-1 rounded-0 text-center mx-3">-</button>
                                                    <input type="text" value="{{$cartItem->quantity}}" max="{{$cartItem->item->quantity}}" name="quantity[{{$cartItem->id}}]" data-item-id="{{$cartItem->id}}" class="fw-semibold  quantity text-center" disabled/>
                                                    <button id="increment" type="button" class="increment text-danger bg-white fs-4 align-items-center d-flex mt-1 mb-1 rounded-0 text-center mx-3">+</button>
                                                  </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center" style="white-space:nowrap">
                                            <div class="mt-4">
                                                <span>{{$cartItem->product->PriceWithCurrancy()}}</span>
                                            </div>
                                        </td>
                                        <td class="" style="white-space:nowrap">
                                            <div class="mt-4">
                                            <span class="text-info fw-semibold" id="subtotalItem_{{$cartItem->id}}">
                                                {{$cartItem->product->RealPriceWithQuantity($cartItem->quantity)}}
                                            </span>
                                                <span class="text-info fw-semibold">
                                                  {{Country()->currancy_code}}
                                            </span>
                                            </div>
                                        </td>
                                        <td class="" style="white-space:nowrap">
                                            <div class="mt-4 text-center">
                                                <img class="text-success fs-6 link-primary cursor-pointer top-0 end-custom spinner deleteRawImg" src="{{ asset('assets_client/images/spinner.png') }}" width="15" height="15" style="right:0; display: none">
                                                <i class="fa-solid fa-trash cursor-pointer text-primary deleteRawIcon" onclick="deleteCartElement(this,{{$cartItem->id}})"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach

                            </table>

                            <div class="col-12 border d-flex justify-content-end">
                                <a href="#" class="btn btn-info rounded-0 mt-3 mb-3 py-1 mx-3 show_loading" style=" display: none;">
                                    <img class="text-success fs-6 link-primary cursor-pointer top-0 end-custom spinner" src="{{ asset('assets_client/images/spinner.png') }}" width="15" height="15" style="right:0;">
                                </a>
                                <a href="#" class="btn btn-info rounded-0 mt-3 mb-3 py-1 mx-3 update_cart">@lang('trans.update_cart')</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 mt-5 mt-lg-0">
                        <div class="card rounded-0 border-wrapper">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold">@lang('trans.cart_totals')</h5>
                                <div class="border-bottom mb-3 mt-3"></div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-danger fw-semibold">@lang('trans.sub_total')</h6>
                                    <h6 class="text-danger fw-semibold">
                                        <span id="subtotal_cart">
                                          {{format_number($subTotalCart)}}
                                        </span>
                                        <span>
                                          {{Country()->currancy_code}}
                                        </span>
                                    </h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-danger fw-semibold">@lang('trans.vat')</h6>
                                    <h6 class="text-danger fw-semibold">
                                        <span id="vat">
                                          {{format_number($vat)}}
                                        </span>
                                        <span>
                                          {{Country()->currancy_code}}
                                        </span>
                                    </h6>
                                </div>
                                <div class="border-bottom mb-3 mt-3"></div>
                                <form action="{{route('Client.checkoutPost')}}" method="post">
                                    @csrf
                                    <div class="d-block">
                                        <div>
                                            <h6 class="fw-semibold">@lang('trans.shipping')</h6>
                                        </div>
                                        <div class="d-block" id="shipping2wayParent">

                                            <div id="shipping2wayDiv1">
                                                <!-- To put here new deleivery_type -->
                                            </div>
                                            <div id="shipping2way">
                                                <div class="form-check">
                                                    <input class="" type="radio" name="shipping_type" id="flexRadioDefault2" value="2" checked>
                                                    <label class="form-check-label fs-7 text-secondary" for="flexRadioDefault2" style="color:black !important;">
                                                        @lang('trans.pickup_store')
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="" type="radio" name="shipping_type" id="flexRadioDefault1" value="1">
                                                    <label class="form-check-label fs-7 text-secondary" for="flexRadioDefault1" style="color:black !important;">
                                                        @lang('trans.shipping') @lang('trans.within') {{mainCountry()['title_'.lang()]}} :
                                                        <span style="font-weight:bold">
                                                              {{ format_number(setting('internal_shipping_cost')*Country()->currancy_value) }} {{Country()->currancy_code}}
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="" type="radio" name="shipping_type" id="flexRadioDefault1" value="3">
                                                    <label class="form-check-label fs-7 text-secondary" for="flexRadioDefault1" style="color:black !important;">
                                                        @lang('trans.international_shipping')
                                                        {{--                                                        <span style="font-weight:bold">--}}
                                                        {{--                                                              {{ format_number(setting('international_shipping_cost')*Country()->currancy_value) }} {{Country()->currancy_code}}--}}
                                                        {{--                                                        </span>--}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-bottom mb-3 mt-3"></div>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="text-danger fw-semibold">@lang('trans.total')</h6>
                                        <h6 class="text-danger fw-semibold">
                                          <span id="TotalCart">
                                               {{format_number($subTotalCart + $vat )}}
                                          </span>
                                            <span>
                                              {{Country()->currancy_code}}
                                          </span>
                                        </h6>
                                    </div>
                                    <div class=" text-center mt-3 mb-3">
                                        <button type="submit" class="btn btn-info rounded-0 col-12">@lang('trans.proceed_checkout')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row d-flex align-items-center justify-content-center text-center">
                    <div class="col-sm-5">
                        <h6 class="fw-semibold text-black mt-3">@lang('trans.no_products_in_cart')</h6>
                        <div class="text-center">
                            <a href="{{route('Client.shop')}}" class="btn btn-info rounded-2 col-sm-7 mb-3 mt-4">@lang('trans.browse_products')</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@stop


@section('script')


    <!-- decrement/increment quantity -->
    <script>
        const inputWrappers = document.querySelectorAll('.input-wrapper');

        inputWrappers.forEach(inputWrapper => {
            const incrementButton = inputWrapper.querySelector('.increment');
            const decrementButton = inputWrapper.querySelector('.decrement');
            const quantityInput = inputWrapper.querySelector('.quantity');

            incrementButton.addEventListener("click", () => {
                const maxQuantity = parseInt(quantityInput.getAttribute('max'));
                let currentValue = parseInt(quantityInput.value);

                if (currentValue < maxQuantity) {
                    quantityInput.value = currentValue + 1;
                }
                if (currentValue == maxQuantity) {
                    Swal.fire({
                        text: "@lang('trans.You_have_reached_your_limit')",
                        showConfirmButton: true,
                        // timer: 1500 // Display duration in milliseconds
                    });
                }
            });

            decrementButton.addEventListener("click", () => {
                const currentValue = parseInt(quantityInput.value);

                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });
        });
    </script>

    <!-- locationText -->
    <script>
        var locationText = document.querySelectorAll(".locationText");

        locationText.forEach(function(element) {
            if (document.documentElement.dir === "rtl") {
                element.style.textAlign = "start";
            } else {
                element.style.textAlign = "end";
            }
        });
    </script>

    <!-- Toggle-shipping -->
    <script>
        document.getElementById('Toggle-shipping').addEventListener('click', function() {
            event.preventDefault();
            var accordion = document.getElementById('section-shipping');
            if (accordion.style.display === 'none') {
                accordion.style.display = 'block';
            } else {
                accordion.style.display = 'none';
            }
        });
    </script>

    <!-- Update quantity of cart_items -->
    <script>
        $(document).ready(function() {
            $('.update_cart').click(function(event) {
                event.preventDefault(); // Prevent the default action of the link

                // Hide the update_cart button and show the loading spinner
                $(this).hide();
                $('.show_loading').show();

                // Prepare an object to store item IDs and corresponding quantities
                var quantitiesData = {};

                // Loop through all quantity inputs
                $('input[name^="quantity"]').each(function() {
                    var itemId = $(this).data('item-id'); // Get the item ID from the data attribute
                    var quantity = $(this).val(); // Get the quantity value

                    // Store the item ID and quantity in the quantitiesData object
                    if(itemId && quantity) {
                        quantitiesData[itemId] = quantity;
                    }
                });

                // Now you have an object containing item IDs and quantities
                console.log(quantitiesData);

                // Here you can perform an AJAX request with the quantities data
                $.ajax({
                    url: '{{route('Client.updateCart')}}',
                    method: 'GET',
                    data: {
                        quantities: quantitiesData
                    },
                    success: function(response) {
                        console.log('Success:', response);
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1000
                        });

                        // to update #subtotalItem (subtotal of each item)
                        response.cart_elements.forEach(function(cartItem) {
                            // Update the subtotal element using the cart item ID
                            var subtotal = cartItem.total_price.toLocaleString('en-BH', { minimumFractionDigits: {{Country()->decimals}} }); // format total price to two decimal places
                            $('#subtotalItem_' + cartItem.id).text(subtotal);
                        });

                        // to update subtotal_cart
                        $('#subtotal_cart').text(response.subtotal_cart.toLocaleString('en-BH', { minimumFractionDigits: {{Country()->decimals}} }));

                        // to update TotalCart
                        var shippingTypeValue = $('input[name="shipping_type"]:checked').val();
                        console.log('shippingTypeValue '+shippingTypeValue);
                        var shippingValue = 0;  // pickup store
                        console.log('shippingValue '+shippingValue);
                        if (shippingTypeValue === '1'){ // internal
                            shippingValue = {{setting('internal_shipping_cost')}};
                        }
                        else if (shippingTypeValue === '3'){ // international
                            shippingValue = {{setting('international_shipping_cost')}};
                        }

                        var vat = {{(setting('vat')/100)}} * (response.subtotal_cart);
                        $('#vat').text(vat.toLocaleString('en-BH', { minimumFractionDigits: {{Country()->decimals}} }));
                        console.log('shippingValue '+shippingValue);
                        var TotalCart = (response.subtotal_cart) + shippingValue + vat;
                        console.log(TotalCart);
                        $('#TotalCart').text(TotalCart.toLocaleString('en-BH', { minimumFractionDigits: {{Country()->decimals}} }));
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    },
                    complete: function() {
                        // After completing the AJAX request, you can show the update_cart button again and hide the loading spinner
                        $('.update_cart').show();
                        $('.show_loading').hide();
                    }
                });
            });
        });
    </script>

    <!-- Delete cart_item -->
    <script>
        // Function to handle delete action
        function deleteCartElement(icon, cartItemId) {
            var $icon = $(icon);
            var $img = $icon.siblings('.deleteRawImg');
            var $tbody = $icon.closest('tbody');

            $icon.hide();
            $img.show();

            // Ajax call here
            $.ajax({
                url: '{{route('Client.deleteCart')}}',
                method: 'GET',
                data: {
                    cart_item_id: cartItemId // Pass the cart item id to the server
                },
                success: function(response) {
                    // Success callback
                    $icon.show();
                    $img.hide();
                    $tbody.hide(); // Hide tbody after ajax call success
                    Swal.fire({
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    $('.bi-bag .icon-number').text(response.cart_count);
                    // to update subtotal_cart

                    var subtotal_cart = response.subtotal_cart.toLocaleString('en-BH', { minimumFractionDigits: {{Country()->decimals}} });
                    $('#subtotal_cart').text(subtotal_cart);

                    var shippingTypeValue = $('input[name="shipping_type"]:checked').val();
                    console.log('shippingTypeValue '+shippingTypeValue);
                    var shippingValue = 0;  // pickup store
                    console.log('shippingValue '+shippingValue);
                    if (shippingTypeValue === '1'){ // internal
                        shippingValue = {{setting('internal_shipping_cost')}};
                    }
                    else if (shippingTypeValue === '3'){ // international
                        shippingValue = {{setting('international_shipping_cost')}};
                    }

                    var vat = {{(setting('vat')/100)}} * (response.subtotal_cart);
                    $('#vat').text(vat.toLocaleString('en-BH', { minimumFractionDigits: {{Country()->decimals}} }));
                    console.log('shippingValue '+shippingValue);
                    var TotalCart = (response.subtotal_cart) + shippingValue + vat;
                    console.log(TotalCart);
                    $('#TotalCart').text(TotalCart.toLocaleString('en-BH', { minimumFractionDigits: {{Country()->decimals}} }));
                },
                error: function(xhr, status, error) {
                    // Error callback
                    console.error('Error:', error);
                    $icon.show();
                    $img.hide();
                }
            });
        }
    </script>

    <!-- update addressShipping -->
    <script>
        $(document).ready(function() {
            $('#update_addressShippingBtn').click(function() {
                var countryId = $('#country_id').val();
                var state = $('#state').val();
                var city = $('#city').val();
                var postcode = $('#postcode').val();

                // Validate country selection
                if (!countryId) {
                    alert('@lang('please_select_country')');
                    return;
                }

                // Hide update button and show spinner
                $('#update_addressShipping').hide();
                $('#update_addressShippingImg').show();

                // Perform AJAX request
                $.ajax({
                    url: '{{route('Client.updateAddressShipping')}}',
                    method: 'get',
                    data: {
                        country_id: countryId,
                        state: state,
                        city: city,
                        postcode: postcode,
                    },
                    success: function(response) {
                        // Process AJAX response here
                        console.log('Ajax request successful');
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1000
                        });

                        // update delivery_type
                        // Append the new div after #shipping2way
                        $('#shipping_type_jq').remove();
                        var currentCountryId = {{ Country()->id }};
                        console.log(currentCountryId,'----',response.delivery_type);
                        var shippingType, shippingLabel, shippingCost, currencyCode;
                        if (response.delivery_type == currentCountryId) {
                            shippingType = 1;
                            shippingLabel = "{{ __('trans.shipping') }}";
                            shippingCost = "{{ format_number(setting('internal_shipping_cost') * Country()->currancy_value) }}";
                        } else {
                            shippingType = 3;
                            shippingLabel = "{{ __('trans.international_shipping') }}";
                            shippingCost = "{{ format_number(setting('international_shipping_cost') * Country()->currancy_value) }}";
                        }

                        $('input[name="shipping_type"]').prop('checked', false);
                        currencyCode = "{{ Country()->currancy_code }}";
                        var divContent = '<div class="form-check" id="shipping_type_jq">';
                        divContent += '<input class="" type="radio" name="shipping_type" id="flexRadioDefault1" value="' + shippingType + '" checked>';
                        divContent += '<label class="form-check-label fs-7 text-secondary" for="flexRadioDefault1" style="color:black !important;">';
                        divContent += shippingLabel + ' : <span style="font-weight:bold">' + shippingCost + ' ' + currencyCode + '</span>';
                        divContent += '</label></div>';

                        $('#shipping2wayDiv1').append(divContent);
                        $('#shipping2way').remove();

                        // to update total
                        var shippingTypeValue = $('input[name="shipping_type"]:checked').val();
                        console.log('shippingTypeValue '+shippingTypeValue);
                        var shippingValue = 0;  // pickup store
                        console.log('shippingValue '+shippingValue);
                        if (shippingTypeValue === '1'){ // internal
                            shippingValue = {{setting('internal_shipping_cost') * Country()->currancy_value}};
                        }
                        else if (shippingTypeValue === '3'){ // international
                            shippingValue = {{setting('international_shipping_cost') * Country()->currancy_value}};
                        }
                        console.log('shippingValue '+shippingValue);



                        var subtotalText = $('#subtotal_cart').text();
                        var subtotalNumber = parseFloat(subtotalText.replace(/[^\d.-]/g, ''));
                        var vat =  {{(setting('vat')/100)}} * subtotalNumber;
                        $('#vat').text(vat.toLocaleString('en-BH', { minimumFractionDigits: {{Country()->decimals}} }));
                        var TotalCart = subtotalNumber + shippingValue + vat;
                        console.log(TotalCart);
                        $('#TotalCart').text(TotalCart.toLocaleString('en-BH', { minimumFractionDigits: {{Country()->decimals}} }));

                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX errors here
                        console.error('Ajax request error:', error);
                    },
                    complete: function() {
                        // Hide spinner and show update button
                        $('#update_addressShipping').show();
                        $('#update_addressShippingImg').hide();
                    }
                });
            });
        });
    </script>

    <!-- change shipping type -->
    <script>
        $(document).ready(function() {
            $(document).on('click', 'input[name="shipping_type"]',function() {
                var shippingTypeValue = $(this).val();
                // to update TotalCart
                console.log(shippingTypeValue);
                var shippingValue = 0;  // pickup store
                if (shippingTypeValue === '1'){ // internal
                    shippingValue = {{setting('internal_shipping_cost') * Country()->currancy_value}};
                }
                else if (shippingTypeValue === '3'){ // international
                    shippingValue = {{setting('international_shipping_cost') * Country()->currancy_value}};
                }

                var subtotalText = $('#subtotal_cart').text();
                var subtotalNumber = parseFloat(subtotalText.replace(/[^\d.-]/g, ''));
                var vat =  {{(setting('vat')/100)}} * subtotalNumber;
                $('#vat').text(vat.toLocaleString('en-BH', { minimumFractionDigits: {{Country()->decimals}} }));
                var TotalCart = subtotalNumber + shippingValue + vat;

                console.log(TotalCart);

                $('#TotalCart').text(TotalCart.toLocaleString('en-BH', { minimumFractionDigits: {{Country()->decimals}} }));
            });
        });
    </script>

    <!-- start css live search -->
    {{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>--}}
    <!-- End css live search -->

@stop