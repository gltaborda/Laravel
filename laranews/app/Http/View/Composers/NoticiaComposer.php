<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
// use App\Models\Noticia;

class NoticiaComposer{
    
    public function compose(View $view){
        
        $view->with('autor', env('APP_NAME', 'Gastón'));
    }
}