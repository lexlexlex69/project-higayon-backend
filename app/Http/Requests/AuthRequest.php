<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (request()->routeIs('user.login')) {
            return [
                'username' => 'required|string|max:255',
                'password' => 'required|min:4',
            ];
        }
        else if (request()->routeIs('user.signup')) {
            return [
                'username' => 'required|string|max:255|unique:App\Models\User,username',
                'email' => 'required|string|email|unique:App\Models\User,email|max:255',
                'password' => 'required|min:4|confirmed',
            ];
        }
        else if (request()->routeIs('user.updatePhoto')) {
            return [
                'imagepath' => 'required|image|mimes:jpg,bmp,png|max:2048',
            ];
        }
    }
}
