@extends('Client.Layout.index')

@section('title')
  {{strtoupper($product['title_'.lang()])}}
@stop

@section('style')
  <style>
    .img-showcase img {
      opacity: 1;
      transition: opacity 0.2s ease-in-out;
    }

    .img-showcase img.hidden {
      opacity: 0;
    }

    .img-showcase img.shown {
      opacity: 1;
    }
    .in-stock-button, .out-stock-button{
      display: none;
    }

    .out-stock-btn{
      background-color: inherit;
      color: #dd1f1f;
      border: 1px dashed #dd1f1f;
      padding: 2px 15px !important;
    }

    .spinner-bg{
      right: -33px;
      width: 30px;
      height: 30px;
    }

    .disabled-btn, .disabled-btn:hover{
      cursor: not-allowed !important;
      background-color: #ccb1818f !important;
      border: #ccb1818f !important;
    }

    .showViewCart, .show_not_authenticate_yet{
      /*display: block;*/
      opacity: 1 !important;
      background-color: #00000066;
    }

    .inwp-stock-left-info{
      display:none;
    }
  </style>
@stop

@section('link')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
@stop


@section('content')
  <!------------ header ------------>
  @include('Client.Layout.header')
  <!------------ header end ------------>

  <!-- start Product Details -->
  <section class="py-3 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="d-flex">
            <div>
              <a href="{{route('Client.home')}}" class="text-decoration-none link-info text-danger">
                <i class="fa-solid fa-house"></i>
                <span class="mx-1">@lang('trans.home')</span>
              </a>
              <span class="mx-1">/</span>
              <a href="{{route('Client.shop')}}" class="text-decoration-none link-info text-danger">
                <span class="mx-1">@lang('trans.products')</span>
              </a>
              <span class="mx-1">/</span>
              <span class="mx-1"> {{strtoupper($product['title_'.lang()])}}</span>
            </div>

          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- end Product Details -->

  <section class="py-5">
    <div class="container">
      <div class="row d-flex align-items-center">

        <div class="col-lg-6 img-product-slider projects">
          <input type="hidden" name="product_id" value="{{$product->id}}">
          <div class="product-imgs box-container">
            <div class="img-display">
              <div class="img-showcase">
                <img src="{{ GalleryImage($product) }}" class="img-fluid" data-color="{{$product->Gallery()->whereNotNull('color_id')->first()->color_id}}">
              </div>
            </div>

            <div class="img-select">

              @php

                $images = [];
                foreach($product->Gallery as $GalleryImage){
                    list($width, $height) = getimagesize(public_path($GalleryImage->image));
                    if($width > 250){
                        $images[] =  asset($GalleryImage->image);
                    }
                }
              @endphp
              @forelse($images as $image)
                <div class="img-item" style="width:100px; height:100px;">
                  <a href="#" onclick="showImage('{{$image}}')">
                    <img src="{{$image}}">
                  </a>
                </div>
              @empty
              <!-- No galleries found -->
              @endforelse
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <h4 class="text-danger fw-semibold">{{$product['title_'.lang()]}}</h4>
          <h4 class="text-info fw-semibold">
            @if($product->HasDiscount())
              <span style="text-decoration: line-through; {{lang() == 'en' ? 'margin-right' : 'margin-left'}}: 10px;">
                {{$product->Price()}}
            </span>
              <span>{{$product->PriceWithCurrancy()}}</span>
            @else
              <span>{{$product->RealPrice()}}</span> {{Country()->currancy_code}}
            @endif
          </h4>
          <!-- Get colors -->
          <div class="row d-flex align-items-center mt-2">
            <div class=" col-sm-2 mb-2 cursor-pointer w-100">
              <h6>@lang('trans.color') :</h6>
            </div>
            @forelse($productFirstColorImages as $item)
              <div class=" col-2 mb-2 cursor-pointer mb-2  img-container">
                <img src="{{$item->image}}" class="img-fluid border border-warning getColorSizes colorImage" width="100" alt="{{$item->color['title_'.lang()]}}" title="{{$item->color['title_'.lang()]}}" data-color-id="{{$item->color_id}}" >
              </div>
            @empty
            @endforelse
          </div>
          <!-- Get sizes -->
          <div>
            <div class="row d-flex align-items-center mt-3 mb-4">
              <div class="col-2 mb-2 cursor-pointer w-100">
                <h6> @lang('trans.size') :</h6>
              </div>

              @php
                $sizeMapping = [
                    38 => '4',
                    39 => '5/5.5',
                    40 => '6',
                    41 => '7',
                    42 => '8',
                    43 => '9',
                    44 => '10',
                    45 => '11',
                    46 => '12',
                    47 => '13',
                    48 => '14',
                    49 => '15',
                ];
              @endphp


            @forelse($productSizes as $size)
                <div class="col-2 mb-2 cursor-pointer showSizes" data-toggle="tooltip" data-placement="top" title="{{$size->title}}{{$size->parent->title}}" data-size-id="{{$size->id}}">
                  <div class="border text-center align-items-center position-relative d-flex flex-column justify-content-center size-select size-hover">
                    <h6 class="mb-1 mt-2">{{$size->title}} {{$size->parent->title}}</h6>
                    <h6 class="mb-1 mt-2">{{ $sizeMapping[$size->title] ?? 'N/A' }} US</h6>
                    <div class="inwp-stock-left-info one_left_{{$size->id}}" data-inwp-stock-info="@lang('trans.1_left')"></div>
                  </div>
                </div>
            @empty
            @endforelse
            <!-- These inputs to get data of  -->
              <input type="hidden" name="color_id">
              <input type="hidden" name="size_id">

            </div>


            <div class="mb-3 in-stock-button">
              <button class="btn btn-green rounded-1 px-2 py-1">@lang("trans.in_stock")</button>
              <span class="d-inline-block">@lang('trans.max'): <span class="show_max_quantity"></span> </span>
            </div>
            <div class="mb-3 out-stock-button">
              <button class="btn out-stock-btn rounded-1 px-2 py-1">@lang("trans.out_of_stock")</button>
            </div>
          </div>

          <div class="d-flex">
            <div>
    <span class="input-wrapper input-wrapper-product border rounded-0 mb-2 mb-sm-0 border-warning">
      <button id="decrement" type="button" class="decrement text-danger bg-white fs-4 align-items-center d-flex mt-1 mb-1 rounded-0 text-center mx-2">-</button>
      <input type="text" value="1" min="1" max="{{$product->quantity}}" name="quantity_item" id="quantity" class="fw-semibold bg-gray quantity text-center" />
      <input type="hidden" name="total_quantity_item" value=""/>
      <button id="increment" type="button" class="increment text-danger bg-white fs-4 align-items-center d-flex mt-1 mb-1 rounded-0 text-center mx-2">+</button>
    </span>
            </div>
            <div class="mb-4 mx-3">
              <a href="cart.blade.php" id="addToCart" data-bs-toggle="modal" data-bs-target="#AddToCart" class="btn btn-info rounded-0 fs-7 disabled-btn" style="white-space: nowrap;">
                <i class="fa-solid fa-cart-shopping"></i> ADD TO CART
              </a>
            </div>
            <div class="mb-4 mx-3 position-relative" style="padding: 10px 20px !important;">
              <img class="text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom spinner spinner-bg" src="{{ asset('assets_client/images/spinner.png') }}" width="15" height="15" style="right:0; display: none;"></span>
              @if(checkProductWishlist($product->id) == true)
                <i class="fa-solid fa-heart position-absolute cursor-pointer heartIcon text-info" id="heartIcon-bg1"
                   style="right: 0; padding: 0px !important; font-size: 25px !important;"
                   data-product-id="{{ $product->id }}"
                   data-action-url="{{ route('Client.ToggleWishlist') }}">
                </i>
              @else
                <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon heartIcon-bg" id="heartIcon-bg2"
                   style="right: 0; padding: 0px !important; font-size: 25px !important;"
                   data-product-id="{{ $product->id }}"
                   data-action-url="{{ route('Client.ToggleWishlist') }}">
                </i>
              @endif
            </div>

            <!-- Modal view cart-->
            <div class="modal fade rounded-0 border-0 viewCart">
              <div class="modal-dialog mt-8  rounded-0 border-0">
                <div class="modal-content p-3  rounded-0 border-0">
                  <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center">
                    <h4 class="text-danger fw-semibold">@lang('trans.product_added_to_cart')</h4>
                    <div>
                      <a href="{{route('Client.productDetails',$product->id)}}" class="text-danger link-info fs-7 fw-semibold">@lang('trans.continue_shopping')</a>
                      <a href="{{route('Client.getCart')}}" class="btn btn-info rounded-0 fs-7 mx-2">@lang('trans.view_cart')</a>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <!-- end modal view cart -->


            <!-- Modal not_authenticate_yet -->
            <div class="modal fade rounded-0 border-0 not_authenticate_yet">
              <div class="modal-dialog mt-8  rounded-0 border-0">
                <div class="modal-content p-3  rounded-0 border-0">
                  <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center">
                    <h4 class="text-danger fw-semibold">@lang('trans.not_authenticate_yet')</h4>
                    <div>
                      <a href="{{route('Client.login')}}" class="btn btn-info rounded-0 fs-7 mx-2">@lang('trans.login')</a>
                      <a href="{{route('Client.login')}}" class="btn btn-info rounded-0 fs-7 mx-2">@lang('trans.register')</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end not_authenticate_yet -->
          </div>

          <div>
            <!-- Button trigger modal -->
            <button type="button" class="border bg-transparent py-2" data-bs-toggle="modal" data-bs-target="#TableModal">
              <i class="fa-solid fa-ruler-horizontal mx-1"></i>
              @lang('trans.size_guide')
            </button>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="TableModal" tabindex="-1" aria-labelledby="TableModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg rounded-0 border-0">
              <div class="modal-content rounded-0 border-0">
                <div class="modal-header border-0">
                  <h1 class="modal-title fs-5" id="TableModalLabel"> @lang('trans.size_guide')
                  </h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0 border-0">
                  <div class="pgs-sizeguide-table table-responsive">
                    <table class="table">
                      <thead>
                      <tr>
                        <th class="bg-info text-white">US</th>
                        <th class="bg-info text-white">UK</th>
                        <th class="bg-info text-white">EU</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td>7</td>
                        <td>6</td>
                        <td>40</td>
                      </tr>
                      <tr>
                        <td>7.5</td>
                        <td>6.5</td>
                        <td>40.5</td>
                      </tr>
                      <tr>
                        <td>8</td>
                        <td>7</td>
                        <td>41</td>
                      </tr>
                      <tr>
                        <td>8.5</td>
                        <td>7.5</td>
                        <td>41.5</td>
                      </tr>
                      <tr>
                        <td>9</td>
                        <td>8</td>
                        <td>42</td>
                      </tr>
                      <tr>
                        <td>9.5</td>
                        <td>8.5</td>
                        <td>42.5</td>
                      </tr>
                      <tr>
                        <td>10</td>
                        <td>9</td>
                        <td>43</td>
                      </tr>
                      <tr>
                        <td>10.5</td>
                        <td>9.5</td>
                        <td>43.5</td>
                      </tr>
                      <tr>
                        <td>11</td>
                        <td>10</td>
                        <td>44</td>
                      </tr>
                      <tr>
                        <td>11.5</td>
                        <td>10.5</td>
                        <td>44.5</td>
                      </tr>
                      <tr>
                        <td>12</td>
                        <td>11</td>
                        <td>45</td>
                      </tr>
                      <tr>
                        <td>13</td>
                        <td>12</td>
                        <td>46</td>
                      </tr>
                      <tr>
                        <td>14</td>
                        <td>13</td>
                        <td>47</td>
                      </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="modal-footer">

                  </div>
                </div>
              </div>
            </div>
            <!-- end modal  -->
          </div>

          <div class="accordion accordion-flush col-sm-12 mt-4 border-bottom" id="accordionFlushExample">
            @forelse($services as $service)
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button bg-dark collapsed border-top" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse_{{$service->id}}" aria-expanded="false" aria-controls="flush-collapse_{{$service->id}}">
                    <img src="{{asset($service->file)}}" alt="" style="width:25px; height:25px; margin: 2px">
                    {{$service['title_'.lang()]}}
                  </button>
                </h2>
                <div id="flush-collapse_{{$service->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    {!! $service['desc_'.lang()] !!}
                  </div>
                </div>
              </div>
            @empty
            @endforelse
          </div>

          <!-- Share button -->
          <div class="d-flex mt-3 align-items-center">
            <span class="fw-semibold">@lang('trans.Share') : </span>
            <div class="mx-2">
              <a href="https://api.whatsapp.com/send?text={{ route('Client.productDetails',$product->id) }}" class="text-decoration-none mx-1 fs-3" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
              <a href="{{ route('Client.productDetails',$product->id) }}" class="text-decoration-none mx-1 fs-4 copy-link" target="_blank"><i class="fa-solid fa-link"></i></a>
              <a href="https://www.facebook.com/dialog/send?link={{ route('Client.productDetails',$product->id) }}" class="text-decoration-none mx-1 fs-4" target="_blank"><i class="fa-brands fa-facebook-messenger"></i></a>
              <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('Client.productDetails',$product->id) }}" class="text-decoration-none mx-1 fs-4" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
              <a href="mailto:?subject=Check out this product&body=Check out this product: {{ route('Client.productDetails',$product->id) }}" class="text-decoration-none mx-1 fs-4" target="_blank"><i class="fa-regular fa-envelope"></i></a>
            </div>
          </div>

        </div>
      </div>
  </section>

@stop


@section('script')

  <script>
    function showImage(imageSrc) {
      var imgShowcase = document.querySelector('.img-showcase img');
      imgShowcase.classList.add('hidden');

      event.preventDefault();

      setTimeout(function () {
        imgShowcase.src = imageSrc;
      }, 300);
      imgShowcase.classList.add('shown');
    }
  </script>

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


  <script>
    $(document).ready(function() {
      $('.img-container img').click(function() {
        $('.img-container img').removeClass('selected-img');
        $(this).toggleClass('selected-img');

        // if ($('.selected-img').length > 0) {
        //   $('.stock-button').show();
        // } else {
        //   $('.stock-button').hide();
        // }
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('.size-select').click(function() {
        $('.size-select').removeClass('selected-img');
        $(this).toggleClass('selected-img');
      });
    });
  </script>

  <script>
    document.getElementById('sizeToggle').addEventListener('click', function() {
      var accordion = document.getElementById('show-accordion');
      if (accordion.style.display === 'none') {
        accordion.style.display = 'block';
      } else {
        accordion.style.display = 'none';
      }
    });
  </script>

  <script>
    const options = document.querySelectorAll('.option');

    options.forEach(option => {
      option.addEventListener('click', function() {
        options.forEach(opt => opt.classList.remove('active'));

        this.classList.add('active');
      });
    });
  </script>

  <!-- show sizes of each color -->
  <script>
    GalleryImages = [];
    @foreach($product->Gallery as $ImageItem)
    @php(list($width, $height) = getimagesize(public_path($ImageItem->image)))
    @if($width > 250)
    GalleryImages.push({
      'color_id': {{ $ImageItem->color_id }},
      'image': '{{ asset($ImageItem->image) }}',
    });
    @endif
    @endforeach
    $(document).ready(function() {

      $('.colorImage').click(function() {
        var colorId = $(this).data('color-id');

        images = '';
        GalleryImages.forEach(element => {
          if(element.color_id == colorId){
            images += '<div class="img-item" style="width:100px; height:100px;"><a  onclick="showImage(\''+element.image+'\')"><img src="'+element.image+'"></a></div>'
            var imgShowcase = document.querySelector('.img-showcase img');
            imgShowcase.classList.add('hidden');

            setTimeout(function () {
              imgShowcase.src = element.image;
            }, 300);
            imgShowcase.classList.add('shown');


          }
        });

        $('.img-select').empty().append(images);



        var productId = $('input[name="product_id"]').val();

        $.ajax({
          url: '{{route('Client.getSizesByColor')}}',
          method: 'GET',
          data: {
            color_id: colorId,
            product_id: productId,
          },
          success: function(response) {
            console.log('Success:', response);
            $('.showSizes').hide();
            response.forEach(function(sizeId) {
              $('.showSizes[data-size-id="' + sizeId + '"]').show();
            });
          },
          error: function(xhr, status, error) {
            console.error('Error:', error);
          }
        });
      });
    });
  </script>


  <!-- To get item by sending color_id, size_id, product_id && add_product_to_cart -->
  <script>
    $(document).ready(function() {

      /*** start To prevent add to cart if there is no product ***/
      $('#addToCart').click(function(event) {
        if ($(this).hasClass('disabled-btn')) {  // Here you can not use add_to_cart_btn
          event.preventDefault(); // Prevent the default action (opening modal)
          Swal.fire({
            text: "@lang('trans.Sorry_product_unavailable_choose_different_combination')",
            showConfirmButton: true,
            // timer: 1500 // Display duration in milliseconds
          });
          return false;
        }
        else { // Here you can use add_to_cart_btn

          // To check if authenticated
          var checkAuth = "{{ auth('client')->check() ? '1' : '0' }}";
          if (checkAuth !== '1') {
            $('.not_authenticate_yet').fadeIn().addClass('show_not_authenticate_yet');
            return;
          }

          // Here code to save product in cart
          // make sure we have correct data
          var colorId = parseInt($('input[name="color_id"]').val());
          var sizeId = parseInt($('input[name="size_id"]').val());
          var productId = parseInt($('input[name="product_id"]').val());
          var quantityItem = parseInt($('input[name="quantity_item"]').val());
          var TotalQuantityItem = parseInt($('input[name="total_quantity_item"]').val());

          if (colorId && sizeId && productId && quantityItem) {
            // to make_sure the chosen quantity by client is not bigger than total_quantity
            if (TotalQuantityItem)
            {
              if (quantityItem > TotalQuantityItem || quantityItem <= 0)
              {
                {{--                alert('@lang('trans.Sorry_product_unavailable_choose_different_combination')');--}}
                Swal.fire({
                  text: "@lang('trans.Sorry_product_unavailable_choose_different_combination')",
                  showConfirmButton: true,
                  // timer: 1500 // Display duration in milliseconds
                });
                return false;
              }
            }
            // go to addProductToCart
            addToCart(colorId, sizeId, productId, quantityItem);
          }
          else {
            Swal.fire({
              text: "@lang('trans.Sorry_product_unavailable_choose_different_combination')",
              showConfirmButton: true,
              // timer: 1500 // Display duration in milliseconds
            });
          }

          // Put code of ajax here
          // To show modal view cart
          // $('.viewCart').fadeIn().addClass('showViewCart');


        }
      });
      // To close modal viewCart
      $('.viewCart .btn-close').on('click', function() {
        $('.viewCart').hide();
        $('.size-select').removeClass('selected-img');
        $('.img-container img').removeClass('selected-img');
        $('input[name="color_id"]').val('');
        $('input[name="size_id"]').val('');
        $('#addToCart').addClass('disabled-btn');
        $('.in-stock-button').hide();
        $('.out-stock-button').hide();
      });

      function addToCart(colorId, sizeId, productId, quantityItem) {
        $.ajax({
          url: '{{route('Client.addToCart')}}',
          method: 'GET',
          data: {
            color_id: colorId,
            size_id: sizeId,
            product_id: productId,
            quantity: quantityItem,
          },
          success: function(response) {
            console.log('Success:', response.cart_count);
            $('.bi-bag .icon-number').text(response.cart_count);
            $('.viewCart').fadeIn().addClass('showViewCart');
          },
          error: function(xhr, status, error) {
            console.error('Error:', error);
          }
        });
      }
      /*** End To prevent add to cart if there is no product then add_to_cart ***/


      /*** start To get item by sending color_id, size_id, product_id ***/
      $('.img-container img').click(function() {

        var colorId = $(this).data('color-id');

        // Save colorId to input field
        $('input[name="color_id"]').val(colorId);

        // Check if both color and size IDs are selected
        if ($('input[name="color_id"]').val() && $('input[name="size_id"]').val()) {
          console.log('Success');
          // Make your AJAX request here
          var sizeId = $('input[name="size_id"]').val();
          var productId = $('input[name="product_id"]').val();
          makeAjaxRequest(colorId, sizeId, productId);
        }
        else {
          console.log('no');
        }
      });

      $('.size-select').click(function() {
        var sizeId = $(this).parent().data('size-id');

        // Save sizeId to input field
        $('input[name="size_id"]').val(sizeId);

        // Check if both color and size IDs are selected
        if ($('input[name="color_id"]').val() && $('input[name="size_id"]').val()) {
          console.log('Success');
          // Make your AJAX request here
          var colorId = $('input[name="color_id"]').val();
          var productId = $('input[name="product_id"]').val();
          makeAjaxRequest(colorId, sizeId, productId);
        }
        else {
          console.log('no');
        }
      });

      function makeAjaxRequest(colorId, sizeId, productId) {
        $.ajax({
          url: '{{route('Client.getItemByColorSize')}}',
          method: 'GET',
          data: {
            color_id: colorId,
            size_id: sizeId,
            product_id: productId
          },
          success: function(response) {
            // console.log('Success:', response);
            if (response.quantity > 0) {
              // Show the corresponding .showSizes element
              console.log('Success:', response.quantity);

              // to show 1_left div
              if (response.quantity === 1){
                $('.one_left_'+response.size_id).show();
              }else{
                $('.one_left_'+response.size_id).hide();
              }

              $('#addToCart').removeClass('disabled-btn');
              $('.out-stock-button').hide();
              $('.in-stock-button').show();
              $('.show_max_quantity').text(response.quantity);

              // update input quantity
              $('input[name="quantity_item"]').attr('max', response.quantity);
              $('input[name="total_quantity_item"]').val(response.quantity);

            } else {
              $('#addToCart').addClass('disabled-btn');
              $('.in-stock-button').hide();
              $('.out-stock-button').show();
            }
          },
          error: function(xhr, status, error) {
            console.error('Error:', error);
          }
        });
      }
      /*** End To get item by sending color_id, size_id, product_id ***/
    });
  </script>


  <!-- To copy link -->
  <script>
    // Select the elements with the "copy-link" class
    const copyLinks = document.querySelectorAll('.copy-link');

    // Iterate over each link
    copyLinks.forEach(link => {
      // Add click event listener
      link.addEventListener('click', (event) => {
        // Prevent the default action of the link
        event.preventDefault();

        // Get the URL from the href attribute of the link
        const url = link.getAttribute('href');

        // Create a temporary textarea element
        const textarea = document.createElement('textarea');
        textarea.value = url;

        // Append the textarea to the body
        document.body.appendChild(textarea);

        // Select the text inside the textarea
        textarea.select();

        // Execute the copy command
        document.execCommand('copy');

        // Remove the textarea from the DOM
        document.body.removeChild(textarea);

        // Alert the user that the link has been copied
        alert('Link copied to clipboard!');
      });
    });
  </script>

  {{--  Wishlist code in  @extends('Client.Layout.index')  --}}
@stop
