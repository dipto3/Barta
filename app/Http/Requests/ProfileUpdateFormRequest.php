<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [

            'email' => '|unique:users,email',

            'userName' => 'unique:users,userName',
        ];
    }

    public function messages()
    {
        return [

            // 'email.required' => "Email field must be required",
            'email.unique' => 'The email address is already in use.',

            // 'userName.required' => "Username must be required",
            'userName.unique' => 'The username is already in use.',

        ];
    }
}
