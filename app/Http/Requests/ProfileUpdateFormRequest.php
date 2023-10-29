<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $userId = Auth::user()->id;

        return [
            'name' => 'required',
            'password' => 'nullable|string|min:4',
            'email' => 'required|email|unique:users,email,' . $userId,
            'userName' => 'required|string|unique:users,userName,' . $userId,

        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Name field must be required",
            'password.min' => "Password must be 4 characters",
            'email.required' => "Email field must be required",
            'email.unique' => 'The email address is already in use.',
            'userName.required' => "Username must be required",
            'userName.unique' => 'The username is already in use.',

        ];
    }
}
