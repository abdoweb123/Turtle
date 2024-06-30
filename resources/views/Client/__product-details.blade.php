@extends('Client.Layout.index')

@section('title')
  @lang('trans.product_details')
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

    .showViewCart{
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
        <!-- <div class="col-lg-6" id="static-thumbnails">
            <a href="images/SUE1604QCNBB_GRN_4.webp" data-fancybox="gallery" class="mx-auto d-flex justify-content-center">
              <img src = "images/SUE1604QCNBB_GRN_4.webp" class="img-fluid col-lg-11 col-11">
            </a>
            <div class="row col-lg-11 mt-2 mx-auto d-flex justify-content-center align-items-center">
              <div class="col-lg-3 col-3 box-container h-100">
                <a href="images/DCLF0707RB-PYN_1.webp" data-fancybox="gallery">
                  <img src="images/DCLF0707RB-PYN_1.webp" class="img-fluid h-100 object-fit-cover">
                </a>
              </div>
              <div class="col-lg-3 col-3 box-container h-100">
                <a href="images/DCLF2177NO-OWH_1.webp" data-fancybox="gallery">
                  <img src="images/DCLF2177NO-OWH_1.webp" class="img-fluid h-100 object-fit-cover">
                </a>
              </div>
              <div class="col-lg-3 col-3 box-container h-100">
                <a href="images/DCF0707ISORB-JNS_1.webp" data-fancybox="gallery">
                  <img src="images/DCF0707ISORB-JNS_1.webp" class="img-fluid h-100 object-fit-cover">
                </a>
              </div>
              <div class="col-lg-3 col-3 box-container h-100">
                <a href="images/NBK1524CCUNO-SAL-1.webp" data-fancybox="gallery">
                  <img src="images/NBK1524CCUNO-SAL-1.webp" class="img-fluid h-100 object-fit-cover">
                </a>
              </div>
            </div>


        </div> -->
        <div class="col-lg-6 img-product-slider projects">

          {{--        <div class = "product-imgs box-container">--}}
          {{--          <div class = "img-display">--}}
          {{--            <div class = "img-showcase">--}}
          {{--              @forelse($product->Gallery()->whereNull('color_id')->get() as $gallery)--}}
          {{--                <img src = "{{$gallery->image}}" class="img-fluid">--}}
          {{--              @empty--}}
          {{--              <!-- No galleries found -->--}}
          {{--              @endforelse--}}
          {{--            </div>--}}
          {{--          </div>--}}
          {{--          <div class = "img-select">--}}
          {{--            @forelse($product->Gallery()->whereNull('color_id')->get() as $gallery)--}}
          {{--              <div class = "img-item">--}}
          {{--                <a href="#" class="img-link" data-id = "{{$loop->iteration}}">--}}
          {{--                  <img src = "{{$gallery->image}}">--}}
          {{--                </a>--}}
          {{--              </div>--}}
          {{--            @empty--}}
          {{--            <!-- No galleries found -->--}}
          {{--            @endforelse--}}
          {{--          </div>--}}
          {{--        </div>--}}
          <input type="hidden" name="product_id" value="{{$product->id}}">
          <div class="product-imgs box-container">
            <div class="img-display">
              <div class="img-showcase">
                @forelse($product->Gallery()->whereNull('color_id')->get() as $gallery)
                  <img src="{{$gallery->image?? Setting('not_found_img')}}" class="img-fluid">
                @empty
                <!-- No galleries found -->
                @endforelse
              </div>
            </div>

            <div class="img-select">
              @forelse($product->Gallery()->whereNull('color_id')->get() as $gallery)
                <div class="img-item" style="width:100px; height:100px;">
                  <a href="#" data-id="{{$loop->iteration}}" onclick="showImage(event,'{{$gallery->image}}')">
                    <img src="{{$gallery->image}}">
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

              @forelse($productSizes as $size)
                <div class="col-2 mb-2 cursor-pointer showSizes" data-toggle="tooltip" data-placement="top" title="{{$size->title}}{{$size->parent->title}}" data-size-id="{{$size->id}}">
                  <div class="border text-center align-items-center position-relative d-flex flex-column justify-content-center size-select size-hover">
                    <h6 class="mb-1 mt-2">{{$size->title}}</h6>
                    <h6 class="">{{$size->parent->title}}</h6>
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

            <!-- Modal -->
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
            <!-- end modal  -->
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
          <!-- Sidebar  -->
          {{--     <button class="btn btn-outline-secondary mt-3 py-1 fs-7 rounded-0 px-3 btn-max" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightCheckInStore" aria-controls="offcanvasRightCheckInStore"> <i class="fa-solid fa-location-dot mx-1"></i>  Check in-store availability</button>--}}

          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRightCheckInStore" aria-labelledby="offcanvasRightCheckInStoreLabel">
            <div class="offcanvas-header">
              <h4 class="offcanvas-title fw-semibold" id="offcanvasRightCheckInStoreLabel">Locate In Store</h4>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <div class="container">
                <div class="mt-3">
                  <span class="border px-2 py-2 cursor-pointer" id="sizeToggle">Size</span>
                  <div class="accordion accordion-flush mt-4" style="display: none;" id="show-accordion">
                    <div class="accordion-item border mb-2">
                      <h2 class="accordion-header">
                        <button class="accordion-button text-secondary fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-sizeOne" aria-expanded="false" aria-controls="flush-sizeOne">
                          Black/06-5-uk
                        </button>
                      </h2>
                      <div id="flush-sizeOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <ul>
                            <li class="text-secondary">al ain (In stock)</li>
                            <li class="text-secondary">Dubai Mall (In stock)</li>
                            <li class="text-secondary">Galleria Mall (In stock)</li>
                            <li class="text-secondary">Wafi Mall (In stock)</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item border mb-2">
                      <h2 class="accordion-header">
                        <button class="accordion-button text-secondary fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-sizeTwo" aria-expanded="false" aria-controls="flush-sizeTwo">
                          Black/10-0-uk
                        </button>
                      </h2>
                      <div id="flush-sizeTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <ul>
                            <li class="text-secondary">al ain (In stock)</li>
                            <li class="text-secondary">Dubai Mall (In stock)</li>
                            <li class="text-secondary">Galleria Mall (In stock)</li>
                            <li class="text-secondary">Wafi Mall (In stock)</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item border mb-2">
                      <h2 class="accordion-header">
                        <button class="accordion-button text-secondary fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-sizeThree" aria-expanded="false" aria-controls="flush-sizeThree">
                          Black/10-5-uk
                        </button>
                      </h2>
                      <div id="flush-sizeThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                          <ul>
                            <li class="text-secondary">al ain (In stock)</li>
                            <li class="text-secondary">Dubai Mall (In stock)</li>
                            <li class="text-secondary">Galleria Mall (In stock)</li>
                            <li class="text-secondary">Wafi Mall (In stock)</li>
                          </ul>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="mt-4">
                  <h5 class="offcanvas-title fw-semibold">Our Stores Location</h5>
                  <div class="mt-3 d-flex flex-column">
                    <a href="" class="text-decoration-none link-info text-secondary mb-3"  data-bs-toggle="modal" data-bs-target="#staticBackdropOne">
                      Dubai Mall - Private Collection</a>
                    <a href="" class="text-decoration-none link-info text-secondary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdropTwo">
                      Wafi Mall - Private Collection</a>
                    <a href="" class="text-decoration-none link-info text-secondary mb-3"  data-bs-toggle="modal" data-bs-target="#staticBackdropThree">
                      Yas Mall - Private Collection</a>
                    <a href="" class="text-decoration-none link-info text-secondary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdropFour">
                      Al Ain Mall - Private Collection</a>
                    <a href="" class="text-decoration-none link-info text-secondary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdropFive">
                      Khalidiya - Private Collection</a>
                    <a href="" class="text-decoration-none link-info text-secondary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdropSix">
                      Galleria Mall - Private Collection</a>
                    <a href="" class="text-decoration-none link-info text-secondary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdropSeven">
                      Online - Private Collection</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Sidebar  -->
          <!-- Modal  One -->
          <div class="modal fade rounded-0 border-0" id="staticBackdropOne" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropOneLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg rounded-0 border-0">
              <div class="modal-content rounded-0 border-0">
                <div class="modal-header border-0">
                  <h3 class="modal-title text-black fw-bold" id="staticBackdropOneLabel">Dubai Mall - Private Collection</h3>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-n3">
                  <p class="text-modal m-0">Address:- Level Shoes, Ground Floor, The Dubai Mall</p>
                  <p class="text-modal m-0">City:- Dubai</p>
                  <p class="text-modal m-0">Phone:- <a href="tel:+971 45016960" class="text-decoration-none">+971 45016960</a>, <a href="tel:+971 506291363" class="text-decoration-none">+971 506291363</a></p>
                  <p class="text-modal m-0">Email:- <a href="mailto:pcdubaimall@privatecollection.ae"  class="text-decoration-none">pcdubaimall@privatecollection.ae</a></p>
                  <div class="paoc-popup-margin w-100 paoc-secondary-con mt-2"><p><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3610.19916134305!2d55.27668921538081!3d25.196505237910916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f69f9f8b3637f%3A0x42a8539675afcea4!2sPrivate%20Collection%20-%20The%20Dubai%20Mall!5e0!3m2!1sen!2sae!4v1664525847024!5m2!1sen!2sae"  height="450" class="w-100" allowfullscreen="allowfullscreen"></iframe></p>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!-- Modal  two -->
          <div class="modal fade rounded-0 border-0" id="staticBackdropTwo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropTwoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg rounded-0 border-0">
              <div class="modal-content rounded-0 border-0">
                <div class="modal-header border-0">
                  <h3 class="modal-title text-black fw-bold" id="staticBackdropTwoLabel">Wafi Mall - Private Collection</h3>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-n3">
                  <p class="text-modal m-0">Address:- Shop 246, Atrium 1st Floor, Wafi Mall</p>
                  <p class="text-modal m-0">City:- Dubai</p>
                  <p class="text-modal m-0">Phone:- <a href="tel:+971 45016960" class="text-decoration-none">+971 45016960</a>, <a href="tel:+971 506291363" class="text-decoration-none">+971 506291363</a></p>
                  <p class="text-modal m-0">Email:- <a href="mailto:pcdubaimall@privatecollection.ae"  class="text-decoration-none">pcdubaimall@privatecollection.ae</a></p>
                  <div class="paoc-popup-margin w-100 paoc-secondary-con mt-2"><p><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3609.231172206232!2d55.31615941538128!3d25.229137636594256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5dba83f3be1f%3A0x3b7afdc25ca1f4df!2sWafi%20City%20Mall!5e0!3m2!1sen!2sae!4v1664452389031!5m2!1sen!2sae" class="w-100" height="450" allowfullscreen="allowfullscreen"></iframe></p>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!-- Modal  Three -->
          <div class="modal fade rounded-0 border-0" id="staticBackdropThree" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropThreeLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg rounded-0 border-0">
              <div class="modal-content rounded-0 border-0">
                <div class="modal-header border-0">
                  <h3 class="modal-title text-black fw-bold" id="staticBackdropThreeLabel">Yas Mall - Private Collection
                  </h3>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-n3">
                  <p class="text-modal m-0">Address:- Shop 84, Ground Floor, Yas Mall</p>
                  <p class="text-modal m-0">City:- Abu Dhabi</p>
                  <p class="text-modal m-0">Phone:-<a href="tel:+971 25650515"  class="text-decoration-none">+971 25650515</a>, <a href="tel:+971 561813205"  class="text-decoration-none">+971 561813205</a></p>
                  <p class="text-modal m-0">Email:-<a href="mailto:pcyasmall@privatecollection.ae" class="text-decoration-none">pcyasmall@privatecollection.ae</a></p>
                  <div class="paoc-popup-margin w-100 paoc-secondary-con mt-2"><p><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3630.927499540497!2d54.605890015371884!3d24.48796876611527!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e457dbfef903f%3A0xdd6eaeebc779da67!2sPrivate%20Collection!5e0!3m2!1sen!2sae!4v1664525785672!5m2!1sen!2sae" class="w-100" height="450" allowfullscreen="allowfullscreen"></iframe></p>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!-- Modal  Four -->
          <div class="modal fade rounded-0 border-0" id="staticBackdropFour" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropFourLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg rounded-0 border-0">
              <div class="modal-content rounded-0 border-0">
                <div class="modal-header border-0">
                  <h3 class="modal-title text-black fw-bold" id="staticBackdropFourLabel">Al Ain Mall - Private Collection
                  </h3>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-n3">
                  <p class="text-modal m-0">Address:-Shop 30, Ground Floor, Al Ain Mall</p>
                  <p class="text-modal m-0">City:-  Al Ain</p>
                  <p class="text-modal m-0">Phone:-<a href="tel:+971 37660454" class="text-decoration-none">+971 37660454</a>, <a href="tel:+971 568175926" class="text-decoration-none">+971 568175926</a></p>
                  <p class="text-modal m-0">Email:-<a href="mailto:pcalainmall@privatecollection.ae" class="text-decoration-none">pcalainmall@privatecollection.ae</a></p>
                  <div class="paoc-popup-margin w-100 paoc-secondary-con mt-2"><p><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3638.572530626848!2d55.77952571536839!3d24.221746476522423!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e8ab6e84c6a3593%3A0x67ac0e04adbccac0!2sAl%20Ain%20Mall!5e0!3m2!1sen!2sae!4v1664528807013!5m2!1sen!2sae" class="w-100" height="450" allowfullscreen="allowfullscreen"></iframe></p>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!-- Modal  Five -->
          <div class="modal fade rounded-0 border-0" id="staticBackdropFive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropFiveLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg rounded-0 border-0">
              <div class="modal-content rounded-0 border-0">
                <div class="modal-header border-0">
                  <h3 class="modal-title text-black fw-bold" id="staticBackdropFiveLabel">Khalidiya - Private Collection
                  </h3>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-n3">
                  <p class="text-modal m-0">Address:- Al Mazrui Building, Hamdan St.</p>
                  <p class="text-modal m-0">City:- Abu Dhabi</p>
                  <p class="text-modal m-0">Phone:-<a href="tel:+971 24471267" class="text-decoration-none">+971 24471267</a>, <a href="tel:+971 547335345" class="text-decoration-none">+971 547335345</a></p>
                  <p class="text-modal m-0">Email:-<a href="mailto:pckhalidiya@privatecollection.ae" class="text-decoration-none">pckhalidiya@privatecollection.ae</a></p>
                  <div class="paoc-popup-margin w-100 paoc-secondary-con mt-2"><p><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3631.1341493275027!2d54.348980015371794!3d24.48080836639654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e6676c0928c99%3A0x909f8c79045033b0!2sPrivate%20Collection!5e0!3m2!1sen!2sae!4v1664525646831!5m2!1sen!2sae" class="w-100" height="450" allowfullscreen="allowfullscreen"></iframe></p>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!-- Modal  Six -->
          <div class="modal fade rounded-0 border-0" id="staticBackdropSix" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropSixLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg rounded-0 border-0">
              <div class="modal-content rounded-0 border-0">
                <div class="modal-header border-0">
                  <h3 class="modal-title text-black fw-bold" id="staticBackdropSixLabel">Galleria Mall - Private Collection
                  </h3>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-n3">
                  <p class="text-modal m-0">Address:- Hamouda Bin Ali Al Dhaheri Street 107
                    Sowwah Square , Level 1</p>
                  <p class="text-modal m-0">City:- Abu Dhabi</p>
                  <p class="text-modal m-0">Phone:-<a href="tel:025465527"  class="text-decoration-none">025465527</a></p>
                  <p class="text-modal m-0">Email:-<a href="mailto:pckhalidiya@privatecollection.ae" class="text-decoration-none">pckhalidiya@privatecollection.ae</a></p>
                  <div class="paoc-popup-margin w-100 paoc-secondary-con mt-2"><p><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3630.5412688634156!2d54.38754261541094!3d24.50134636558954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e6654c7d2b66b%3A0xc831a0eff265f238!2sLevel%201%20-%20107%20Hamouda%20Bin%20Ali%20Al%20Dhaheri%20St%20-%20Al%20Maryah%20Island%20-%20Abu%20Dhabi%20Global%20Market%20Square%20-%20Abu%20Dhabi!5e0!3m2!1sen!2sae!4v1667549317618!5m2!1sen!2sae" class="w-100" height="450" allowfullscreen="allowfullscreen"></iframe></p>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!-- Modal  Seven -->
          <div class="modal fade rounded-0 border-0 mt-9" id="staticBackdropSeven" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropSevenLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg rounded-0 border-0">
              <div class="modal-content rounded-0 border-0">
                <div class="modal-header border-0">
                  <h3 class="modal-title text-black fw-bold" id="staticBackdropSevenLabel">Online - Private Collection
                  </h3>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-n3">
                  <p class="text-modal m-0">City:- Dubai</p>
                  <p class="text-modal m-0">Phone:-<a href="tel:+971 45645526"  class="text-decoration-none">+971 45645526</a>, <a href="tel:+971 545703493"  class="text-decoration-none">+971 545703493</a></p>
                  <p class="text-modal m-0">Email:-<a href="mailto:whd3@privatecollection.ae"  class="text-decoration-none">whd3@privatecollection.ae</a></p>
                </div>

              </div>
            </div>
          </div>
          <!-- End Modal Sidebar  -->

        </div>
      </div>
  </section>

  <!-- start swiper  -->
  <section class="py-5 most-section" id="most-selling">
    <div class="container">
      <h3 class="fw-bold text-danger mb-5">@lang('trans.related_products')</h3>
      <div class="most-slide row py-4">

        @foreach($relatedProducts as $product)
          <div class="col-md-4 col-lg-3 col-6">
            <a href="{{route('Client.productDetails',$product->id)}}" class="text-decoration-none">
              <div class="card rounded-4 border-0 p-1 profile-card position-relative">
                <div class="card-body d-flex flex-column">
                  <div class="box rounded-3">
                    <div class="d-flex rounded-3 img-wrapper">
                      <img src="{{asset($product->Gallery()->whereNull('color_id')->first()->image  ?? Setting('not_found_img'))}}" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                    </div>
                  </div>
                  <div class="card-body">
                    <h6 class="text-danger">{{$product['title_'.lang()]}}</h6>
                    <h6 class="text-danger fw-semibold">
                      @if($product->HasDiscount())
                        <span style="text-decoration: line-through; {{lang() == 'en' ? 'margin-right' : 'margin-left'}}: 10px;">
                            {{$product->Price()}}
                        </span>
                        <span>{{$product->PriceWithCurrancy()}}</span>
                      @else
                        <span>{{$product->RealPrice()}}</span> {{Country()->currancy_code}}
                      @endif
                    </h6>
                  </div>
                  <img class="text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom spinner" src="{{ asset('assets_client/images/spinner.png') }}" width="15" height="15" style="right:0; display: none;"></span>
                  @if(checkProductWishlist($product->id) == true)
                    <i class="fa-solid fa-heart position-absolute heartIcon text-info"
                       style="right: 0;"
                       data-product-id="{{ $product->id }}"
                       data-action-url="{{ route('Client.ToggleWishlist') }}">
                    </i>
                  @else
                    <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon"
                       style="right: 0;"
                       data-product-id="{{ $product->id }}"
                       data-action-url="{{ route('Client.ToggleWishlist') }}">
                    </i>
                  @endif
                </div>
              </div>
            </a>
          </div>
        @endforeach

      </div>
    </div>
  </section>
@stop


@section('script')

  <script>
    function showImage(event,imageSrc) {
      event.preventDefault();
      // Get the img-showcase element
      var imgShowcase = document.querySelector('.img-showcase img');
      // Set the src attribute of img-showcase to the clicked image's source
      imgShowcase.classList.add('hidden');

      // Change the image source after the fade out animation completes
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
    $(document).ready(function() {

      // When an image with class colorImage is clicked
      $('.colorImage').click(function() {

        var colorId = $(this).data('color-id');

        var productId = $('input[name="product_id"]').val();

        console.log(productId);
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
