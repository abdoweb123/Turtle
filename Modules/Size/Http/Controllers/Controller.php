<?php

namespace Modules\Size\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductSize;
use Modules\Size\Entities\Model as Size;

class Controller extends BasicController
{

    public function index(Request $request)
    {
        $Models = Size::get();

        return view('size::index', compact('Models'));
    }


    public function create()
    {
        $Models = Size::whereNull('parent_id')->get();
        return view('size::create',compact('Models'));
    }


    public function store(Request $request)
    {
        $Model = Size::create($request->all());
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->back();
    }


    public function show($id)
    {
        $Model = Size::where('id', $id)->firstorfail();

        return view('size::show', compact('Model'));
    }


    public function edit($id)
    {
        $Model = Size::where('id', $id)->firstorfail();
        $Models = Size::whereNull('parent_id')->get();

        return view('size::edit', compact('Model','Models'));
    }


    public function update(Request $request, $id)
    {
        $Model = Size::where('id', $id)->firstorfail();
        $Model->update($request->all());
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->back();
    }


    public function destroy($id)
    {
        $Model = Size::where('id', $id)->delete();
    }


    /*** get sizes of product from productItem or get sizes from product_size ***/
//    public function getSizes(Request $request,$id)
//    {
//        $Product = Product::with(["sizes" => function($q){
//            $q->WhereNull('size_id')->orwhere('size_id',request('size_id'));
//
//        }])->where('id', request('product_id'))->firstorfail();
//
//        if(request('size_id')){
//            $size = Size::where('id',request('size_id'))->first();
//
//            $allSizes = Size::Active()->where('parent_id',$size->id)->get();
//
//            return view('product::products.sizes', compact('Product','size','allSizes'));
//        }else{
//            $sizes = Size::whereIn('id', function ($query) {
//                $query->select('item_id')
//                    ->from('product_items')
//                    ->where('item_type', 'Size');
//            })->get();
//
//            return view('product::products.sizes', compact('Product','sizes'));
//        }
//
//    }
//
//
//    public function setSizes(Request $request)
//    {
////        return request('product_id');
//
//        $Product = Product::query()->findOrFail(request('product_id'));
//        $Product->sizes()->whereNotIn('size_id',$request->sizeIds)->delete();
//
//        foreach ($request->sizeIds as $sizeId) {
//            $productSize = ProductSize::query()->updateOrCreate(
//                [
//                    'size_id'=> $sizeId,
//                    'product_id'=> request('product_id'),
//                ]
//            );
//        }
//
//        alert()->success(__('trans.updatedSuccessfully'));
//
//        return back();
//    }


}//end of class
