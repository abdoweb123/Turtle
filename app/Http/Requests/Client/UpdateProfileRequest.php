<?php

namespace App\Http\Requests\Client;

class UpdateProfileRequest extends BaseRequest
{
    public function authorize()
    {
        return true; // Allow all users to access this request
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:clients,email,' . auth()->id(),
            'password' => 'nullable|min:8|confirmed',
            'current_password' => 'required_with:password', // Required if password is provided
        ];
    }

}
