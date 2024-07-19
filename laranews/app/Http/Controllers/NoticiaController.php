<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;

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
        $total= Noticia::count();
        
        //cargar la vista con el listado de motos
        //ver PDF para detalles con blade
        return view('noticias.list',[
            'noticias' => $noticias, 'total'=>$total
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Noticia $noticia)
    {
        $noticia->incrementVisitas();
        /*if(($noticia->visitas % 1000) == 0)
            
            ThousandVisits::dispatch($bike, $bike->user);*/
            
            // carga la vista correspondiente y le pasa la moto
        return view('noticias.show',['noticia'=>$noticia]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
