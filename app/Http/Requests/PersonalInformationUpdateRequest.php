<?php

namespace App\Http\Requests;

use App\Rules\LinkedInUrl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PersonalInformationUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'linkedin' => ['required', (new LinkedInUrl)],
            'email' => ['required', 'email'],
            'current_password' => ['sometimes'],
            'password' => [Rule::excludeIf(fn() => request()->get('current_password') === null), 'required', 'min:8', 'confirmed']
        ];
    }
}
