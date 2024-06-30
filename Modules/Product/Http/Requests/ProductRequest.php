<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'colors.*' => 'required',
            'parent_sizes.*' => 'required',
            'quantity.*' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'colors.*.required' => __('validation.required', ['attribute' => __('trans.color')]),
            'parent_sizes.*.required' => __('validation.required', ['attribute' => __('trans.parent_size')]),
            'quantity.*.required' => __('validation.required', ['attribute' => __('trans.quantity')]),
            'quantity.*.integer' => __('validation.integer', ['attribute' => __('trans.quantity')]),
            'quantity.*.min' => __('validation.min.numeric', ['attribute' => __('trans.quantity'), 'min' => 1]),
        ];
    }
}
