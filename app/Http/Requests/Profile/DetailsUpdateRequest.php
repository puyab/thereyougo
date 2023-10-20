<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Propaganistas\LaravelPhone\Rules\Phone;

class DetailsUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role' => ['required'],
            'company' => ['required'],
            'telephone' => ['required', (new Phone)],
            'location' => ['required'],
            'accommodation_type' => ['nullable', Rule::in(['house', 'apartment', 'room'])],
            'bedrooms' => ['nullable', 'numeric', 'gte:1'],
            'sleep_rooms' => ['nullable', 'numeric', 'gte:1'],
            'high_speed_wifi' => ['nullable', 'boolean'],
        ];
    }
}
