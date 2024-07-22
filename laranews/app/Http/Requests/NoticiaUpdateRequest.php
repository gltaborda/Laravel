<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class NoticiaUpdateRequest extends NoticiaRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    
    // Hereda del store, hace lo mismo por el momento
    public function authorize()
    {
        return $this->user()->can('update', $this->noticia);
    }

    protected function failedAuthorization(){
        throw new AuthorizationException('No puedes editar una noticia que no es tuya');
    }
    
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
}
