<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BikeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*public function authorize()
    {
        return true;
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'marca'         => 'required|max:255',
            'modelo'        => 'required|max:255',
            'description'   => 'sometimes|max:100',
            'precio'        => 'required|integer|min:0',
            'kms'           => 'required|integer|min:0',
            'cv'            => 'sometimes|nullable|integer|min:90|max:260',
            'year'          => 'sometimes|nullable|integer|min:1980|max:2024',
            'matriculada'   => 'sometimes',
            'matricula'     => 'required_with:matricula,1|nullable|
                                regex:/^\d{4}[B-DF-HJ-NP-Z]{3}$/|
                                unique:bikes',
            'color'         => 'nullable|regex:/^#[\dA-F]{6}$/i',
            'imagen'        => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:2048'
        ];
    }
}
