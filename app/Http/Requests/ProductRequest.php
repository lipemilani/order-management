<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

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

        if (request()->method() === 'PUT') {
            return $this->update();
        }
    }

    private function store(): array
    {
        return [
            'name' => 'string|required',
            'price' => 'numeric|required',
            'photo' => 'string|required'
        ];
    }

    private function update(): array
    {
        return [
            'name' => 'string|nullable',
            'price' => 'numeric|nullable',
            'photo' => 'string|nullable'
        ];
    }
}
