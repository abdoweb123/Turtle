<?php

namespace Modules\Product\Http\Controllers;

use App\Functions\Upload;
use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Model as Category;
use Modules\Color\Entities\Model as Color;
use Modules\Product\Entities\Gallery;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductItem;
use Modules\Product\Http\Requests\ProductRequest;
use Modules\Size\Entities\Model as Size;
use Rap2hpoutre\FastExcel\FastExcel;

class ProductController extends BasicController
{
    public function import_products(Request $request)
    {
        $collection = (new FastExcel)->import($request->file);
        foreach($collection as $collection_item){
            if (str_contains($collection_item['Vendor Code'], 'T0')) {
                $Product = Product::where('title_ar', $collection_item['Vendor Code'])->orwhere('title_en',$collection_item['Vendor Code'])->first();
                if(!$Product){
                    $Product = Product::create([
                        'title_ar'=> $collection_item['Vendor Code'],
                        'title_en'=> $collection_item['Vendor Code'],
                        'price'=> 20,
                        'most_popular'=> 1,
                    ]);
                }
                $Color = Color::where('title_ar', $collection_item['Color'])->orwhere('title_en',$collection_item['Color'])->first();
                if(!$Color){
                    $Color = Color::create([
                        'title_ar'=> $collection_item['Color'],
                        'title_en'=> $collection_item['Color'],
                    ]);
                }
                $quantity = $Product->quantity;
                $productColorSizes = [];
                for($i=39;$i<=47;$i++){
                    if($collection_item[$i]){         
                        $quantity += $collection_item[$i];
                        $productColorSizes[] = [
                            'color_id' => $Color->id,
                            'parent_size_id' => 1,
                            'size_id' => $i,
                            'quantity' => $collection_item[$i],
                        ];
                    }
                }
                $Product->quantity = $quantity;
                $Product->original_quantity = $quantity;
                $Product->save();
                $Product->Items()->createMany($productColorSizes);
            }
        }
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->route('admin.products.index');
        
    }
    
    public function index(Request $request)
    {
        $Products = Product::get();

        return view('product::products.index', compact('Products'));
    }

    public function create()
    {
        $Categories = Category::whereNull('parent_id')->with(['children' => function ($query) {
            $query->with(['Products', 'Parent'])->withCount('Products');
        }])->get();

        return view('product::products.create', compact('Categories'));
    }


    public function store(ProductRequest $request)
    {
        // Access the merged data
        $value = $request->input('key');

        $maxOrder = Product::max('order');

        $Product = Product::create($request->only('title_ar', 'title_en', 'short_desc_ar', 'short_desc_en', 'long_desc_ar', 'long_desc_en','weight','price', 'discount_from', 'discount_to', 'discount_value', 'material'));
        $Product->update([
            'quantity' => $request->product_quantity,
            'order' => $maxOrder + 1,
        ]);

        $this->store_update($Product->id, $request);

        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->route('admin.products.edit', $Product);
    }


    public function show($id)
    {
        return redirect()->route('admin.products.edit', ['product' => $id]);
    }

    public function edit($id)
    {
        $Product = Product::with(['Gallery', 'Categories'])->where('id', $id)->firstorfail();

        $ProductItems = ProductItem::where('product_id',$Product->id)->get();

        $Categories = Category::whereNull('parent_id')->with(['children' => function ($query) use ($id) {
            $query->with(['Parent', 'Products' => function ($query2) use ($id) {
                $query2->whereNot('products.id', $id);
            }])->withCount('Products');
        }])->get();
        $Categories = Category::whereNull('parent_id')->with(['children' => function ($query) {
            $query->with(['Products', 'Parent'])->withCount('Products');
        }])->get();

        $Colors = Color::Active()->get();

        return view('product::products.edit', compact('Product', 'Categories','ProductItems'));
    }


    public function update(ProductRequest $request, $id)
    {
        $Product = Product::where('id', $id)->firstOrFail();
        $Product->update($request->only('title_ar', 'title_en', 'short_desc_ar', 'short_desc_en', 'long_desc_ar', 'long_desc_en','weight','price', 'discount_from', 'discount_to', 'discount_value','material'));
        $Product->update(['quantity' => $request->product_quantity]);

        $this->store_update($id, $request);

        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->back();
    }


    public function destroy($id)
    {
        $Product = Product::where('id', $id)->delete();
    }



    public function gallery(Request $request,$id)
    {
        $Product = Product::with(["Gallery" => function($q){
            $q->WhereNull('color_id')->orwhere('color_id',request('color_id'));

        }])->where('id', request('product_id'))->firstorfail();

        if(request('color_id')){
            $Color = Color::where('id',request('color_id'))->first();
            return view('product::products.gallery', compact('Product','Color'));
        }else{
             $Colors = Color::whereIn('id', function ($query) use ($Product) {
                $query->select('color_id')
                    ->from('product_item')
                    ->where('product_id', $Product->id)
                    ->get();
            })->get();

            return view('product::products.gallery', compact('Product','Colors'));
        }

    }

    public function post_gallery(Request $request)
    {
//        return $request;
        $Product = Product::where('id', request('product_id'))->firstorfail();


        if ($request->old_gallery) {
            Upload::deleteImages($Product->Gallery()->where('color_id',request('color_id'))->whereNotIn('image', $request->old_gallery)->pluck('image')->toarray());
            $Product->Gallery()->where('color_id',request('color_id'))->whereNotIn('image', $request->old_gallery)->delete();
        }


        if ($request->hasFile('header')) {
            $galleryImage = $Product->Gallery()->where('color_id', request('color_id'))->first();

            if ($galleryImage) {
                Upload::deleteImages([$galleryImage->image]);
            }

            // Use the updateOrCreate method only if $galleryImage is not null
            if ($galleryImage) {
                $galleryImage->update([
                    'image' => Upload::UploadFile($request->header, 'Products'),
                ]);
            } else {
                // If $galleryImage is null, create a new gallery image
                $Product->Gallery()->create([
                    'color_id'=>request('color_id'),
                    'image' => Upload::UploadFile($request->header, 'Products'),
                ]);
            }
        }

        if ($request->gallery) {
            foreach ($request->gallery as $gallery) {
                $Product->Gallery()->create([
                    'color_id'=>request('color_id'),
                    'image' => Upload::UploadFile($gallery, 'Products'),
                ]);
            }
        }


        alert()->success(__('trans.updatedSuccessfully'));
        
        return back();
    }




    public function store_update($id, Request $request)
    {
        $Product = Product::where('id', $id)->first();

        $Product->Items()->delete();
        $colors = $request->colors;
        $parentSizes = $request->parent_sizes;
        $subSizes = $request->sub_sizes;
        $quantities = $request->quantity;
        $productColorSizes = [];
        foreach ($colors as $index => $colorId) {
            $productColorSizes[] = [
                'color_id' => $colorId,
                'parent_size_id' => $parentSizes[$index],
                'size_id' => $subSizes[$index],
                'quantity' => $quantities[$index],
            ];
        }
        $Product->Items()->createMany($productColorSizes);


         // if no children take the parent
        // Check if $request->categories is empty or contains only null values
        if (!isset($request->categories) || empty(array_filter($request->categories))) {
            // Use $request->categoryParent_id as the category ID
            $categoryIds = $request->categoryParent_id;
        } else {
            // Use $request->categories as the category ID
            $categoryIds = $request->categories;
        }
        $Product->Categories()->sync(array_filter((array) $categoryIds));


        if ($request->old_gallery) {
            Upload::deleteImages($Product->Gallery()->whereNotIn('image', $request->old_gallery)->pluck('image')->toarray());
            $Product->Gallery()->whereNotIn('image', $request->old_gallery)->delete();
        }


        if ($request->hasFile('header')) {
            $galleryImage = $Product->Gallery()->first();

            if ($galleryImage) {
                Upload::deleteImages([$galleryImage->image]);
            }

            // Use the updateOrCreate method only if $galleryImage is not null
            if ($galleryImage) {
                $galleryImage->update([
                    'image' => Upload::UploadFile($request->header, 'Products'),
                ]);
            } else {
                // If $galleryImage is null, create a new gallery image
                $Product->Gallery()->create([
                    'image' => Upload::UploadFile($request->header, 'Products'),
                ]);
            }
        }

        if ($request->gallery) {
            foreach ($request->gallery as $gallery) {
                $Product->Gallery()->create([
                    'image' => Upload::UploadFile($gallery, 'Products'),
                ]);
            }
        }

    }


    /*** To change product(product) to most_popular or not ***/
    public function changeMostPopular(Product $product)
    {
        if ($product->most_popular == '1'){
            $new_most_popular = '0';
        }
        else{
            $new_most_popular = '1';
        }

        $product->update(['most_popular' => $new_most_popular]);

        return response()->json(['most_popular' => $product->most_popular]);
    }


    /*** Get subCategories by ajax ***/
    public function getSubSizes(Request $request)
    {
        $parentSizeId = $request->input('parent_size_id');
        $subSizes = Size::where('parent_id', $parentSizeId)->get();

        return response()->json($subSizes);
    }


    public function updateOrder(Request $request)
    {
        $order = $request->input('order');

        foreach ($order as $id => $position) {
            Product::where('id', $id)->update(['order' => $position]);
        }

        return response()->json(['success' => true, 'message' => 'Product order updated successfully']);
    }


    // To find nearest weight
    public static function findNearestWeight($weight) {
        $weightRates = [
            0.5, 1.0, 1.5, 2.0, 2.5, 3.0, 3.5, 4.0, 4.5,
            5.0, 5.5, 6.0, 6.5, 7.0, 7.5, 8.0, 8.5, 9.0,
            9.5, 10.0, 11.0, 12.0, 13.0, 14.0, 15.0, 16.0,
            17.0, 18.0, 19.0, 20.0
        ];

        $nearestWeight = null;
        $minDifference = PHP_FLOAT_MAX;

        foreach ($weightRates as $rate) {
            $difference = abs($weight - $rate);
            if ($difference < $minDifference) {
                $minDifference = $difference;
                $nearestWeight = $rate;
            }
        }

        return $nearestWeight;
    }
    // To find weight of cart's products
    public static function findWeightPrice($weight,$country_id)
    {
      $price =  DB::table('delivery_weight')
            ->where('country_id',$country_id)
            ->where('weight',$weight)
            ->value('price');

      return $price;
    }

    public static function getWeightAndPrice($cart)
    {
        // Get total weight of product cart
        $totalCartWeight = $cart->sum(function ($item) {
            return $item->product->weight;
        });

        // To get nearest weight
        $totalCartWeight = ProductController::findNearestWeight($totalCartWeight);

        // To get price cart product weight
        if (auth('client')->user()->address){
            $totalCartWeightPrice = ProductController::findWeightPrice($totalCartWeight,auth('client')->user()->address->country_id);
        }else{
            $totalCartWeightPrice = null;
        }

        return [
            'totalCartWeight'=>$totalCartWeight,
            'totalCartWeightPrice'=>$totalCartWeightPrice,
        ];
    }

} //end of class
