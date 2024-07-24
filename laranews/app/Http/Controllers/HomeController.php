<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $publicadas = $request->user()->noticias()
            ->where('published_at','!=',NULL)->latest()
            ->paginate(config('pagination.noticias',10));
        
        $redactadas = $request->user()->noticias()
            ->where('published_at',NULL)->latest()
            ->paginate(config('pagination.noticias',10));
        
        $borradas = $request->user()->noticias()->onlyTrashed()->latest()
            ->paginate(config('pagination.noticias',10));
        
        $comentarios = $request->user()->comentarios()->latest()
            ->paginate(config('pagination.noticias',10));
        
        return view('home', [   'publicadas' => $publicadas,
                                'redactadas' => $redactadas,
                                'borradas'   => $borradas,
                              'comentarios'  => $comentarios]);
    }
}
