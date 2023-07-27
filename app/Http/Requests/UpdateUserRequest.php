<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Auth::check()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'prefixname' => ['string', 'nullable', 'max:255',  Rule::in(['Mr', 'Mrs', 'Ms'])],
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['string', 'nullable', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'suffixname' => ['string', 'nullable', 'max:255'],
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->request->get('id'))],
        ];
    }
}
