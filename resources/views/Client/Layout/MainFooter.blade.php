<footer class="py-5">
    <div class="container">
        <div class="row">
            <!-- start one  -->
{{--            <div class="col-lg-4 col-md-6 col-sm-6 mt-4 mt-md-0">--}}
{{--                <!-- Logo  -->--}}
{{--                <div class="logo">--}}
{{--                    <a href="{{route('Client.home')}}"><img src="{{asset('assets_client/images/WhatsApp Image 2024-02-25 at 11.png')}}" alt="Logo"></a>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- start two  -->
            <div class="col-lg-4 col-md-6 col-sm-6 mt-4 mt-md-0">
                <h6 class="text-danger fw-semibold mb-4">@lang('trans.information')</h6>
                <div class="d-flex flex-column hover-links">
                    <a href="{{route('Client.settings',['type'=>'about'])}}" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i>@lang('trans.about')</a>
                    <a href="{{route('Client.settings',['type'=>'contact'])}}" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i>@lang('trans.contact')</a>
                    <a href="{{route('Client.faqs')}}" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i>@lang('trans.FAQ')</a>
                    <a href="{{route('Client.settings','terms')}}" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i>@lang('trans.Terms and Conditions')</a>
                </div>
            </div>
{{--            <div class="col-lg-4 col-md-6 col-sm-6 mt-4 mt-md-0">--}}
{{--                <h6 class="text-danger fw-semibold mb-4">@lang('trans.top_category')</h6>--}}
{{--                <div class="d-flex flex-column hover-links">--}}

{{--                    @php--}}
{{--                        $Categories_footer = Categories()->take(6);--}}
{{--                    @endphp--}}

{{--                    @foreach($Categories_footer as $Category)--}}
{{--                        <a href="{{route('Client.categoryProducts',$Category->id)}}" class="text-decoration-none text-danger fs-7 mb-2 link-info">--}}
{{--                            <i class="fa fa-angle-right fs-7 mx-1"></i> {{$Category['title_'.lang()]}}--}}
{{--                        </a>--}}
{{--                    @endforeach--}}
{{--                </div>--}}

{{--            </div>--}}
            <!-- start three  -->
            <div class="col-lg-4 col-md-6 col-sm-6 mt-4 mt-md-0">
                <h6 class="text-danger fw-semibold mb-4">@lang('trans.useful_links')</h6>
                <div class="d-flex flex-column hover-links">
{{--                    <a href="{{route('Client.getWishlist')}}" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> @lang('trans.wishlist')</a>--}}
{{--                    <a href="{{route('Client.account')}}" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> @lang('trans.my_account')</a>--}}
{{--                    <a href="{{route('Client.checkout')}}" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> @lang('trans.checkout')</a>--}}
{{--                    <a href="{{route('Client.getCart')}}" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> @lang('trans.cart')</a>--}}
                    <a href="{{route('Client.shop')}}" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> @lang('trans.shop')</a>
                    <a href="{{route('Client.getStores')}}" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> @lang('trans.our_stores')</a>
                </div>
            </div>
            <!-- start four  -->
            <div class="col-lg-4 col-md-6 col-sm-6 mt-4 mt-md-0">
                <h6 class="text-danger fw-semibold mb-4">@lang('trans.contact_us')</h6>
                <div class="d-flex flex-column hover-links">
                    <div class="d-flex mb-4">
                        <div class="icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="conent mx-3">
                            {{Branches()->first()['title_'.lang()]}}
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="conent mx-3">
                            {{Branches()->first()->Country->phone_code. ' ' .Branches()->first()['phone']}}
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="conent mx-3">
                            {{Branches()->first()['email']}}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</footer>
<div class="py-3 bg-light">
    <div class="container text-center">
        <span class="text-danger">© Copyright 2024 <a href="https://emcan-group.com/en" class="text-decoration-none text-danger link-info">Emcan Solutions</a> All Rights Reserved.  </span>
    </div>
</div>