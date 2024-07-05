<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BikeUpdateRequest extends BikeStoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    
    // Hereda del store, hace lo mismo por el momento
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
        $id = $this->bike->id;
        
        return [
            'matricula'     => "required_with:matricula,1|nullable|
                                regex:/^\d{4}[B-DF-HJ-NP-Z]{3}$/|
                                unique:bikes,matricula,$id",
        ]+parent::rules();
    }
}
