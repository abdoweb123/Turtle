<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BasicController;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Country\Entities\Country;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductItem;
use Modules\Address\Entities\Model as Address;


class CartController extends BasicController
{
    /***  add To Cart ***/
    public function addToCart(Request $request)
    {
        $item = ProductItem::where('product_id', $request->input('product_id'))
            ->where('color_id', $request->input('color_id'))
            ->where('size_id', $request->input('size_id'))
            ->where('quantity','>=', $request->input('quantity'))->firstOrFail();

        if (!$item){
            return response()->json($item);
        }

        $cart = Cart::updateOrCreate(
            [
                'client_id'=>client_id(),
                'product_id'=>$item->product_id,
                'item_id'=>$item->id,
                'color_id'=>$item->color_id,
                'size_id'=>$item->size_id,
            ],
            [
                'quantity'=> DB::raw('quantity + ' . $request->input('quantity')),
            ]
        );

        $cart_count = Cart::where('client_id', client_id())->count();

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'cart_count' => $cart_count,
            'exists' => 1,
            'message' => __('trans.addedSuccessfully'),
        ]);
    }


    /*** get cart ***/
    public function getCart()
    {
//        return shippingType();
        $cart = Cart::where('client_id', client_id())->with('product')->get();

        $subTotalCart = CheckoutController::getTotalCart($cart);

        $vat = (setting('vat')/100) * $subTotalCart;

        return view('Client.cart',compact('cart','subTotalCart','vat'));
    }


    /*** update cart ***/
    public function updateCart(Request $request)
    {
        $quantities = $request->input('quantities');

        // To update cart quantities
        foreach ($quantities as $itemId => $quantity)
        {
            $cartItem = Cart::find($itemId);
            $productItem = ProductItem::query()->find($cartItem->item_id);
            if ($cartItem && $productItem->quantity >= $quantity)
            {
                // Update the quantity of the cart item
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        }

        // To get cart_elements with its price
        $cart = Cart::where('client_id', client_id())->with('product')->get();
        $cartElements = $cart->map(function ($cartItem) {
            return [
                'id' => $cartItem->id,
                'quantity' => $cartItem->quantity,
                'total_price' => $cartItem->product->RealPriceWithQuantity($cartItem->quantity)
            ];
        });

        // To get cart_elements with its price
        $subTotalCart = CheckoutController::getTotalCart($cart);


        return response()->json([
            'success' => true,
            'type' => 'success',
            'subtotal_cart' => $subTotalCart,
            'cart_elements' => $cartElements,
            'message' => __('trans.updatedSuccessfully'),
        ]);

    }


    /*** Delete cart ***/
    public function deleteCart(Request $request)
    {
        $cartItem = Cart::where('id',$request->input('cart_item_id'))->delete();

        $cart_count = Cart::where('client_id', client_id())->count();

        // To get cart_elements with its price
        $cart = Cart::where('client_id', client_id())->with('product')->get();
        $subTotalCart = CheckoutController::getTotalCart($cart);

        return response()->json([
            'success' => true,
            'type' => 'success',
            'cart_count' => $cart_count,
            'subtotal_cart' => $subTotalCart,
            'message' => __('trans.DeletedSuccessfully'),
        ]);
    }



} //end of class
