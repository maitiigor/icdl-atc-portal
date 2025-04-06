<?php

namespace App\Http\Requests;

use App\Http\Requests\AppBaseFormRequest;
use App\Models\User;

class UpdateUserRequest extends AppBaseFormRequest
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
            'email' => 'required|numeric|min:0',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|confirmed|min:8',
            'telephone_number' => 'required|numeric|min:0',

        ];
    }
}
