<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'email' => ['required', Rule::unique('customers', 'email')->where(function ($query) {})],
            'phone' => 'regex:/(01)[0-9]{9}/|required',
            'date_of_birth' => 'date_format:Y-m-d|required',
            'address' => 'string|required',
            'complement' => 'string|nullable',
            'neighborhood' => 'string|required',
            'cep' => 'regex:/^\d{5}-\d{3}$/|required',
        ];
    }

    private function update(): array
    {
        return [
            'name' => 'string|nullable',
            'email' => 'email|nullable',
            'phone' => 'regex:/(01)[0-9]{9}/|nullable',
            'date_of_birth' => 'date_format:Y-m-d|nullable',
            'address' => 'string|nullable',
            'complement' => 'string|nullable',
            'neighborhood' => 'string|nullable',
            'cep' => 'regex:/^\d{5}-\d{3}$/|nullable',
        ];
    }
}
