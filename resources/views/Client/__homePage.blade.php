@extends('Client.Layout.index')

@section('title')
    @lang('trans.homepage')
@stop


@section('content')
    <!------------ header ------------>
    <header class="header overflow-hidden ">
        <!-- header navbar -->
    @include('Client.Layout.MainNavigation')
    <!-- header content -->
        <div  id="video-background" >
            <img src="{{setting('homepage_image')}}" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
            <!-- Semi-transparent overlay -->
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
        </div>
        <div class="container py-4" style="max-height:500px">
            <section class="row d-flex align-items-center justify-content-center flex-md-row pb-3">
                <!-- content >> text -->
                <div class="col-md-12 col-sm-12">
                    <div class="vh-100"></div>
                </div>
            </section>
        </div>
    </header>
    <!------------ header end ------------>


    <!-- start section  -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                @forelse($services as $service)
                    <div class="col-lg-3">
                        <img src="{{asset($service->file)}}" alt="" style="width:25px; height:25px; margin: 2px">
                        {{$service['title_'.lang()]}}
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
    <!-- end section -->


    <!-- Start Slider Related projects -->
    <section class="py-5 most-section" id="most-selling">
        <div class="container">
            <h3 class="fw-bold text-danger mb-5">{{$mainCategory['title_'.lang()]}}</h3>
            <div class="most-slide row py-4">
                @foreach($mainCategory->Products as $product)
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
    <!-- Start Slider Related projects -->

    <!-- Start Slider most projects -->
    <section class="py-5 most-section" id="most-selling">
        <div class="container">
            <h3 class="fw-bold text-danger mb-5">@lang('trans.most_popular')</h3>
            <div class="most-slide row py-4">
                @foreach($mostPopularProducts as $product)
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
    <!-- Start Slider most projects -->

    <!-- start Newsletter -->
    <section class="bg-danger py-6">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center flex-column mx-auto">
                    <h3 class="text-white fw-bold">@lang('trans.sign_up_newsletter')</h3>
                    <p class="text-white">@lang('trans.sign_up_newsletter_desc')
                    </p>
                    <form id="subscribeForm" class="d-flex col-10">
                        @csrf
                        <input type="email" id="emailInput" class="form-control" name="email" required="">
                        <div class="tnp-field tnp-field-button">
                            <button id="subscribeButton" class="btn btn-info rounded-1 text-white mx-1">@lang('trans.subscribe_v')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--end  Newsletter -->

@stop


@section('script')
{{--  Wishlist code in  @extends('Client.Layout.index')  --}}

<!-- Include SweetAlert2 CDN -->
{{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>--}}

{{--<!-- Initialize SweetAlert -->--}}
{{--<script>--}}
{{--    @if (session('alert'))--}}
{{--    Swal.fire({--}}
{{--        --}}{{--title: "{{ session('alert')['title'] }}",--}}
{{--        text: "{{ session('alert')['message'] }}",--}}
{{--        icon: "{{ session('alert')['type'] }}"--}}
{{--    });--}}
{{--    @endif--}}
{{--</script>--}}
@stop
