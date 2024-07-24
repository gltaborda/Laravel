<?php

namespace App\Http\Controllers;
use App\Models\Noticia;

class WelcomeController extends Controller {
    
    public function index(){
        
        return view('welcome', ['noticias' => Noticia::publicadas()]);
        
    }
    
}