<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Http\Requests\NoticiaRequest;
use App\Http\Requests\NoticiaDeleteRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\NoticiaUpdateRequest;


class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupera ordenando desc por id
        $noticias = Noticia::orderBy('id','DESC')
        ->paginate(config('pagination.noticias', 10));
        
        //obtengo también el total para mostrar
        //$total= Noticia::count();
        
        //cargar la vista con el listado de motos
        //ver PDF para detalles con blade
        return view('noticias.list',[
            'noticias' => $noticias
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('noticias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticiaRequest $request)
    {
        $datos = $request->except('imagen');
        
        $datos['user_id'] = $request->user()->id;
        
        $datos += ['imagen' => NULL];
        
        if($request->hasFile('imagen')){
            // sube la imagen al directorio indicado en el fichero de config
            $ruta = $request->file('imagen')->store(config('filesystems.noticiasImageDir'));
            
            // nos quedamos solo con el nombre del fichero para añadirlo a la BDD
            $datos['imagen'] = pathinfo($ruta, PATHINFO_BASENAME);
        }
        
        $noticia = Noticia::create($datos);
        
       /*if($request->user()->noticias->count() == 1)
            FirstnoticiaCreated::dispatch($noticia, $request->user());*/
            
            //
       return redirect()->route('noticias.show',$noticia->id)
            ->with('success',"Noticia creada. Será revisada por nuestros editores y recibirás una respuesta pronto");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Noticia $noticia)
    {
        //dd($noticia->comentarios());
        
        $noticia->incrementVisitas();
        
        /*if(($noticia->visitas % 1000) == 0)
            
            ThousandVisits::dispatch($bike, $bike->user);*/
            
            // carga la vista correspondiente y le pasa la moto
        $comentarios = $noticia->comentarios()->latest()
        ->paginate(config('pagination.noticias',10));
        
        return view('noticias.show',['noticia' => $noticia, 'comentarios' => $comentarios]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Noticia $noticia)
    {
        if($request->user()->cant('delete', $noticia))
            abort(401, 'No puedes borrar una noticia que no es tuya');
            
            // carga la vista con el formulario para modificar la moto
            return view('noticias.update',['noticia'=>$noticia]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoticiaUpdateRequest $request, Noticia $noticia)
    {
        $datos = $request->except('imagen');
        
        // si llega una nueva imagen
        if($request->hasFile('imagen')){
            // marcamos la imagen antigua para ser borrada si el update va bien
            if($noticia->imagen)
                $aBorrar = config('filesystems.noticiasImageDir').'/'.$noticia->imagen;
                
                // sube la imagen al directorio indicado en el fichero de config
                $imagenNueva = $request->file('imagen')->store(config('filesystems.noticiasImageDir'));
                
                // nos quedamos solo con el nombre del fichero para añadirlo a la BDD
                $datos['imagen'] = pathinfo($imagenNueva, PATHINFO_BASENAME);
        }
        
        // en caso de que nos pidan eliminar la imagen
        if($request->filled('eliminarImagen') && $noticia->imagen){
            $datos['imagen'] = NULL;
            $aBorrar = config('filesystems.bikesImageDir').'/'.$noticia->imagen;
            //dd($datos);
        }
        
        // al actualizar debemos tener en cuenta varias cosas:
        // agrego para que si no está matriculada se ponga a 0 y la matrícula se borre
        if($noticia->update($datos)){ // si todo va bien
            if(isset($aBorrar))
                Storage::delete($aBorrar); // borramos foto antigua
        }else{ // si algo falla
            if(isset($imagenNueva))
                Storage::delete($imagenNueva); // borramos la foto nueva
        }
        
        // carga la misma vista y muestra el mensaje de éxito
        return redirect()->route('noticias.show',$noticia->id)
            ->with('success',"Noticia $$noticia->id actualizada");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function delete(NoticiaDeleteRequest $request, Noticia $noticia)
    {
        Session::put('returnTo', URL::previous());
        
        return view('noticias.delete', ['noticia'=>$noticia]);
    }
    
    public function destroy(NoticiaDeleteRequest $request, Noticia $noticia)
    {
        $noticia->delete();
        
        // comprobamos si hay una dirección de retorno
        $redirect = Session::has('returnTo') ?
        redirect(Session::get('returnTo')) :
        redirect()->route('noticias.index');
        
        Session::remove('returnTo'); // libera la variable
        
        
        //redirige a la lista de motos
        return $redirect
            ->with('success',"Noticia #$noticia->id eliminada");
    }
    
    
    
    public function search(Request $request, $titulo = null, $tema = null){
        
        $titulo = $$titulo ?? $request->input('titulo','');
        $tema = $tema ?? $request->input('tema','');
        
        
        $noticias = Noticia::where('titulo', 'like', '%'.$titulo.'%')
        ->where('tema', 'like', '%'.$tema.'%')
        ->orderBy('id','DESC')
        ->paginate(config('pagination.noticias', 5))
        ->appends(['titulo' => $titulo, 'tema' => $tema]);
        
        return view('noticias.list',[
            'noticias' => $noticias,
            'titulo' => $titulo,
            'tema' => $tema
        ]);
    }
    
}
