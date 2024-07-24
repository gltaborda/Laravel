<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Http\Requests\Api\ApiNoticiaRequest;
use App\Http\Requests\Api\ApiUpdateNoticiaRequest;



class NoticiaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupera ordenando desc por id
        $noticias = Noticia::orderBy('id','DESC')->get();

        return [
            'status' => 'OK',
            'total' => count($noticias),
            'results' => $noticias
        ];
        
    }
    
    public function show($id)
    {
        $noticia = Noticia::find($id);
        
        return $noticia ? [
            'status' => 'OK',
            'results' => [$noticia]
        ]:
        response(['status' => 'NOT FOUND'], 404);
        
    }
    
    public function search($campo = 'titulo', $valor = '')
    {
        
        $noticias = Noticia::where($campo, 'LIKE', "%$valor%")->get();
        
        return [
            'status' => 'OK',
            'total' => count($noticias),
            'results' => [$noticias]
        ];
        
    }
    
    public function store(ApiNoticiaRequest $request)
    {
        $datos = $request->json()->all();
        $datos['imagen'] = NULL;
        $datos['user_id'] = NULL;
        
        $noticia = Noticia::create($datos);
        
        return $noticia ? 
        response([
            'status' => 'OK',
            'results' => [$noticia]
        ],201):
        response([
            'status' => 'ERROR',
            'message' => 'No se pudo guardar.'
        ],400);
    }
    
    public function update(ApiUpdateNoticiaRequest $request, $id)
    {
        $noticia = Noticia::find($id);
        
        if(!$noticia)
            return response(['status' => 'NOT FOUND'], 404);
        
        $datos = $request->json()->all();
        
        
        return $noticia->update($datos) ?
        response([
            'status' => 'OK',
            'results' => [$noticia]
        ],200):
        response([
            'status' => 'ERROR',
            'message' => 'No se pudo editar.'
        ],400);
    }
    
    public function delete($id)
    {
        $noticia = Noticia::find($id);
        
        if(!$noticia)
            return response(['status' => 'NOT FOUND'], 404);
            
        return $noticia->delete() ?
        response([
            'status' => 'OK',
        ]):
        response([
            'status' => 'ERROR',
            'message' => 'No se pudo borrar.'
        ],400);
    }
    
}

