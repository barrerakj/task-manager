<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'nullable|string',
        ];
    }
}