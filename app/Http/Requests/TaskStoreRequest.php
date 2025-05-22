<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'content' => 'nullable|string',
            'is_completed' => 'required|boolean',
            'due_date' => 'nullable|date',
            'category_id' => 'nullable|integer|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
        ];
    }
}
