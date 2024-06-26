<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;

class BikeController extends Controller
{
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
    public function store(Request $request)
    {
        // validación de datos de entrada mediante validator
        $request->validate([
            'marca'         => 'required|max:255',
            'modelo'        => 'required|max:255',
            'precio'        => 'required|integer',
            'kms'           => 'required|integer',
            'matriculada'   => 'sometimes'
        ]);
        
        // creación y guardado de la nueva moto con todos los datos POST
        $bike = Bike::create($request->all());
        
        // redirección a los detalles de la moto creada
        return redirect()->route('bikes.show',$bike->id)
            ->with('success',"Moto $bike->marca $bike->modelo añadida satisfactoriamente");
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
    public function edit(Bike $bike)
    {
        // recupera la moto con el id deseado
        // si no la encuentra generará un error 404
        //$bike = Bike::findOrFail($id);
        
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
    public function update(Request $request, Bike $bike)
    {
        // validación de datos
        $request->validate([
            'marca'         => 'required|max:255',
            'modelo'        => 'required|max:255',
            'precio'        => 'required|integer',
            'kms'           => 'required|integer',
            'matriculada'   => 'sometimes'
        ]);
        
        //$bike = Bike::findOrFail($id);  // recupera la moto de la BDD
        $bike->update($request->all()+['matriculada'=>0]); // actualiza
        
        // carga la misma vista y muestra el mensaje de éxito
        return back()->with('success',"Moto $bike->marca $bike->modelo actualizada");
    }

    public function delete(Bike $bike)
    {
        // recupera la moto a eliminar
        //$bike = Bike::findOrFail($id);
        
        // muestra la vista de confirmación de eliminación
        return view('bikes.delete',['bike'=>$bike]);
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bike $bike)
    {
        // busca la moto seleccionada
        //$bike = Bike::findOrFail($id);
        
        // la borra de la base de datos
        $bike->delete();
        
        //redirige a la lista de motos
        return redirect('bikes')
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
    
    
}
