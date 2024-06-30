<?php

namespace App\Http\Controllers\Client;

use App\Functions\WhatsApp;
use App\Http\Controllers\BasicController;
use App\Mail\OrderSummary;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Modules\Ad\Entities\Model as Ad;
use Modules\Address\Entities\Model as Address;
use Modules\Client\Entities\Model as Client;
use Modules\Service\Entities\Model as Service;
use Modules\Product\Entities\Gallery;
use Modules\Product\Entities\ProductItem;
use Modules\Product\Entities\Wishlist;
use Modules\Size\Entities\Model;
use Modules\Subscriber\Entities\Model as Subscriber;
use Modules\Product\Entities\Product;
use Modules\Order\Entities\Model as Order;
use Modules\Color\Entities\Model as Color;
use Modules\Size\Entities\Model as Size;
use Modules\Category\Entities\Model as Category;
use Modules\Slider\Entities\Model as Slider;
use Illuminate\Support\Facades\Session;

class HomeController extends BasicController
{
    // Home Page
    public function home()
    {
        $services = Service::Active()->get();
        $mainCategory = Categories()->where('appearInHomepage',1)->first();
        $mostPopularProducts = Product::query()->where('most_popular',1)->get();

        $allProducts = Product::whereHas('Gallery', function ($query) {
            $query->whereNotNull('color_id')
                ->skip(1)->take(1); // This ensures that Gallery[1] has an image
        })
            ->orWhereHas('Gallery', function ($query) {
                $query->whereNotNull('color_id')
                    ->take(1); // This ensures that Gallery[0] has an image
            })
            ->orderBy('order')
            ->get();

        return view('Client.homePage', compact('mainCategory','mostPopularProducts','services','allProducts'));
    }

    // searchProducts (ajax)
    public function searchProducts(Request $request)
    {
        $searchTerm = $request->input('search_product');

        // Query products based on the search term
        $products = Product::where('id', 'like', '%' . $searchTerm . '%')
            ->orWhere('title_ar',  'like', '%' . $searchTerm . '%')
            ->orWhere('title_en',  'like', '%' . $searchTerm . '%')
            ->select('id','title_'.lang().' as title')
            ->get();



        return response()->json($products);
    }


    // store subscriber
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ], [
            'email.required' => __('validation.required', ['attribute' => __('validation.attributes.email')]),
            'email.email' => __('validation.email'),
            'email.unique' => __('validation.unique', ['attribute' => __('validation.attributes.email')])
        ]);

        Subscriber::create($request->all());

        if ($request->ajax()) {
            return response()->json(['message' => __('trans.subscribedSuccessfully')]);
        } else {
            session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.subscribedSuccessfully')]);
            return back();
        }
    }


    // change country
    public function changeCountry($id)
    {
        // To change country in (config)
        $country =  Countries()->where('id',$id)->first();
        session()->put('country',$country->id);
        Country($country->id);

        return redirect()->back();
    }


    // Get famous questions
    public function getFaqs()
    {
        $Faqs = FAQ();
        return view('Client.faqs',compact('Faqs'));
    }


    // Get Stores (branches)
    public function getStores()
    {
        $stores = Branches();
        return view('Client.store',compact('stores'));
    }


    /*** Get details of product ***/
    public function productDetails(Product $product)
    {
        // return $product;
        $product->increment('viewed'); // for viewed products

        $productSizes = Size::whereHas('items',function($q) use($product){
            $q->where('product_id',$product->id);
        })->with('items')->get();

        // get colors first images
        $productFirstColorImages = $product->Gallery->whereNotNull('color_id')->groupBy('color_id')->map(function ($group) {
            return $group->first()->load('color');
        });

        // To get related products
        //  $categoryIds = $product->Categories->pluck('id');
        $categoryIds = $product->categories()->pluck('categories.id');
        $relatedProducts = Product::where('products.id', '!=', $product->id)
            ->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            })
            ->get();

        // To get services
        $services = Service::Active()->get();

        return view('Client.product-details',compact('product','relatedProducts','productFirstColorImages','productSizes','services'));
    }


    /*** Get getSizesByColor ***/
    public function getSizesByColor(Request $request)
    {
        $sizes = ProductItem::where('product_id', $request->input('product_id'))
            ->where('color_id', $request->input('color_id'))->pluck('size_id');

        return response()->json($sizes);
    }


    /*** Get getItemByColorSize ***/
    public function getItemByColorSize(Request $request)
    {
        $item = ProductItem::where('product_id', $request->input('product_id'))
            ->where('color_id', $request->input('color_id'))
            ->where('size_id', $request->input('size_id'))->first();

        return response()->json($item);
    }


} //end of class
