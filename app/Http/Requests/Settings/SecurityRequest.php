<?php

namespace StickIt\Http\Requests\Settings;

use StickIt\Http\Requests\Request;

class SecurityRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => 'required|max:64',
            'password'         => 'required|confirmed|min:8|max:64|regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/'
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => "Your password must contain 1 lower case character, 1 upper case character, and one number"
        ];
    }
}
