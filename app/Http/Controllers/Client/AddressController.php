<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BasicController;
use App\Http\Requests\Client\AddressRequest;
use App\Http\Requests\Client\BillingAddressRequest;
use App\Http\Requests\Client\ShippingAddressRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Address\Entities\Model as Address;
use Modules\Country\Entities\Region;

class AddressController extends BasicController
{

    // Controller method to fetch regions for country by ajax
    public function fetchRegionsForCountry(Request $request)
    {
        // Assuming you have a Region model
        $regions = Region::where('country_id', 1)->select('id','title_'.lang().' as title')->get();

        return response()->json(['regions' => $regions]);
    }


    /*** update Shipping Address in account ***/
    public function updateShippingAddress(ShippingAddressRequest $request)
    {

        // save address
        $addressShipping = Address::query()->updateOrCreate
        (
            [
                'client_id' => client_id(),
            ],

            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'country_id' => $request->country_id,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'state' => $request->state,
                'region_id' => $request->region_id,
                'block' => $request->block,
                'road' => $request->road,
                'building_no' => $request->building_no,
                'floor_no' => $request->floor_no,
                'apartment' => $request->apartment,
                'apartmentType' => $request->apartmentType,
                'additional_directions' => $request->additional_directions,
            ]);

        session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.updatedSuccessfully')]);
        return redirect()->back();
    }

    /*** update Address Shipping in cart ***/
    public function updateAddressShipping(Request $request)
    {

        $old_address = Address::where('client_id', client_id())->where('shipping', 1)->delete();

        $new_address = Address::query()->create
        ([
            'client_id' => client_id(),
            'country_id' => $request->input('country_id'),
            'region' => $request->input('city'),
            'shipping' => 1,
            'state' => $request->input('state'),
        ]);


        if ($new_address->country_id == Country()->id)
            $delivery_type = 1;
        else
            $delivery_type = 3;

        return response()->json([
            'success' => true,
            'type' => 'success',
            'delivery_type' => $delivery_type,
            'message' => __('trans.shippingCostUpdated'),
        ]);


    }



} //end of class
