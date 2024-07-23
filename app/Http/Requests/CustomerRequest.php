<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CustomerRequest extends BaseRequest
{
    public function store(): array
    {
        return [
            'name' => 'string|required',
            'email' => ['required', Rule::unique('customers', 'email')->where(function ($query) {})],
            'phone' => 'regex:/^\(\d{2}\)\d{9}$/|required',
            'date_of_birth' => 'date_format:Y-m-d|required',
            'address' => 'string|required',
            'complement' => 'string|nullable',
            'neighborhood' => 'string|required',
            'cep' => 'regex:/^\d{5}-\d{3}$/|required',
        ];
    }

    public function update(): array
    {
        return [
            'name' => 'string|nullable',
            'email' => 'email|nullable',
            'phone' => 'regex:/^\(\d{2}\)\d{9}$/|nullable',
            'date_of_birth' => 'date_format:Y-m-d|nullable',
            'address' => 'string|nullable',
            'complement' => 'string|nullable',
            'neighborhood' => 'string|nullable',
            'cep' => 'regex:/^\d{5}-\d{3}$/|nullable',
        ];
    }

    public function messages()
    {
        return [
            'phone.regex' => 'The format of the phone must be (xx)xxxxxxxxx.',
        ];
    }
}
