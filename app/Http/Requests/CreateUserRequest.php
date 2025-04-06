<?php

namespace App\Http\Requests;

use App\Http\Requests\AppBaseFormRequest;
use App\Models\User;

class CreateUserRequest extends AppBaseFormRequest
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
        'password' => 'required|numeric|min:8',
        'telephone_number' => 'required|numeric|min:0',

        ];
    }
}
