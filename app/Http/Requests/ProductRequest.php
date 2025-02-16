<?php

namespace App\Http\Requests;


class ProductRequest extends BaseRequest
{
    public function store(): array
    {
        return [
            'name' => 'string|required',
            'price' => 'numeric|required',
            'photo' => 'max:2000|mimes:jpeg,png,doc,docs,pdf|required'
        ];
    }

    public function update(): array
    {
        return [
            'name' => 'string|nullable',
            'price' => 'numeric|nullable',
            'photo' => 'string|nullable'
        ];
    }
}
