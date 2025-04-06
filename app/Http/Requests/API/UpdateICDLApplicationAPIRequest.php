<?php

namespace App\Http\Requests\API;

use App\Http\Requests\AppBaseFormRequest;
use App\Models\Shipment;

class UpdateICDLApplicationAPIRequest extends AppBaseFormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:255',
            'icdl_module_id' => 'required|integer|exists:icdl_modules,id',
        ];
    }
}
