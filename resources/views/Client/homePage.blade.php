@extends('Client.Layout.index')

@section('title')
{{--    @lang('trans.Turtle_for_shoes')--}}
@stop

@section('style')
    <style>
        .color-img{
            padding: 13px;
            width: 20px;
            height: 20px;
            border: solid 1px;
            border-radius: 50%;
        }

        .carousel-caption-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .carousel-caption {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            text-align: center;
        }
    </style>
@stop

@section('content')
    <!------------ header ------------>
    <header class="header overflow-hidden ">
        <!-- header navbar -->
    @include('Client.Layout.MainNavigation')
    <!-- header content --> 
{{--        <div  id="video-background" >--}}
{{--            <img src="{{setting('homepage_image')}}" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">--}}
{{--            <!-- Semi-transparent overlay -->--}}
{{--            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.2);"></div>--}}
{{--        </div>--}}
{{--        <div class="container py-4" style="max-height:500px">--}}
{{--            <section class="row d-flex align-items-center justify-content-center flex-md-row pb-3">--}}
{{--                <!-- content >> text -->--}}
{{--                <div class="col-md-12 col-sm-12">--}}
{{--                    <div class="vh-100"></div>--}}
{{--                </div>--}}
{{--            </section>--}}
{{--        </div>--}}
    </header>
    <!------------ header end ------------>
    <!-- start main_slider -->
    <div class="main_slider">
        <div class="main_header position-relative ltr">

            @php
                $sliders = [setting('homepage_image'),setting('homepage_image')];
            @endphp
            <div id="sliders" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($sliders as $key => $slider)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="disc position-relative">
                                <img style="width:100%;" src="{{$slider}}" class="img-fluid" alt="image">
                                <div class="carousel-caption-overlay"></div>
                                <div class="carousel-caption d-none d-md-block">
{{--                                    <h1 class="more_bold" style="color:white;">{{ $slider['title_' . app()->getlocale()] }}</h1>--}}
{{--                                    <p class="teny_font" style="color:white; font-size:20px;">{!! $slider['desc_' . app()->getlocale()] !!}</p>--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($sliders && count($sliders) > 1)
                    <div class="container">
                        <button class="carousel-control-prev" type="button" data-bs-target="#sliders" data-bs-slide="prev">
                            <i class="icon-chevron-left1 main_color h1"></i>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#sliders" data-bs-slide="next">
                            <i class="icon-chevron-right1 main_color h1"></i>
                        </button>
                    </div>
                @endif
            </div>

        </div>

    </div>
    <div class="container">
        <h4 class="text-center" style="margin-top:30px">@lang('trans.Turtle_for_shoes')</h4>
        <div class="row py-4">
            @foreach($allProducts as $product)
                <div class="col-md-4 col-lg-4 col-6">
                    <x-singleProduct.productShop :product="$product"></x-singleProduct.productShop>
                </div>
            @endforeach
        </div>
    </div>

@stop


@section('script')
{{--  Wishlist code in  @extends('Client.Layout.index')  --}}

<script>
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



</script>
@stop
