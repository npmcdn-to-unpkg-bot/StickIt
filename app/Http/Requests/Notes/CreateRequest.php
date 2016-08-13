<?php

namespace StickIt\Http\Requests\Notes;

use Auth;
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
            'title'       => 'required|max:50',
            'description' => 'required|max:250',
            'color_id'    => 'exists:colors,id,user_id,' . Auth::id()
        ];
    }

    public function data()
    {
        return $this->only('title', 'description', 'color_id');
    }
}
