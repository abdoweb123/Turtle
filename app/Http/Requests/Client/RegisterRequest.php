<?php

namespace App\Http\Requests\Client;

class RegisterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'phone' => ['required'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed'],
        ];
    }
}
