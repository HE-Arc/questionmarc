<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($this->user())],
            'filiere'  => ['required', 'string', 'max:10'],
            'year'     => ['required', 'integer', 'min:1', 'max:3'],
            'profile_picture_type' => ['required', 'integer']
        ];
    }
}
