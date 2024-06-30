@extends('Client.Layout.index')

@section('title')
    @lang('trans.our_stores')
@stop

@section('link')
{{--    <script src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_KEY')}}&callback=initMap" async defer></script>--}}
@stop


@section('content')
    <!------------ header ------------>
    @include('Client.Layout.header')
    <!------------ header end ------------>

    <!-- start Our Store -->
    <section class="pb-5 border-bottom">
        <div class="container-fluid">
            <div class="row p-0 m-0 border mx-3">
                <div class="d-flex align-items-start m-0 p-0 flex-lg-row flex-column" style="overflow: auto;">
                    <div class="col-lg-8 col-12 order-sm-1 order-lg-2">
                        <div class="parent-container" style="position: relative;">
                            {{--
                           <div class="col-left leftsidebar slide-left left-skip wpml_search_right" style="position: absolute; top: 0; right: 0;">

                           <div class="map-search-window" id="wpm-search-bar">

                             <div class="search-options-btn">
                               <a class="wpml-toggle-box" id="Toggle-Search">
                                 <i class="fa-solid fa-bars"></i>
                               </a>
                               Search Options
                             </div>

                             <div class="store-search-fields show_store_locator" style="display: none;" id="show-store-searc">
                               <form id="store_locator_search_form">
                                 <div class="store_locator_field">
                                   <input id="store_locatore_get_btn" class="btn btn-black rounded-0 col-12 mt-2" type="button" value="Get My Location">
                                 </div>
                                 <div class="store_locator_field">
                                   <input id="store_locatore_search_input" class="wpsl_search_input pac-target-input form-control mt-2" name="store_locatore_search_input" type="text" placeholder="Location / Zip Code" autocomplete="off">
                                 </div>
                                 <div class="store_locator_field mt-2">
                                   <select id="store_locatore_search_radius" name="store_locatore_search_radius" class="wpsl_search_radius form-select">
                                     <option value="5">5 km</option>
                                     <option value="10">10 km</option>
                                     <option value="25" selected="">25 km</option>
                                     <option value="200">200 km</option>
                                     <option value="500">500 km</option>
                                   </select>
                                 </div>
                                 <div class="store_locator_field hide-field">
                                   <select name="store_locator_category" id="wpsl_store_locator_category" class="wpsl_locator_category form-select mt-2">
                                     <option value="">Select Category </option>
                                     <option value="658"> Sandal </option>
                                   </select>
                                 </div>
                                 <div class="store_locator_field">
                                   <select  class="wpsl_locator_category select2-hidden-accessible form-select">
                                     <option value="" disabled="" selected="">
                                       Select Tags
                                     </option>
                                   </select>
                                   <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr">
                                     <span class="dropdown-wrapper" aria-hidden="true"></span>
                                   </span>
                                 </div>
                                 <div class="mt-2">
                                   <input type="search" class="form-control" placeholder="search here .." required="" name="" id="">
                                 </div>
                                 <div class="store_locator_field">
                                   <div class="map-btns">
                                     <span>
                                       <input id="store_locatore_search_btn" class="btn btn-black rounded-0 fs-7 mt-3 mb-2" type="submit" value="Search">
                                     </span>
                                   </div>
                                 </div>
                               </form>
                             </div>

                            </div>
                          </div>
                          --}}
                            <div class="tab-content" id="v-pills-tabContent" style="overflow: hidden">
                                <div id="map" style="min-height:450px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12 order-sm-2 order-lg-1" style="overflow: auto; max-height: 450px;">
                            <div class="bg-primary w-100">
                                <h5 class="text-white text-center py-2">@lang('trans.locations')</h5>
                            </div>
                            <div class="nav flex-column nav-pills m-0 p-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                @foreach($stores as $index=>$store)
                                    <button class="nav-link {{$index==0?'active': ''}}" id="v-pills-{{$store->id}}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{$store->id}}" type="button" role="tab" aria-controls="v-pills-{{$store->id}}" aria-selected="true"  onclick="initMap({{ $store->lat }}, {{ $store->long }})">
                                        <div class="d-flex">
                                            <div>
                                                <div class="circle-count">{{$loop->iteration}}</div>
                                            </div>
                                            <div class="mx-2 d-flex flex-column w-100">
                                                <h6 class="wpsl-name text-secondary fs-7 fw-semibold mt-1">{{env('APP_NAME')}} - {{$store['title_'.lang()]}}</h6>
                                                <div class="d-flex justify-content-between ">
                                                    <div class="d-flex flex-column  justify-content-start align-items-start">
                                                        <div>
{{--                                                            <a href="" class="btn btn-black rounded-1 py-1 px-4 fs-7">1.39 km</a>--}}
                                                        </div>
                                                        <p id="locationText" class="text-secondary locationText fs-7 mt-1 m-0 p-0">{{$store['address_'.lang()]}} - {{$store['title_'.lang()]}}</p>
                                                        <p class="text-secondary fs-7 m-0 p-0"> {{$store->Regions()->first()['title_'.lang()]}} </p>
                                                        <div class="d-flex align-items-center m-0 p-0">
                                                            <a href="tel:{{$store->phone}}" class="d-flex justify-content-between fs-7 flex-row text-decoration-none">
                                                                {{$store->phone}}
                                                            </a>
                                                            <div class="social-links mx-2">
                                                                <a href="https://wa.me/{{$store->whatsapp}}" class="d-flex align-items-center justify-content-center rounded-5 fs-5" target="_blank">
                                                                    <i class="bi bi-whatsapp"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex">
                                                            <a href="{{env('APP_URL')}}" target="_blank" class="text-decoration-none fs-small">@lang('trans.visit_website')</a>
                                                            <a href="https://www.google.com/maps?daddr={{$store->lat}},{{$store->long}}" target="_blank" class="text-decoration-none fs-small mx-1">@lang('trans.get_direction')</a>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <img src="{{ asset($store->image ?? setting('logo')) }}" width="70" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                    <div class="border-bottom"></div>
                                @endforeach
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end Our Store -->

@stop


@section('script')
    <script>
        function initMap() {
            const mapOptions = {
                zoom: 10 // Adjust zoom level as needed
            };

            const map = new google.maps.Map(document.getElementById("map"), mapOptions);

            // Loop through the stores array and add markers
            const stores = @json($stores); // Access data passed from Blade
            for (const store of stores) {
                const marker = new google.maps.Marker({
                    position: { lat: store.latitude, lng: store.longitude },
                    map: map,
                    // Add custom icons or info windows if needed
                });
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var locationText = document.querySelector(".locationText");

            if (document.documentElement.dir === "rtl") {
                locationText.style.textAlign = "end";
            } else {
                locationText.style.textAlign = "start";
            }
        });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('Toggle-Search').addEventListener('click', function() {
                var accordion = document.getElementById('show-store-searc');
                if (accordion.style.display === 'none') {
                    accordion.style.display = 'block';
                    setTimeout(function() {
                        accordion.style.opacity = '1';
                    }, 50);
                } else {
                    accordion.style.opacity = '0';
                    setTimeout(function() {
                        accordion.style.display = 'none';
                    }, 300);
                }
            });
        });

    </script>

    <!-- To put locations of stores on maps -->
    <script>
        function initMap(lat, long) {
            // Create a map centered at the specified location
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: { lat: parseFloat(lat), lng: parseFloat(long) }
            });

            // Add a marker for the specified location
            var marker = new google.maps.Marker({
                position: { lat: parseFloat(lat), lng: parseFloat(long) },
                map: map
            });
        }

        // Call initMap for the first store to display its map by default
        window.onload = function() {
            var firstStore = {!! json_encode($stores[0]) !!};
            initMap(firstStore.lat, firstStore.long);
        };
    </script>
    <!-- Replace YOUR_API_KEY with your actual Google Maps API key -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap" async defer></script>

@stop













{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <title>Show Locations on Map</title>--}}
{{--    <style>--}}
{{--        #map {--}}
{{--            height: 400px;--}}
{{--            width: 100%;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<h1>Locations on Map</h1>--}}

{{--@foreach($stores as $index => $store)--}}
{{--    <div class="map-container" onclick="initMap({{ $store->lat }}, {{ $store->long }})">--}}
{{--       tttttttttttt <button >Show Location</button>--}}
{{--    </div>--}}
{{--@endforeach--}}

{{--<div id="map"></div>--}}

{{--<script>--}}
{{--    function initMap(lat, long) {--}}
{{--        // Create a map centered at the specified location--}}
{{--        var map = new google.maps.Map(document.getElementById('map'), {--}}
{{--            zoom: 10,--}}
{{--            center: { lat: parseFloat(lat), lng: parseFloat(long) }--}}
{{--        });--}}

{{--        // Add a marker for the specified location--}}
{{--        var marker = new google.maps.Marker({--}}
{{--            position: { lat: parseFloat(lat), lng: parseFloat(long) },--}}
{{--            map: map--}}
{{--        });--}}
{{--    }--}}

{{--    // Call initMap for the first store to display its map by default--}}
{{--    window.onload = function() {--}}
{{--        var firstStore = {!! json_encode($stores[0]) !!};--}}
{{--        initMap(firstStore.lat, firstStore.long);--}}
{{--    };--}}
{{--</script>--}}
{{--<!-- Replace YOUR_API_KEY with your actual Google Maps API key -->--}}
{{--<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap" async defer></script>--}}

{{--</body>--}}
{{--</html>--}}


