<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\BikeStoreRequest;
use App\Http\Requests\BikeUpdateRequest;
use App\Http\Requests\BikeDeleteRequest;
use Illuminate\Auth\Access\AuthorizationException;


class BikeController extends Controller
{
    public function __construct(){
        $this->middleware('verified')->except('index','show','search');
        
        $this->middleware('password.confirm')->only('destroy');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupera ordenando desc por id
        $bikes = Bike::orderBy('id','DESC')
            ->paginate(config('pagination.bikes', 10));
        
        //obtengo también el total para mostrar
        $total= Bike::count();
        
        //cargar la vista con el listado de motos
        //ver PDF para detalles con blade
        return view('bikes.list',[
            'bikes' => $bikes, 'total'=>$total
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mostrar el formulario
        return view('bikes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BikeStoreRequest $request)
    {
        // validación de datos de entrada mediante validator
        /*$request->validate([
            'marca'         => 'required|max:255',
            'modelo'        => 'required|max:255',
            'precio'        => 'required|integer|min:0',
            'kms'           => 'required|integer|min:0',
            'matriculada'   => 'sometimes',
            'matricula'     => 'required_with:matricula,1|nullable|
                                regex:/^\d{4}[B-DF-HJ-NP-Z]{3}$/|
                                unique:bikes',
            'color'         => 'nullable|regex:/^#[\dA-F]{6}$/i',
            'imagen'        => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:2048'
        ]);*/
        
        // creación y guardado de la nueva moto con todos los datos POST
        //$bike = Bike::create($request->only(['marca', 'modelo', 'kms', 'precio', 'matriculada']));
        
        // recuperar datos excepto imagen
        $datos = $request->except('imagen');
        
        $datos['user_id'] = $request->user()->id;
        
        $datos += ['imagen' => NULL];
        
        if($request->hasFile('imagen')){
            // sube la imagen al directorio indicado en el fichero de config
            $ruta = $request->file('imagen')->store(config('filesystems.bikesImageDir'));
            
            // nos quedamos solo con el nombre del fichero para añadirlo a la BDD
            $datos['imagen'] = pathinfo($ruta, PATHINFO_BASENAME);
        }
        
        $bike = Bike::create($datos);
        
        
        // redirección a los detalles de la moto creada
        return redirect()->route('bikes.show',$bike->id)
            ->with('success',"Moto $bike->marca $bike->modelo añadida satisfactoriamente")
            /*->cookie('lastInsertID', $bike->id, 0)*/;
    }
    
    public function editLast(){
        
        if(!Cookie::has('lastInsertID'))
            return redirect()->route('bikes.create')->with('warning', "No hay moto editada.");
            
        $id = Cookie::get('lastInsertId');
        return redirect()->route('bikes.edit', $id)->with('success', "$bike->marca $bike->modelo fue la última moto editada");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bike $bike)
    {
        // recupera la moto con el id deseado
        // si no la encuentra generará un error 404
        //$bike = Bike::findOrFail($id);
        
        // carga la vista correspondiente y le pasa la moto
        return view('bikes.show',['bike'=>$bike]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Bike $bike)
    {
        // recupera la moto con el id deseado
        // si no la encuentra generará un error 404
        //$bike = Bike::findOrFail($id);
        
        // policies en controlador
        /*if($request->user()->cant('delete', $bike))
         abort(401, 'No puedes borrar una moto que no es tuya');*/
        
        // carga la vista con el formulario para modificar la moto
        return view('bikes.update',['bike'=>$bike]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BikeUpdateRequest $request, Bike $bike){
        // validación de datos
        /*$request->validate([
            'marca'         => 'required|max:255',
            'modelo'        => 'required|max:255',
            'precio'        => 'required|integer|min:0',
            'kms'           => 'required|integer|min:0',
            'matriculada'   => 'sometimes',
            'matricula'     => "required_with:matricula,1|nullable|
                                regex:/^\d{4}[B-DF-HJ-NP-Z]{3}$/|
                                unique:bikes,matricula,$bike->id",
            'color'         => 'nullable|regex:/^#[\dA-F]{6}$/i',
            'imagen'        => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:2048'
        ]);*/
        
        //$bike = Bike::findOrFail($id);  // recupera la moto de la BDD
        
        //$bike->update($request->all()+['matriculada'=>0]); // actualiza
        
        // acolar cookies
        /*Cookie::queue('lastUpdateID', $bike->id, 0);
        Cookie::queue('lastUpdateDate', now(), 0);*/
        
        // policies en controlador
        /*if($request->user()->cant('delete', $bike))
         abort(401, 'No puedes borrar una moto que no es tuya');*/
        
        //toma los datos del formulario
        
        $datos = $request->except('imagen');
        
        // si llega una nueva imagen
        if($request->hasFile('imagen')){
            // marcamos la imagen antigua para ser borrada si el update va bien
            if($bike->imagen)
                $aBorrar = config('filesystems.bikesImageDir').'/'.$bike->imagen;
            
            // sube la imagen al directorio indicado en el fichero de config
            $imagenNueva = $request->file('imagen')->store(config('filesystems.bikesImageDir'));
            
            // nos quedamos solo con el nombre del fichero para añadirlo a la BDD
            $datos['imagen'] = pathinfo($imagenNueva, PATHINFO_BASENAME);
        }
        
        // en caso de que nos pidan eliminar la imagen
        if($request->filled('eliminarImagen') && $bike->imagen){
            $datos['imagen'] = NULL;
            $aBorrar = config('filesystems.bikesImageDir').'/'.$bike->imagen;
            //dd($datos);
        }
        
        // al actualizar debemos tener en cuenta varias cosas:
        // agrego para que si no está matriculada se ponga a 0 y la matrícula se borre
        if($bike->update($datos+['matriculada' => 0]+['matricula' => NULL])){ // si todo va bien
            if(isset($aBorrar))
                Storage::delete($aBorrar); // borramos foto antigua
        }else{ // si algo falla
            if(isset($imagenNueva))
                Storage::delete($imagenNueva); // borramos la foto nueva
        }
        
        // carga la misma vista y muestra el mensaje de éxito
        return redirect()->route('bikes.show',$bike->id)
            ->with('success',"Moto $bike->marca $bike->modelo actualizada");
    }

    public function delete(BikeDeleteRequest $request, Bike $bike)
    {
        // recupera la moto a eliminar
        //$bike = Bike::findOrFail($id);
        
        // recuerda la URL para redireccionar en el futuro
        Session::put('returnTo', URL::previous());
        
        // muestra la vista de confirmación de eliminación
        /*if($request->user()->cant('delete', $bike))
            abort(401, 'No puedes borrar una moto que no es tuya');*/
        return view('bikes.delete', ['bike'=>$bike]);
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BikeDeleteRequest $request, Bike $bike){
        // busca la moto seleccionada
        //$bike = Bike::findOrFail($id);
        
        /*if($request->user()->cant('delete', $bike))
            abort(401, 'No puedes borrar una moto que no es tuya');*/
        
        // borra de la base de datos y tiene foto
        /*if($bike->delete() && $bike->imagen)
            // elimina el fichero
            Storage::delete(config('filesystems.bikesImageDir').'/'.$bike->imagen);*/
        $bike->delete();
        
        // comprobamos si hay una dirección de retorno
        $redirect = Session::has('returnTo') ?
                    redirect(Session::get('returnTo')) :
                    redirect()->route('bikes.index');
        
        Session::remove('returnTo'); // libera la variable
        
        
        //redirige a la lista de motos
        return $redirect
            ->with('success',"Moto $bike->marca $bike->modelo eliminada");
    }
    
    public function search(Request $request, $marca = null, $modelo = null){
        
        $marca = $marca ?? $request->input('marca','');
        $modelo = $modelo ?? $request->input('modelo','');
        
        //busca las motos con esa marca y modelo
        $bikes = Bike::where('marca', 'like', '%'.$marca.'%')
        ->where('modelo', 'like', '%'.$modelo.'%')
        ->orderBy('id','DESC')
        ->paginate(config('pagination.bikes', 5))
        ->appends(['marca' => $marca, 'modelo' => $modelo]);
        
        return view('bikes.list',[
            'bikes' => $bikes,
            'marca' => $marca,
            'modelo' => $modelo
        ]);        
    }
    
    
    // intento de mostrar el nombre del usuario, no funciona por ahora
    /*public function getOwner(){
        $user = User::where('id', 'like', $this->user_id);
        
        return $user->name;
    }*/
    
    
    public function restore(Request $request, int $id){
        
        // recuperar moto borrada
        $bike = Bike::withTrashed()->findOrFail($id);
        
        if($request->user()->cant('restore', $bike))
            throw new AuthorizationException('No tienes permiso para restaurar la moto');
       
        $bike->restore();
        
        return back()->with('success',
            "Moto $bike->marca $bike->modelo restaurada correctamente");
    }
    
    public function purge(Request $request){
        
        // recuperar moto borrada
        $bike = Bike::withTrashed()->findOrFail($request->input('bike_id'));
        
        if($request->user()->cant('delete', $bike))
            throw new AuthorizationException('No tienes permiso para borrar la moto');
        
        if($bike->forceDelete() && $bike->imagen)
            // borra también la foto
            Storage::delete(config('filesystems.bikedImageDir').'/'.$bike->imagen);
        
        return back()->with('success',
            "Moto $bike->marca $bike->modelo eliminada definitivamente");
    }
    
    
    
    
}
