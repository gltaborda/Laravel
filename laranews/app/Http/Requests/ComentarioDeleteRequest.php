<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\Comentario;

class ComentarioDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $comentario = Comentario::findOrFail($this->input('id'));
                
        return $this->user()->can('delete', $comentario);
    }
    
    protected function failedAuthorization(){
        throw new AuthorizationException('No puedes borrar un comentario que no es tuyo');
    }
    
    public function rules()
    {
        return [
            //
        ];
    }
}
