<?php

namespace App\Http\Requests\API;

use App\Http\Requests\AppBaseFormRequest;
use App\Models\Customer;

class UpdateICDLModuleAPIRequest extends AppBaseFormRequest
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
        /*
        
        */
        return [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'short_description' => 'nullable|string|max:255',
            'full_description' => 'nullable|string',
            'amount' => 'nullable|numeric|min:0',
            'is_available' => 'required|boolean',
        ];
    }
}
