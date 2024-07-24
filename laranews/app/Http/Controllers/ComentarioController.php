<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Http\Requests\ComentarioRequest;
use App\Models\Comentario;
use App\Http\Requests\ComentarioDeleteRequest;

class ComentarioController extends Controller
{
    public function store(ComentarioRequest $request)
    {
        $datos = $request->only('texto');
        
        $datos['user_id'] = $request->user()->id;
        
        $datos['noticia_id'] = $request->input('noticia_id');
        
        $comentario = Comentario::create($datos);
        
       /*if($request->user()->noticias->count() == 1)
            FirstnoticiaCreated::dispatch($noticia, $request->user());*/
            
            //
       return redirect()->back()
            ->with('success',"Comentario guardado en la noticia.");
    }
    
    public function delete(ComentarioDeleteRequest $request)
    {
        // recupero el comentario del input, no funciona si recibe comentario    
        $comentario = Comentario::findOrFail($request->input('id'));
        
        $comentario->delete();
        
        return back()->with('success',"Comentario eliminado");
    }
    
}
