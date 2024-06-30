<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class BillingAddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name_billing' => 'required|string',
            'last_name_billing' => 'required|string',
            'country_id_billing' => 'required|string',
            'address1_billing' => 'required|string',
            'city_billing' => 'required|string',
            'phone_billing' => 'required|string',
            'email_address' => 'required|email',
        ];
    }



} //end of class
