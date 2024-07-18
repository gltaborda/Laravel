<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BikeUpdateRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;


class ApiUpdateBikeRequest extends ApiCreateBikeRequest
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
        $id = $this->route('bike');
        
        return [
            'matricula'     => "required_with:matricula,1|nullable|
                                regex:/^\d{4}[B-DF-HJ-NP-Z]{3}$/|
                                unique:bikes,matricula,$id",
        ]+parent::rules();
    }
    
    protected function failedValidation(Validator $validator){
        
        $response = response([
            'status' => 'ERROR',
            'message' => 'No se superaron los criterios de validación.',
            'errors' => $validator->errors()
        ], 422);
        
        throw new ValidationException($validator, $response);
    }
}
