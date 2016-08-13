<?php

namespace StickIt\Http\Requests\Notes;

use StickIt\Http\Requests\Request;

class RemoveShareUserRequest extends Request
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
            'email' => 'required|email|max:255|exists:users,email'
        ];
    }
}
