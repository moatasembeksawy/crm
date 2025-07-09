<?php

namespace App\CRM\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => 'required|string|max:1000',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
