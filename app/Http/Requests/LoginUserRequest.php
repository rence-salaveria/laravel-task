<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['string', 'email', 'required'],
            'password' => ['string', 'required', 'min:8'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
