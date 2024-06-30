<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Model as Category;
use Modules\Product\Entities\ProductItem;
use Modules\Color\Entities\Model as Color;


class CategoryController extends BasicController
{

    public function categoryProducts(Request $request, Category $category)
    {
        $allProducts = Product::query();
        $products = Product::query();

        // To get sizes that have relations with products of categories
        $sizesOfProducts = $this->sizesOfProducts($allProducts);

        // To get colors that have relations with products of categories
        $colorsOfProducts = $this->colorsOfProducts($allProducts);

        // To get category's products and its children's products (if exists)
        $allProducts =  $this->filterCategories($category);

        // Get Highest Viewed Products
        $highestViewedProducts = productHighViewed($products,3);

        // To perform filters if there is/are request(s)
        if ($request)
        {
            $allProducts = $this->search($request,$allProducts);
        }

        $allProducts = $allProducts->orderBy('order')->get();

        if ($request){
            return view('Client.categoryProducts',compact('category','sizesOfProducts','colorsOfProducts','allProducts','highestViewedProducts','request'));
        }
        return view('Client.categoryProducts',compact('category','sizesOfProducts','colorsOfProducts','allProducts','highestViewedProducts'));
    }



    public function shop(Request $request)
    {
        $allProducts = Product::query()->whereHas('Gallery', function ($query) {
            $query->whereNotNull('color_id')
                ->skip(1)->take(1); // This ensures that Gallery[1] has an image
        });

        $products = Product::query()->whereHas('Gallery', function ($query) {
            $query->whereNotNull('color_id')
                ->skip(1)->take(1); // This ensures that Gallery[1] has an image
        });

        // To perform filters if there is/are request(s)
        if ($request)
        {
            $allProducts = $this->search($request,$allProducts);
        }

        // To get sizes that have relations with products of categories
        $sizesOfProducts = $this->sizesOfProducts($allProducts);

        // To get colors that have relations with products of categories
        $colorsOfProducts = $this->colorsOfProducts($allProducts);

        // Get Highest Viewed Products
        $highestViewedProducts = productHighViewed($products,3);

         $allProducts = $allProducts->orderBy('order')->get();

        if ($request) {
            return view('Client.shop',compact('sizesOfProducts','colorsOfProducts','allProducts','highestViewedProducts','request'));
        }
        return view('Client.shop',compact('sizesOfProducts','colorsOfProducts','allProducts','highestViewedProducts'));
    }



    public function sizesOfProducts($allProducts)
    {
        // To get sizes that have relations with products of categories
        $sizesOfProducts = Product::whereIn('id', $allProducts->pluck('id'))
            ->with(['sizes', 'sizes.size.parent'])
            ->get()
            ->flatMap(function ($product) {
                return $product->sizes->pluck('size');
            });

        return $sizesOfProducts;
    }


//    public function colorsOfProducts($allProducts)
//    {
//        $colors = collect();
//        $allProducts->each(function ($product) use (&$colors) {
//            // Retrieve items of type 'color' associated with the product
//            $product->Items()->where('item_type', 'color')->get()->each(function ($item) use (&$colors) {
//                // Push the color to the $colors collection
//                $colors->push($item->color);
//            });
//        });
//        // Filter out duplicate colors
//        return $colorsOfProducts = $colors->unique('id')->values();
//    }
    public function colorsOfProducts($allProducts)
    {
        $productItems = ProductItem::whereIn('product_id', $allProducts->pluck('id'))->get();

        // Extract unique color IDs from the product items
        $colorIds = $productItems->pluck('color_id')->unique()->toArray();

        // Retrieve colors based on the unique color IDs
        $colors = Color::whereIn('id', $colorIds)->get();

        // Return the colors
        return $colors;
    }


    public function search($request, $allProducts)
    {
        if($request->categories) {

            $categoryIds = $request->categories;

            // Fetch the IDs of the category and its children
            $categoryIdsIncludingChildren = Category::whereIn('id', $categoryIds)
                ->orWhereIn('parent_id',$categoryIds)->with('children')
                ->get()->pluck('id')->flatten()->toArray();

            // Query products that have relations with the specified category or its children
            $allProducts->whereHas('categories', function ($query) use ($categoryIdsIncludingChildren) {
                $query->whereIn('categories.id', $categoryIdsIncludingChildren);
            });
        }

        if ($request->sizes) {
            $allProducts->whereHas('allSizes', function ($query) use ($request) {
                $query->whereIn('title', $request->sizes);
            });
        }

        if ($request->material) {
            $allProducts = $allProducts->whereIn('material', $request->material);
        }

        if ($request->search_product) {
            $allProducts = $allProducts->where('id', 'like', '%' . $request->search_product . '%')
                ->orWhere('title_ar',  'like', '%' . $request->search_product . '%')
                ->orWhere('title_en',  'like', '%' . $request->search_product . '%');
        }

        if ($request->colors && !empty(array_filter($request->colors))) {
            $allProducts->whereHas('colors', function ($query) use ($request) {
                $query->whereIn('colors.id', $request->colors); // Prefix 'id' with the table alias 'colors'
            });

        }

        if ($request->sorting) {
            if ($request->sorting == 2) {
                // Sort by popularity
                $allProducts = $allProducts->orderBy('most_popular', 'desc');
            } elseif ($request->sorting == 3) {
                // Sort by price: low to high
                $allProducts = $allProducts->orderBy('price', 'asc');
            } elseif ($request->sorting == 4) {
                // Sort by price: high to low
                $allProducts = $allProducts->orderBy('price', 'desc');
            } else {
                // Default sorting option or any other custom sorting logic
                $allProducts = $allProducts->orderBy('created_at', 'desc');
            }
        }


        return $allProducts;
    }


    public function filterCategories($category)
    {
        $allProducts = Product::query()->whereHas('categories', function ($q) use ($category) {
            $q->where('category_id', $category->id)
                ->orWhereIn('category_id', $category->children->pluck('id')->toArray());
        });
        return $allProducts;
    }


} //end of class
