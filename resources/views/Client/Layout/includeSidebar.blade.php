<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header bg-white">
        <h5 class="offcanvas-title text-primary" id="offcanvasWithBothOptionsLabel"><img src="{{asset('assets_client/images/WhatsApp Image 2024-02-25 at 11.png')}}" alt=""> </h5>
        <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body bg-white">
        <div class="input-group border">

            <div class="col-12">
                <form action="{{ route('Client.shop') }}" class="d-flex border-0" method="get">
                    <input type="text" name="search_product" class="search_product form-control rounded-0 border-0" placeholder="Search" id="search_product_sidebar"
                           value="{{ $request->search_product ?? '' }}" data-product-details-route="{{ route('Client.productDetails', '') }}"
                    >
                    <button type="submit" class="btn btn-white rounded-0">
                        <span class="fa fa-search form-control-feedback text-info"></span></button>
                </form>
                <ul class="search_results d-block shadow" style="display: none;"></ul>
            </div>

            {{--            <input type="text" class="form-control border-0" placeholder="Search this blog">--}}
            {{--            <div class="input-group-append">--}}
            {{--                <button class="btn btn-secondary rounded-0 bg-transparent text-info border-0" type="button">--}}
            {{--                    <i class="fa fa-search"></i>--}}
            {{--                </button>--}}
            {{--            </div>--}}
        </div>
        @php
            $Categories_navbar = Categories()->take(6);
        @endphp
        <ul class="navbar-nav hover-links" style="{{lang()=='ar'? 'padding-right: 0;':''}}">

            @forelse($Categories_navbar as $Category)
                @if(count($Category->children) == 0)
                    <li class="nav-item py-1 border-bottom ">
                        <a href="{{route('Client.categoryProducts',$Category->id)}}" class="text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">{{strtoupper($Category['title_'.lang()])}}</a>
                    </li>
                @else
                    <div class="accordion border-0" id="accordionExample_{{$Category->id}}">
                        <div class="accordion-item border-bottom border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo_{{$Category->id}}" aria-expanded="false" aria-controls="collapseTwo_{{$Category->id}}">
                                    {{strtoupper($Category['title_'.lang()])}}
                                </button>
                            </h2>
                            <div id="collapseTwo_{{$Category->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample_{{$Category->id}}">
                                <div class="accordion-body">
                                    <ul>
                                        @foreach($Category->children as $SubCategory)
                                            <li class="list-unstyled"><a class="dropdown-item" href="{{route('Client.categoryProducts',$SubCategory->id)}}">  {{$SubCategory['title_'.lang()]}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
            @endforelse
            <li class="nav-item py-1 border-bottom">
                <a href="{{route('Client.shop')}}" class="text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">@lang('trans.shop')</a>
            </li>
            <li class="nav-item py-1 border-bottom">
                <a href="{{route('Client.getStores')}}" class="text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">@lang('trans.our_stores') </a>
            </li>
            <li class="nav-item py-1 border-bottom">
                @if(auth('client')->check())
                    <a href="{{route('Client.account')}}" class="text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7">
                        @lang('trans.my_account')
                @else
                    <a href="{{route('Client.login')}}" class="text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7">
                        @lang('trans.login')
                @endif
                    </a>
            </li>
            <li class="nav-item py-1 border-bottom">
                <a href="{{route('Client.getWishlist')}}" class="text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">@lang('trans.wishlist') </a>
            </li>
            <li class="nav-item py-1 border-bottom">
                <a href="{{route('Client.getCart')}}" class="text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">@lang('trans.cart') </a>
            </li>
            <div class="accordion border-0 border-bottom" id="accordionExample_countries">
                <div class="accordion-item border-bottom border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold px-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo_countries" aria-expanded="false" aria-controls="collapseTwo_countries">
                            <img src="{{asset(Country()->image)}}" alt="" width="20" class="mx-2" />  {{Country()['title_'.lang()]}}
                        </button>
                    </h2>
                    <div id="collapseTwo_countries" class="accordion-collapse collapse" data-bs-parent="#accordionExample_countries">
                        <div class="accordion-body">
                            <ul class="px-3">
                                @foreach(Countries() as $country)
                                    <li class="list-unstyled">
                                        <a class="dropdown-item" href="{{route('Client.changeCountry',$country['id'])}}">
                                            <img src="{{asset($country->image)}}" alt="" width="15" class="mx-2" />  {{$country['title_'.lang()]}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <li class="nav-item py-1 border-bottom">
                    <a href="{{route('lang',lang() == 'ar'? 'en' : 'ar')}}" class="text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">
                        {{ lang() == 'ar'? 'English' : 'اللغة العربية'}}
                    </a>
            </li>
        </ul>
    </div>
</div>









