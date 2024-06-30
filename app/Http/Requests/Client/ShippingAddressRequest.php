<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ShippingAddressRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'country_id' => 'required|string',
        ];

        if ($this->input('country_id') != 1) {
            $rules = array_merge($rules, [
                'city' => 'required|string',
                'address1' => 'required|string',
            ]);
        } else {
            $rules = array_merge($rules, [
                'region_id' => 'required|numeric|exists:regions,id',
                'block' => 'required|string',
                'road' => 'required|string',
                'building_no' => 'required|string',
                'floor_no' => 'required|string',
//            'apartment' => 'required|string',
//            'apartmentType' => 'required|string',
            ]);
        }

        return $rules;
    }


}
