<?php

namespace App\CRM\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:customers,email,' . $this->customer?->id,
            'source'    => 'nullable|in:website,referral,social_media,other',
            'status'    => 'nullable|in:active,inactive',
            'phone'     => 'nullable|string|max:20',
            'address'   => 'nullable|string|max:255',
            'company'   => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
