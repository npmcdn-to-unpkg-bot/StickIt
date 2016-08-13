<?php

namespace StickIt\Http\Requests\Color;

use StickIt\Http\Requests\Request;

class CreateRequest extends Request
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
            'display_name' => 'required|max:25',
            'hex_color'    => 'required|max:7'
        ];
    }

    public function data()
    {
        return $this->only('display_name', 'hex_color');
    }
}
