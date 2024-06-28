<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        $instruments = Instrument::orderBy('id','DESC')
            ->paginate(config('pagination.instruments', 20));
        
        $total = Instrument::count();
        
        return view('instruments.list', ['instruments' => $instruments, 'total' => $total
            
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        
      //  return view('instruments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // validación de datos de entrada mediante validator
        $request->validate([
            'categoria'     => 'required|max:255',
            'marca'         => 'required|max:255',
            'modelo'        => 'required|max:255',
            'anio'          => 'required|integer',
            'precio'        => 'required|integer',
            'usado'         => 'sometimes'
        ]);
        
        // creación y guardado de la nueva moto con todos los datos POST
        $instrument = Instrument::create($request->all());
        
        // redirección a los detalles de la moto creada
        return redirect()->route('instruments.show',$instrument->id)
            ->with('success',"$instrument->categoria $instrument->marca $instrument->modelo añadido satisfactoriamente");
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Instrument $instrument){
        //
        return view('instruments.show',['instrument'=>$instrument]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Instrument $instrument){
        //
        return view('instruments.update',['instrument'=>$instrument]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instrument $instrument){
        //
        $request->validate([
            'categoria'     => 'required|max:255',
            'marca'         => 'required|max:255',
            'modelo'        => 'required|max:255',
            'anio'          => 'required|integer',
            'precio'        => 'required|integer',
            'usado'         => 'sometimes'
        ]);
        
        //$bike = Bike::findOrFail($id);  // recupera la moto de la BDD
        $instrument->update($request->all()+['usado'=>0]); // actualiza
        
        // acolar cookies
        /*Cookie::queue('lastUpdateID', $bike->id, 0);
         Cookie::queue('lastUpdateDate', now(), 0);*/
        
        // carga la misma vista y muestra el mensaje de éxito
        return redirect()->route('instruments.show',$instrument->id)
            ->with('success',"$instrument->categoria $instrument->marca $instrument->modelo actualizado");
    }

    public function delete(Instrument $instrument)
    {
        // recupera la moto a eliminar
        //$bike = Bike::findOrFail($id);
        
        // muestra la vista de confirmación de eliminación
        return view('instruments.delete',['instrument'=>$instrument]);
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instrument $instrument)
    {
        // busca la moto seleccionada
        //$bike = Bike::findOrFail($id);
        
        // la borra de la base de datos
        $instrument->delete();
        
        //redirige a la lista de motos
        return redirect('instruments')
            ->with("$instrument->categoria $instrument->marca $instrument->modelo eliminado");
    }
    
    public function search(Request $request, $categoria = null, $marca = null, $modelo = null){
        
        $categoria = $categoria ?? $request->input('categoria','');
        $marca = $marca ?? $request->input('marca','');
        $modelo = $modelo ?? $request->input('modelo','');
        
        //busca las motos con esa marca y modelo
        $instruments = Instrument::where('categoria', 'like', '%'.$categoria.'%')
            ->where('marca', 'like', '%'.$marca.'%')
            ->where('modelo', 'like', '%'.$modelo.'%')
            ->orderBy('id','DESC')
            ->paginate(config('pagination.instruments', 5))
            ->appends(['categoria' => $categoria, 'marca' => $marca, 'modelo' => $modelo]);
        
        return view('instruments.list',[
            'instruments' => $instruments,
            'categoria' => $categoria,
            'marca' => $marca,
            'modelo' => $modelo
        ]);       
    }
}
