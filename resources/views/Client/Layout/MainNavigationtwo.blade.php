<div class="fixed-top scroll-nav bg-primary">
    <!-- Start Navbar  -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                <span class="navbar-toggler-icon"> </span>
            </button>
            <div class="d-block d-lg-none">
                <a class="navbar-brand" href="{{route('Client.home')}}">
                    <img src="{{asset('assets_client/images/22.png')}}" alt="">
                </a>
                <a class="navbar-brand text-white" href="{{route('Client.settings',['type'=>'contact'])}}">
                    @lang('trans.contact')
                </a>
                <a class="navbar-brand text-white" href="{{route('Client.settings',['type'=>'about'])}}">
                    @lang('trans.about')
                </a>
            </div>
            <div class="d-block d-lg-none">
                @if(auth('client')->check())
                <a href="{{route('Client.getWishlist')}}" class="header__icon text-decoration-none mx-2 text-white header__icon--account link focus-inset position-relative">
                    <i class="fa-regular fa-heart fs-5 mx-1">
                        <span class="icon-number position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px;">
                             {{count(Wishlist())?? 0 }}
                        </span>
                    </i>
                </a>
                @endif
                <a href="{{route('Client.getCart')}}" class="header__icon text-decoration-none mx-2 text-white header__icon--account link focus-inset small-hide position-relative">
                    <i class="bi bi-bag fs-5 mx-1">
                        <span class="icon-number position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px; font-style:normal">{{cart_count()??0}}</span>
                    </i>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="input-box me-auto">
          <span class="search" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="fa fa-search search-icon text-white fs-5"></i>
          </span>
                </div>
                <div class="mx-auto d-flex">
                    <a class="navbar-brand" href="{{route('Client.home')}}"><img src="{{asset('assets_client/images/22.png')}}" alt=""></a>
                </div>
                <ul class="navbar-nav ms-5 mb-2 mb-lg-0 align-items-center d-flex">
                    <div class="dropdown border-0 rounded-0">
                        <button class=" dropdown-toggle bg-transparent border-0 text-white mx-2 d-flex align-items-center rounded-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div>
                                <img src="{{asset(Country()->image)}}" alt="" width="20" class="mx-2" />
                            </div>
                            {{Country()['title_'.lang()]}}
                        </button>
                        <ul class="dropdown-menu small-dropdown rounded-0 border-0" style="width: 230px !important;">
                            @foreach(Countries() as $country)
                            <li>
                                <a class="dropdown-item d-flex rounded-0 border-0" href="{{route('Client.changeCountry',$country['id'])}}">
                                    <div>
                                        <img src="{{asset($country->image)}}" alt="" width="15" class="mx-2" />
                                    </div>
                                    {{$country['title_'.lang()]}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        @if(auth('client')->check())
                        <a href="{{route('Client.account')}}" class="header__icon text-decoration-none text-white header__icon--account link focus-inset small-hide">
                        @else
                        <a href="{{route('Client.login')}}" class="header__icon text-decoration-none text-white header__icon--account link focus-inset small-hide">
                        @endif
                            <i class="fa-regular fa-user fs-5 mx-1"></i>
                        </a>
                        @if(auth('client')->check())
                        <a href="{{route('Client.getWishlist')}}" class="header__icon text-decoration-none mx-2 text-white header__icon--account link focus-inset small-hide position-relative">
                            <i class="fa-regular fa-heart fs-5 mx-1">
                                <span class="icon-number position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px;">
                                   {{count(Wishlist())?? 0 }}
                                </span>
                            </i>
                        </a>
                        @endif
                        <a href="{{route('Client.getCart')}}" class="header__icon text-decoration-none mx-2 text-white header__icon--account link focus-inset small-hide position-relative">
                            <i class="bi bi-bag fs-5 mx-1">
                                <span class="icon-number position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px; font-style:normal">{{cart_count()??0}}</span>
                            </i>
                        </a>
                        <a href="{{setting('instagram')}}" class="header__icon text-decoration-none mx-2 text-white header__icon--account link focus-inset small-hide position-relative" target="__blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="{{route('lang',lang() == 'ar'? 'en' : 'ar')}}" class="header__icon text-decoration-none mx-2 text-white header__icon--account link focus-inset small-hide position-relative">
                            {{ lang() == 'ar'? 'English' : 'اللغة العربية'}}
                        </a>
                    </div>
                </ul>


            </div>
        </div>
    </nav>
    <div class="py-2 d-none d-lg-block">
        <div id="containerToShowOnScroll" class="container justify-content-center d-flex align-items-center flex-wrap d-none">
            @php
                $Categories_navbar = Categories()->take(6);
            @endphp

            @forelse($Categories_navbar as $Category)
                @if(count($Category->children) == 0)
                    <a href="{{route('Client.categoryProducts',$Category->id)}}" class="text-white text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 "> {{strtoupper($Category['title_'.lang()])}}</a>
                @else
                    <div class="dropdown">
{{--                        <button class=" dropdown-toggle text-white bg-transparent border-0 dropdown-toggle fw-semibold fs-7" type="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                            {{$Category['title_'.lang()]}}--}}
{{--                        </button>--}}

                        <a class="text-white text-decoration-none fw-semibold nav-link dropdown-toggle nav-hover mx-3 fs-7 " href="{{route('Client.categoryProducts',$Category->id)}}" aria-expanded="false" tabindex="0">
                            {{strtoupper($Category['title_'.lang()])}}
                            <span class="mega-indicator" data-has-click-event="true"></span>
                        </a>

                        <ul class="dropdown-menu mega-sub-menu border-0 rounded-0 shadow">
                            <div class="row">
                                <div class="col-sm-3">
                                    @foreach($Category->children as $SubCategory)
                                        <li><a class="dropdown-item" href="{{route('Client.categoryProducts',$SubCategory->id)}}">  {{$SubCategory['title_'.lang()]}}</a></li>
                                    @endforeach
                                </div>
                            </div>
                        </ul>
                    </div>
                @endif
            @empty
            @endforelse
            <a href="{{route('Client.shop')}}" class="text-white text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">@lang('trans.shop')</a>
            <a href="{{route('Client.getStores')}}" class="text-white text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">@lang('trans.our_stores')</a>
        </div>
    </div>
    <!-- End Navbar  -->
</div>
<!-- Start Modal  -->
<!-- Modal -->
<div class="modal fade rounded-0 border-0 mt-8" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl rounded-0 border-0">
        <div class="modal-content rounded-0 border-0">
            <div class="modal-header border-0 py-4">
                <h1 class="modal-title fs-5" id="SearchModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-5 rounded-0 border-0">
                <div class="row d-flex flex-column justify-content-center align-items-center">
                    <div class="col-sm-10">
                        <form action="{{ route('Client.shop') }}" class="d-flex border-0 shadow" method="get">
                            <input type="text" name="search_product" class="search_product form-control rounded-0 border-0" placeholder="Search" value="{{ $request->search_product ?? '' }}" data-product-details-route="{{ route('Client.productDetails', '') }}">
                            <button type="submit" class="btn btn-white rounded-0"> <span class="fa fa-search form-control-feedback text-info"></span></button>
                        </form>
                        <ul class="search_results d-block shadow" style="display: none;"></ul>
                    </div>
                    <div class="mt-5 col-sm-10 text-center">
                        <h5 class="text-danger fw-semibold">@lang('trans.enter_search_keyword')</h5>
                    </div>
                    <div class="mt-4 mb-3 col-sm-10 d-flex justify-content-center flex-wrap">
                        @php
                            $Categories_search = AllCategories();
                        @endphp
                        @forelse($Categories_search as $Category)
                            <div class="mx-2">
                                <a href="{{route('Client.categoryProducts',$Category->id)}}" class="btn btn-outline-warning text-decoration-none btn-max rounded-1 py-1 mb-3">{{$Category['title_'.lang()]}}</a>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
            </div>
        </div>
    </div>
</div>
<!-- End Modal  -->
