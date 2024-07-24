<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\NoticiaRequest;


class ApiNoticiaRequest extends NoticiaRequest
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
    
    
    protected function failedValidation(Validator $validator){
        
        $response = response([
            'status' => 'ERROR',
            'message' => 'No se superaron los criterios de validación.',
            'errors' => $validator->errors()
        ], 422);
        
        throw new ValidationException($validator, $response);
    }
}
