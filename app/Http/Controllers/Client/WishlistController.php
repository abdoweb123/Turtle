<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Wishlist;


class WishlistController extends BasicController
{
    public function ToggleWishlist(Request $request)
    {
        $product_id = $request->product_id;

        if (DB::table('wishlist')->where('client_id', client_id())->where('product_id', $product_id)->exists()) {
            DB::table('wishlist')->where('client_id', client_id())->where('product_id', $product_id)->delete();

            $wishlistCount = DB::table('wishlist')->where('client_id', client_id())->count();

            return response()->json([
                'success' => true,
                'type' => 'success',
                'wishlistCount' => $wishlistCount,
                'exists' => 0,
                'message' => __('trans.DeletedSuccessfully'),
            ]);
        } else {
            DB::table('wishlist')->insert([
                'client_id' => client_id(),
                'product_id' => $product_id,
            ]);

            $wishlistCount = DB::table('wishlist')->where('client_id', client_id())->count();

            return response()->json([
                'success' => true,
                'type' => 'success',
                'wishlistCount' => $wishlistCount,
                'exists' => 1,
                'message' => __('trans.addedSuccessfully'),
            ]);
        }
    }


    public function getWishlist()
    {
        $wishlist = Wishlist::where('client_id', client_id())->groupBy('product_id')->get();
        return view('Client.favourite',compact('wishlist'));
    }


    public function deleteWishlist(Request $request)
    {
        $wishlist = Wishlist::where('product_id',$request->id)->delete();

        $wishlistCount = DB::table('wishlist')->where('client_id', client_id())->count();

        return response()->json([
            'success' => true,
            'type' => 'success',
            'wishlistCount' => $wishlistCount,
            'message' => __('trans.DeletedSuccessfully'),
        ]);
    }

} //end of class
