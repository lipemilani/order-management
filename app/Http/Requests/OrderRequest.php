<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (request()->method() === 'POST') {
            return $this->store();
        }

        if (request()->method() === 'DELETE') {
            return $this->delete();
        }
    }

    private function store(): array
    {
        return [
            'customer_id' => 'string|required',
            'product_id' => 'string|required',
        ];
    }

    private function delete(): array
    {
        return [
            'customer_id' => 'string|nullable',
            'product_id' => 'string|nullable',
        ];
    }
}
