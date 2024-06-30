@extends('Client.Layout.index')

@section('title')
  @lang('trans.shop')
@stop

@section('style')
  <style>
    section .btn-info{
      padding: 0px 7px !important;
      border-radius: 2px !important;
    }

    .show_not_authenticate_yet{
      /*display: block;*/
      opacity: 1 !important;
      background-color: #00000066;
    }
  </style>
@stop

@section('content')
  <!------------ header ------------>
  @include('Client.Layout.header')
  <!------------ header end ------------>

  <!-- start NEW COLLECTION -->
  <section class="py-3 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="d-flex justify-content-between">
            <h4 class="fw-semibold"> {{strtoupper(__('trans.shop'))}}</h4>
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
              <span class="mx-1"> {{strtoupper(__('trans.shop'))}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end NEW COLLECTION -->
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
  <section class="py-5 border-bottom">
    <div class="container">
      <div class="row">
        <button  class="btn btn-link d-lg-none"  type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight1" aria-controls="offcanvasRight">
          <i class="bi bi-filter-square-fill text-primary fs-1 d-flex justify-content-end p-0"></i>
        </button>
        <!--=========== start sidebar tabs =========-->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight1" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <img src="images/chemical-guys-logo.svg" alt="">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">

            <div class="col-12 rounded-1 p-4 d-block h-100">
              <form id="categoryProductsForm1" action="{{route('Client.shop',['search'=>'search'])}}" method="post">
                @csrf
                <button type="submit" class="btn btn-info rounded-0 main-btn btn-hover text-center mb-2 px-3 py-1">@lang('trans.search')</button>
                <a href="{{route('Client.shop')}}" class="btn btn-info rounded-0 main-btn btn-hover text-center mb-2 px-3 py-1" style="background-color: #24262733 !important; border-color: #9bbfd133 !important;">
                  <i class="vc_icon_element-icon fa fa-refresh px-1"></i>
                  @lang('trans.clear')
                </a>
                @if(Categories())
                  <div class="border-bottom"  style="max-height: 300px; overflow-y: auto;">
                    <h6 class="text-danger fw-bold">@lang('trans.filter_by_categories')</h6>
                    @forelse(Categories() as $category)
                      <div class="form-check d-flex">
                        <input class="form-check-input checkCategory" type="checkbox" name="categories[]" value="{{$category->id}}" @if($request->categories && in_array($category->id,$request->categories)) checked @endif>
                        <label class="form-check-label text-secondary fs-7 {{lang()=='en'?'mx-2':'mx-5'}}" for="flexCheckDefault">
                          {{$category['title_'.lang()]}}
                        </label>
                      </div>
                      @forelse($category->children as $subCategory)
                        <div class="form-check d-flex">
                          <input class="form-check-input checkCategory" type="checkbox" name="categories[]" value="{{$subCategory->id}}" @if($request->categories && in_array($subCategory->id,$request->categories)) checked @endif>
                          <label class="form-check-label text-secondary fs-7 {{lang()=='en'?'mx-2':'mx-5'}}" for="flexCheckDefault">
                            {{$subCategory['title_'.lang()]}}
                          </label>
                        </div>
                      @empty
                      @endforelse
                    @empty
                    @endforelse
                  </div>
                @endif
              <!-- checks and FILTER BY SIZE -->
                @if(count($sizesOfProducts) > 0)
                  <div class="border-bottom"  style="max-height: 300px; overflow-y: auto;">
                    <h6 class="text-danger fw-bold">@lang('trans.filter_by_size')</h6>
                    @forelse($sizesOfProducts as $size)
                      <div class="form-check d-flex">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label text-secondary fs-7 {{lang()=='en'?'mx-2':'mx-5'}}" for="checkCategory">
                          {{$size->title. ' '. $size->parent->title}}
                        </label>
                      </div>
                    @empty
                    @endforelse
                  </div>
                @endif
                @if(count($colorsOfProducts) > 0)
                  <div class="mt-4">
                    <h6 class="text-danger fw-bold">@lang('trans.filter_by_color')</h6>
                    <div class=" row">
                      <div class="col-10 d-flex flex-wrap justify-content-between">
                        @if (!is_null($request->colors) && is_array($request->colors))
                          @forelse($request->colors as $color)
                            <input type="hidden" name="colors[]" value="{{$color}}">
                          @empty
                          @endforelse
                        @endif
                        @forelse($colorsOfProducts as $color)
                          <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue">
                            <span class="color-inp col-sm-2 mb-2 @if($request->colors && in_array($color['id'],$request->colors)) selected @endif" data-id="{{$color->id}}" style="background-color:{{$color->hexa}};"></span>
                          </div>
                        @empty
                        @endforelse
                      </div>
                    </div>
                  </div>
                  <div class="border-bottom mt-3"></div>
                @endif
                <input type="hidden" name="sorting" value="{{$request->sorting?? ''}}">
              </form>
              <div class="border-bottom mt-3"></div>
              <!-- RECENTLY VIEWED PRODUCTS -->
              @if(count($highestViewedProducts)>0)
                <div class="mt-4">
                  <h6 class="text-danger fw-bold">@lang('trans.recently_viewed_products')</h6>
                  @foreach($highestViewedProducts as $product)
                    <a class="d-flex align-items-center text-decoration-none mb-3" href="{{route('Client.productDetails',$product->id)}}">
                      <div>
                        <img src="{{asset($product->Gallery()->whereNotNull('color_id')->first()->image ?? Setting('not_found_img'))}}" alt="" width="70">
                      </div>
                      <div class="mx-3">
                        <p class="m-0 fs-7 text-black">{{$product['title_'.lang()]}}</p>
                        <p class="m-0 fs-7 fw-semibold text-info">
                          @if($product->HasDiscount())
                            <span style="text-decoration: line-through; {{lang() == 'en' ? 'margin-right' : 'margin-left'}}: 10px;">
                                {{$product->Price()}}
                            </span>
                            <span>{{$product->PriceWithCurrancy()}}</span>
                          @else
                            <span>{{$product->RealPrice()}}</span> {{Country()->currancy_code}}
                          @endif
                        </p>
                      </div>
                    </a>
                  @endforeach
                </div>
                <div class="border-bottom mt-3"></div>
            @endif

            <!-- Social Info -->
              <div class="mt-4">
                <h4 class="text-danger"> @lang('trans.SocialMedia')</h4>
                <div>
                  <a href="{{Setting('facebook') ?? '#'}}" class="text-decoration-none" target="_blank">
                    <i class="fa-brands fa-facebook text-info fs-4 mx-2"></i>
                  </a>
                  <a href="{{Setting('instagram') ?? '#'}}" class="text-decoration-none" target="_blank">
                    <i class="fa-brands fa-instagram text-info fs-4 mx-2"></i>
                  </a>
                  <a href="{{Setting('linkedin') ?? '#'}}" class="text-decoration-none" target="_blank">
                    <i class="fa-brands fa-linkedin text-info fs-4 mx-2"></i>
                  </a>
                  <a href="{{Setting('twitter') ?? '#'}}" class="text-decoration-none" target="_blank">
                    <i class="fa-brands fa-twitter text-info fs-4 mx-2"></i>
                  </a>
                </div>
              </div>

            </div>

          </div>
        </div>

        <!--=========== End sidebar tabs =========-->
        <div class="col-md-3 d-none d-lg-block">
          <form id="categoryProductsForm2" action="{{route('Client.shop',['search'=>'search'])}}" method="post">
            @csrf
            <a href="{{route('Client.shop')}}" class="btn btn-info rounded-0 main-btn btn-hover text-center mb-2 px-3 py-1" style="background-color: #24262733 !important; border-color: #9bbfd133 !important;">
              <i class="vc_icon_element-icon fa fa-refresh px-1"></i>
              @lang('trans.clear')
            </a>
            <button type="submit" class="btn btn-info rounded-0 main-btn btn-hover text-center mb-2 px-3 py-1">@lang('trans.search')</button>

            @if(Categories())
              <div class="border-bottom"  style="max-height: 300px; overflow-y: auto;">
                <h6 class="text-danger fw-bold">@lang('trans.filter_by_categories')</h6>
                @forelse(Categories() as $category)
                  <div class="form-check d-flex">
                    <input class="form-check-input checkCategory" type="checkbox" name="categories[]" value="{{$category->id}}" @if($request->categories && in_array($category->id,$request->categories)) checked @endif>
                    <label class="form-check-label text-secondary fs-7 {{lang()=='en'?'mx-2':'mx-5'}}" for="flexCheckDefault">
                      {{$category['title_'.lang()]}}
                    </label>
                  </div>
                  @forelse($category->children as $subCategory)
                    <div class="form-check d-flex">
                      <input class="form-check-input checkCategory" type="checkbox" name="categories[]" value="{{$subCategory->id}}" @if($request->categories && in_array($subCategory->id,$request->categories)) checked @endif>
                      <label class="form-check-label text-secondary fs-7 {{lang()=='en'?'mx-2':'mx-5'}}" for="flexCheckDefault">
                        {{$subCategory['title_'.lang()]}}
                      </label>
                    </div>
                  @empty
                  @endforelse
                @empty
                @endforelse
              </div>
            @endif

            @if(count($sizesOfProducts) > 0)
            <!-- checks and FILTER BY SIZE -->
              <div class="border-bottom mt-4"  style="max-height: 300px; overflow-y: auto;">
                <h6 class="text-danger fw-bold">@lang('trans.filter_by_size')</h6>
                @forelse($sizesOfProducts as $size)
                  <div class="form-check d-flex">
                    <input class="form-check-input" type="checkbox" name="sizes[]" value="{{$size->title}}" @if($request->sizes && in_array($size['title'],$request->sizes)) checked @endif>
                    <label class="form-check-label text-secondary fs-7 {{lang()=='en'?'mx-2':'mx-5'}}" for="flexCheckDefault">
                      {{$size->title. ' '. $size->parent->title}}
                    </label>
                  </div>
                @empty
                @endforelse
              </div>
            @endif

            @if(count($colorsOfProducts) > 0)
              <div class="mt-4">
                <h6 class="text-danger fw-bold">@lang('trans.filter_by_color')</h6>
                <div class=" row">
                  <div class="col-10 d-flex flex-wrap">
                    @if (!is_null($request->colors) && is_array($request->colors))
                      @forelse($request->colors as $color)
                        <input type="hidden" name="colors[]" value="{{$color}}">
                      @empty
                      @endforelse
                    @endif
                    @forelse($colorsOfProducts as $color)
                      <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue">
                        <span class="color-inp col-sm-2 mb-2 @if($request->colors && in_array($color['id'],$request->colors)) selected @endif" data-id="{{$color->id}}" style="background-color:{{$color->hexa}};"></span>
                      </div>
                    @empty
                    @endforelse
                  </div>
                </div>
              </div>
              <div class="border-bottom mt-3"></div>
            @endif

            <div class="border-bottom mt-4"  style="max-height: 300px; overflow-y: auto;">
              <h6 class="text-danger fw-bold"> @lang('trans.filter_by_material')</h6>
              <div class="form-check d-flex">
                <input class="form-check-input" type="checkbox" value="1" name="material[]"  @if($request->material && in_array(1,$request->material)) checked @endif >
                <label class="form-check-label text-secondary fs-7 {{lang()=='en'?'mx-2':'mx-5'}}" for="flexCheckDefault">
                  @lang('trans.exotic_leather')
                </label>
              </div>
              <div class="form-check d-flex">
                <input class="form-check-input" type="checkbox" value="2" name="material[]"  @if($request->material && in_array(2,$request->material)) checked @endif>
                <label class="form-check-label text-secondary fs-7 {{lang()=='en'?'mx-2':'mx-5'}}" for="flexCheckDefault">
                  @lang('trans.non_exotic_leather')
                </label>
              </div>
            </div>

            <input type="hidden" name="sorting" value="{{$request->sorting?? ''}}">
          </form>

          <!-- RECENTLY VIEWED PRODUCTS -->
          @if(count($highestViewedProducts)>0)
            <div class="mt-4">
              <h6 class="text-danger fw-bold">@lang('trans.recently_viewed_products')</h6>
              @foreach($highestViewedProducts as $product)
                <a class="d-flex align-items-center text-decoration-none mb-3" href="{{route('Client.productDetails',$product->id)}}">
                  <div>
                    <img src="{{asset($product->Gallery()->whereNotNull('color_id')->first()->image ?? Setting('not_found_img'))}}" alt="" width="70">
                  </div>
                  <div class="mx-3">
                    <p class="m-0 fs-7 text-black">{{$product['title_'.lang()]}}</p>
                    <p class="m-0 fs-7 fw-semibold text-info">
                      @if($product->HasDiscount())
                        <span style="text-decoration: line-through; {{lang() == 'en' ? 'margin-right' : 'margin-left'}}: 10px;">
                            {{$product->Price()}}
                        </span>
                        <span>{{$product->PriceWithCurrancy()}}</span>
                      @else
                        <span>{{$product->RealPrice()}}</span> {{Country()->currancy_code}}
                      @endif
                    </p>
                  </div>
                </a>
              @endforeach
            </div>
            <div class="border-bottom mt-3"></div>
        @endif


        <!-- Social Info -->
          <div class="mt-4">
            <h4 class="text-danger">@lang('trans.SocialMedia')</h4>
            <div>
              <a href="{{Setting('facebook') ?? '#'}}" class="text-decoration-none" target="_blank">
                <i class="fa-brands fa-facebook text-info fs-4 mx-2"></i>
              </a>
              <a href="{{Setting('instagram') ?? '#'}}" class="text-decoration-none" target="_blank">
                <i class="fa-brands fa-instagram text-info fs-4 mx-2"></i>
              </a>
              <a href="{{Setting('linkedin') ?? '#'}}" class="text-decoration-none" target="_blank">
                <i class="fa-brands fa-linkedin text-info fs-4 mx-2"></i>
              </a>
              <a href="{{Setting('twitter') ?? '#'}}" class="text-decoration-none" target="_blank">
                <i class="fa-brands fa-twitter text-info fs-4 mx-2"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-9">
          <!-- start header  -->
          <div class="d-flex justify-content-between">
            <p class="mt-2 text-secondary d-none d-md-flex"> @lang('trans.all_results') {{count($allProducts)}} </p>
            <div class="d-flex">
              {{-- <div class="mx-2 mt-2 d-none d-lg-flex">
                 <span class="fw-semibold text-secondary fs-7 mx-1">Show </span>
                 <span class="text-secondary fs-7 mx-1">9 </span>
                 <span class="text-secondary fs-7 mx-1">/ </span>
                 <span class="text-secondary fs-7 mx-1">12 </span>
                 <span class="text-secondary fs-7 mx-1">/ </span>
                 <span class="text-secondary fs-7 mx-1">15 </span>
               </div>--}}
              <div>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link  d-none d-md-block" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa-solid fa-border-all"></i></button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa-solid fa-table-cells"></i></button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link  d-none d-md-block" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fa-solid fa-grip"></i></button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false"><i class="fa-solid fa-bars"></i></button>
                  </li>
                </ul>
              </div>
              <div>
                <select id="sortSelect" class="form-select" aria-label="Default select example" name="sort">
                  @foreach(Modules\Product\Entities\Product::getSortingOptions() as $value => $label)
                    <option value="{{ $value }}" {{ $request->sorting == $value ? 'selected' : '' }}>{{ __($label) }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <!-- end header  -->

          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
              <!-- start cards  -->
              <div class="row py-4">
                @foreach($allProducts as $product)
                  <div class="col-md-6 col-lg-6 col-6">
                    <a href="{{route('Client.productDetails',$product->id)}}" class="card rounded-4 border-0 p-1 profile-card position-relative text-decoration-none">
                      <div class="card-body d-flex flex-column">
                        <div class="box rounded-3">
                          <div class="d-flex rounded-3 img-wrapper">
                            <img src="{{asset($product->Gallery()->whereNotNull('color_id')->first()->image ?? Setting('not_found_img'))}}" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="..." data-image="{{$product->Gallery()->whereNotNull('color_id')->first()->color['title_'.lang()]}}">
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
                        <div>
                          <div class="row" style="justify-content: space-around;">
                            @php $count = 1 @endphp
                            @forelse($product->Gallery()->whereNotNull('color_id')->groupBy('color_id')->get() as $gallery)
                              {{--                                  @if($count < 3)--}}
                              <div class="col-sm-2 col-3">
                                <div class="m-0 p-0">
                                  <img src="{{asset($gallery->image)}}" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="" data-image="{{$gallery->color['title_'.lang()]}}">
                                </div>
                              </div>
                            @empty
                            <!-- No galleries found -->
                            @endforelse
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                @endforeach
              </div>
            </div>

            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
              <!-- start cards  -->
              <div class="row py-4">
                @foreach($allProducts as $product)
                  <a href="{{route('Client.productDetails',$product->id)}}" class="card rounded-4 border-0 p-1 profile-card col-md-4 col-lg-4 col-6 position-relative text-decoration-none">
                    <div class="card-body d-flex flex-column">
                      <div class="box rounded-3">
                        <div class="d-flex rounded-3 img-wrapper">
                          <img src="{{asset($product->Gallery()->whereNotNull('color_id')->first()->image ?? Setting('not_found_img'))}}" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="..." data-image="{{$product->Gallery()->whereNotNull('color_id')->first()->color['title_'.lang()]}}">
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
                      <div class="row" style="justify-content: space-around;">
                        @forelse($product->Gallery()->whereNotNull('color_id')->groupBy('color_id')->get() as $gallery)
                          <div class="col-sm-2 col-3">
                            <div class="m-0 p-0">
                              <img src="{{asset($gallery->image)}}" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="" data-image="{{$gallery->color['title_'.lang()]}}">
                            </div>
                          </div>

                        @empty
                        <!-- No galleries found -->
                        @endforelse
                      </div>

                    </div>
                  </a>
                @endforeach
              </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
              <!-- start cards  -->
              <div class="row py-4">
                @foreach($allProducts as $product)
                  <div class="col-md-4 col-lg-3 col-6">
                    <a href="{{route('Client.productDetails',$product->id)}}" class="text-decoration-none">
                      <div class="card rounded-4 border-0 p-1 profile-card position-relative">
                        <div class="card-body d-flex flex-column">
                          <div class="box rounded-3">
                            <div class="d-flex rounded-3 img-wrapper">
                              <img src="{{asset($product->Gallery()->whereNotNull('color_id')->first()->image ?? Setting('not_found_img'))}}" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="..." data-image="{{$product->Gallery()->whereNotNull('color_id')->first()->color['title_'.lang()]}}">
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
                          <div class="row" style="justify-content: space-around;">
                            @forelse($product->Gallery()->whereNotNull('color_id')->groupBy('color_id')->get() as $gallery)
                              <div class="col-sm-3 col-3">
                                <div class="m-0 p-0">
                                  <img src="{{asset($gallery->image)}}" class="border rounded-1 border-img tooltip-img imageTooltip" width="30" alt="" data-image="{{$gallery->color['title_'.lang()]}}">
                                </div>
                              </div>
                            @empty
                            <!-- No galleries found -->
                            @endforelse

                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">
              <!-- start cards  -->
              <div class="row py-4">
                @foreach($allProducts as $product)
                  <a href="{{route('Client.productDetails',$product->id)}}" class="text-decoration-none">
                    <div class="card rounded-4 border-0 p-1 profile-card col-md-12 col-lg-12 col-12 position-relative">
                      <div class="card-body d-flex flex-row align-items-center position-relative">
                        <div class="box rounded-3 col-4">
                          <div class="d-flex rounded-3 img-wrapper position-relative">
                            <img src="{{asset($product->Gallery()->whereNotNull('color_id')->first()->image ?? Setting('not_found_img'))}}" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="..." data-image="{{$product->Gallery()->whereNotNull('color_id')->first()->color['title_'.lang()]}}">
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
                          <div class="row">
                            @forelse($product->Gallery()->whereNotNull('color_id')->groupBy('color_id')->get() as $gallery)
                              <div class="col-sm-2 col-3">
                                <div class="m-0 p-0">
                                  <img src="{{asset($gallery->image)}}" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="" data-image="{{$gallery->color['title_'.lang()]}}">
                                </div>
                              </div>
                            @empty
                            <!-- No galleries found -->
                            @endforelse

                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                  <div class="border-bottom mt-3"></div>
                @endforeach

              </div>
            </div>
            </a>
            <!-- end cards  -->
            </a>
          </div>
        </div>

      </div>
  </section>
@stop


@section('script')
  <script>
    {{--  Wishlist code in  @extends('Client.Layout.index')  --}}
    $(document).ready(function(){

      // For filter with colors
      $(".color-inp").click(function(){
        // Toggle the 'selected' class on the clicked color box
        $(this).toggleClass("selected");

        // Get the color value from the clicked color box
        var colorValue = $(this).data('id');

        // Check if the color box is selected
        if ($(this).hasClass("selected")) {
          // If selected, append a hidden input field with the color value to the form
          $("<input>").attr({
            type: "hidden",
            name: "colors[]",
            value: colorValue
          }).appendTo("form");
        } else {
          // If deselected, remove the hidden input field with the corresponding color value from the form
          $("input[name='colors[]'][value='" + colorValue + "']").remove();
        }
      });

      // To send <form> when choose sorting
      document.getElementById('sortSelect').addEventListener('change', function() {
        var form;
        if (window.innerWidth > 700) {
          form = document.getElementById('categoryProductsForm1');
          console.log("Screen width is greater than 700: " + window.innerWidth);
          form['sorting'].value = this.value;
          form.submit();
        } else {
          form = document.getElementById('categoryProductsForm2');
          console.log("Screen width is less than or equal to 700: " + window.innerWidth);
          form['sorting'].value = this.value;
          form.submit();
        }

      });

    });


    // To change main image
    document.addEventListener("DOMContentLoaded", function() {
      var cards = document.querySelectorAll('.card');

      cards.forEach(function(card) {
        var thumbnailImages = card.querySelectorAll('.border-img');
        var imgWrapper = card.querySelector('.img-wrapper');

        thumbnailImages.forEach(function(image) {
          image.addEventListener('click', function(event) {
            event.preventDefault();

            var src = this.getAttribute('src');

            var imgElement = imgWrapper.querySelector('img');
            imgElement.setAttribute('src', src);
          });
        });
      });
    });


    document.addEventListener('DOMContentLoaded', function() {
      // Select all anchor tags within the parent container
      const productLinks = document.querySelectorAll('.tab-pane a');

      // Attach click event listener to each link
      // productLinks.forEach(function(link) {
      //     link.addEventListener('click', function(event) {
      //         event.preventDefault(); // Prevent the default link navigation
      //
      //         // Find the closest img child within the same a element
      //         const img = link.querySelector('img');
      //         if (img) {
      //             const imageSrc = img.getAttribute('src');
      //
      //             // Append the imageSrc as a query parameter to the link's URL
      //             const newUrl = new URL(link.href);
      //             newUrl.searchParams.set('imageSrc', imageSrc);
      //
      //             // Redirect to the new URL
      //             window.location.href = newUrl.toString();
      //         }
      //     });
      // });
    });




  </script>
@stop
