<?php

namespace App\Http\Requests\API;

use App\Http\Requests\AppBaseFormRequest;
use App\Models\User;

class UpdateUserAPIRequest extends AppBaseFormRequest
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
            'name' => 'required|min:5|max:100',
            'email' => 'required|email|unique:users,email,'.$this->input('id').',id|min:0',
            'password' => 'nullable|min:8|confirmed',
            'role' => 'required',
            'telephone' => 'required|digits:11',

        ];
    }
}
