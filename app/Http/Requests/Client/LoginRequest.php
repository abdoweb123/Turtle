<?php

namespace App\Http\Requests\Client;

class LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'username_or_email' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
