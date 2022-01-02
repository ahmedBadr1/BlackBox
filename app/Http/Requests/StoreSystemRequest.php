<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSystemRequest extends FormRequest
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
            'default_language' => 'sometimes|nullable',
            'currency' => 'sometimes|nullable',
            'default_taxes' => 'sometimes|nullable|array',

            'company_name' => 'sometimes|required',
            'owner' => 'sometimes|nullable',
            'email' => 'sometimes|nullable|email',
            'contact' => 'sometimes|nullable',
            'company_logo' => 'sometimes|nullable|image',
        ];
    }
}
