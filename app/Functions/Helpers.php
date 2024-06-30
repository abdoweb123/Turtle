<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Modules\Branch\Entities\Model as Branch;
use Modules\Color\Entities\Model as Color;
use Modules\Country\Entities\Country;
use Modules\Delivery\Entities\Model as Delivery;
use Modules\Product\Entities\Product as Product;
use Modules\FAQ\Entities\Model as FAQ;
use Modules\Order\Entities\Model as Order;
use Modules\Payment\Entities\Model as Payment;
use Modules\Setting\Entities\Model as Setting;
use Modules\Size\Entities\Model as Size;
use Modules\Address\Entities\Model as Address;


function format_number($number)
{
//    return number_format($number, Country()->decimals, '.', '');
    return number_format($number, Country()->decimals);
}

function client_id()
{
    if (auth('client')->check()) {
        return auth('client')->id();
    } else {
        if (! session()->get('client_id')) {
            session()->put('client_id', rand(99999, 999999));
        }

        return session()->get('client_id');
    }
}


//function guest_id()
//{
//    if (! session()->get('guest_id')) {
//        session()->put('guest_id', rand(99999, 999999));
//    }
//
//    return session()->get('guest_id');
//}


function lang($lang = null)
{
    if (isset($lang)) {
        return app()->islocale($lang);
    } else {
        return app()->getlocale();
    }
}

function CurrentOrders()
{
    if (! Config::get('CurrentOrders')) {
        Config::set('CurrentOrders', Order::latest()->with('Branch', 'Client.Country', 'Products', 'Address')->where('status', 0)->get());
    }

    return Config::get('CurrentOrders');
}
function PreviousOrders()
{
    if (! Config::get('PreviousOrders')) {
        Config::set('PreviousOrders', Order::latest()->with('Branch', 'Client.Country', 'Products', 'Address')->where('status', 1)->get());
    }

    return Config::get('PreviousOrders');
}


function cart_count()
{
    if (! Config::get('cart_count')) {
        Config::set('cart_count', Cart::where('client_id', client_id())->count() );
    }

    return Config::get('cart_count');
}


function Wishlist()
{
    if (! Config::get('Wishlist')) {
        Config::set('Wishlist', Product::whereIn('id', DB::table('wishlist')->where('client_id', client_id())->pluck('product_id'))->get());
    }

    return Config::get('Wishlist');
}


//function Wishlist()
//{
//    return session()->get('wishlist',[]);
//}


function checkProductWishlist($id)
{
    $productWishlist = DB::table('wishlist')->where('client_id', client_id())->where('product_id',$id)->first();
    if ($productWishlist)
        return true;
    else
        return false;
}




function FAQ()
{
    if (! Config::get('FAQ')) {
        Config::set('FAQ', FAQ::Active()->get());
    }

    return Config::get('FAQ');
}



function Colors()
{
    if (! Config::get('Colors')) {
        Config::set('Colors', Color::Active()->get());
    }

    return Config::get('Colors');
}


function Color($id)
{
    return Color::Active()->find($id);
}

function Sizes()
{
    if (! Config::get('Sizes')) {
        Config::set('Sizes', Size::Active()->whereNull('parent_id')->get());
    }

    return Config::get('Sizes');
}

function Size($id)
{
    return Size::Active()->find($id);
}


function subSizes()
{
    if (! Config::get('subSizes')) {
        Config::set('subSizes', Size::Active()->whereNotNull('parent_id')->get());
    }

    return Config::get('subSizes');
}

function Deliveries()
{
    if (! Config::get('Deliveries')) {
        Config::set('Deliveries', Delivery::Active()->get());
    }

    return Config::get('Deliveries');
}

function Branches()
{
    if (! Config::get('Branches')) {
        Config::set('Branches', Branch::Active()->get());
    }

    return Config::get('Branches');
}

function Payments()
{
    if (! Config::get('Payments')) {
        Config::set('Payments', Payment::Active()->get());
    }

    return Config::get('Payments');
}


// to get the RECENTLY VIEWED PRODUCTS
function productHighViewed($products,$num)
{
    if (! Config::get('viewedProducts')) {
        Config::set('viewedProducts', $products->orderByDesc('viewed')->get()->take($num));
    }

    return Config::get('viewedProducts');
}

function Countries()
{
    if (! Config::get('Countries')) {
        Config::set('Countries', Country::Active()->get());
    }

    return Config::get('Countries');
}

function Country($id = NULL)
{
    if(request()->route()->getName() == 'Client.submit'){
        $id = 1;
    }else{
        $id = $id ?? (session()->get('country') ?? 1);
    }
    if (! Config::get('Country')) {
        Config::set('Country', Countries()->where('id', $id)->first());
    }

    return Config::get('Country');
}


function mainCountry()
{
    if (! Config::get('mainCountry')) {
        Config::set('mainCountry', Countries()->where('id', 1)->first()); //Bahrain
    }

    return Config::get('mainCountry');
}

//function addressCountry($data = NULL)
//{
//    if (! session()->get('addressCart')) {
//        session()->set('addressCart', Countries()->where('id', $id)->first());
//    }
//
//    return session()->get('addressCart');
//}


function addressShipping()
{
    if (! Config::get('addressShipping')) {
        Config::set('addressShipping', Address::where('client_id',client_id())->first());
    }

    return Config::get('addressShipping');
}


//function shippingType($type=null)
//{
//    $shippingType = session()->get('shippingType');
//
//    if ($shippingType){
//        if ($type != null  && $shippingType != $type){
//            session()->set('shippingType', $type);
//        }
//    }
//    else {
//        session()->set('shippingType', 2); // pickup store
//    }
//
//    return session()->get('shippingType');
//}

function shippingType($type = null)
{
    $shippingType = session()->get('shippingType');

    if ($type !== null && $shippingType !== $type) {
        session(['shippingType' => $type]);
        $shippingType = $type;
    } elseif ($shippingType === null) {
        session()->put('shippingType', 2);
        $shippingType = 2;
    }
    return $shippingType;
}


function Settings()
{
    if (! Config::get('Settings')) {
        Config::set('Settings', Setting::Active()->get());
    }

    return Config::get('Settings');
}

function setting($key)
{
    return Settings()->where('key', $key)->first()?->value;
}

function DT_Lang()
{
    if (lang('ar')) {
        return '//cdn.datatables.net/plug-ins/1.10.16/i18n/Arabic.json';
    } else {
        return '//cdn.datatables.net/plug-ins/1.10.16/i18n/English.json';
    }
}

function percent($percentage, $total)
{
    return ($percentage / 100) * $total;
}

function IsVideo($path)
{
    return str_contains($path, 'm4v') || str_contains($path, 'mpg') || str_contains($path, 'mp4');
}


function Categories()
{
    if (! Config::get('Categories')) {
        Config::set('Categories', \Modules\Category\Entities\Model::whereNull('parent_id')->orderBy('arrangement')->with('children')->withCount('children')->Active()->get());
    }

    return Config::get('Categories');
}



function AllCategories()
{
    if (! Config::get('AllCategories')) {
        Config::set('AllCategories', \Modules\Category\Entities\Model::whereHas('Products')->orderBy('arrangement')->Active()->get());
    }

    return Config::get('AllCategories');
}

function GalleryImage($product)
{
    return $product->Gallery[1]->image ?? ($product->Gallery[0]->image ?? '') ;
}


if (!function_exists('formatProductName')) {
    function formatProductName($productName)
    {
        // Replace spaces with hyphens
        $formattedName = str_replace(' ', '-', $productName);

        // Remove trailing hyphen if the final word ends with one
        if (substr($formattedName, -1) === '-') {
            $formattedName = rtrim($formattedName, '-');
        }

        return $formattedName;
    }
}

