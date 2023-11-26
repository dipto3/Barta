<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationFormRequest extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'userName' => 'required|string|unique:users,userName',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field must be required',
            'email.required' => 'Email field must be required',
            'email.unique' => 'The email address is already in use.',
            'password.required' => 'Password field must be required',
            'userName.required' => 'Username must be required',
            'userName.unique' => 'The username is already in use.',
            'password.min' => 'Password must be 4 characters',

        ];
    }
}
