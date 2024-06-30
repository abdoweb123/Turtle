<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCheckoutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payment_id' => 'required|exists:payments,id',
        ];
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            if (!auth('client')->check()) {
                $validator->addRules([
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'email' => 'required|email|unique:clients,email,' . auth()->id(),
                    'password' => 'required|string|min:6',
                ]);
            }


            // with bahrain
            if (shippingType()  == '1') {
                $validator->addRules([
                    'region' => 'required|numeric|exists:regions,id',
                    'block' => 'required|string',
                    'road' => 'required|string',
                    'building_no' => 'required|string',
                    'floor_no' => 'required|string',
//                    'apartment' => 'required|string',
//                    'apartmentType' => 'required|string',
                ]);
            } if (shippingType()  == '3') {
                $validator->addRules([
                    'city' => 'required|string',
                    'address1' => 'required|string',
                ]);
            }
        });
    }


} //end of class
