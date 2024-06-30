@php
    $formattedName = formatProductName($product['title_'.lang()]);
@endphp
<a href="{{route('Client.productDetails',['product'=>$product->id,'product_name'=>formatProductName($formattedName)])}}" class="card rounded-4 border-0 p-1 profile-card position-relative text-decoration-none w-100">
<div class="card-body d-flex flex-column">
        <div class="box rounded-3">
            <div class="d-flex rounded-3 img-wrapper">
                <img loading="lazy" src="{{ GalleryImage($product) }}" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
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
        <x-singleProduct.imageColors :product="$product"></x-singleProduct.imageColors>
    </div>
</a>
