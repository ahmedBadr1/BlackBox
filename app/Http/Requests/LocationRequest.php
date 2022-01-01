<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'state_id' => 'required|numeric' ,
            'area_id' => 'required|numeric' ,
            'street' => 'nullable' ,
            'building' => 'nullable' ,
            'floor' => 'nullable' ,
            'apartment' => 'nullable' ,
            'landmarks' => 'nullable' ,
            'latitude' => 'sometimes|numeric|digits_between:-90,90',
           'longitude' => 'sometimes|numeric|digits_between:-180,180'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.max' => 'The location name has exceeded the limit',
            'latitude.between' => 'The latitude must be in range between -90 and 90',
            'longitude.between' => 'The longitude mus be in range between -180 and 180'
        ];
    }
}
