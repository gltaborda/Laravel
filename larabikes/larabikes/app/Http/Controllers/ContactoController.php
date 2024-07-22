<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class ContactoController extends Controller
{
    public function index(){
        return view('contacto');
    }
    
    public function send(Request $request){
        
        $request->validate([
            'email'     => 'required|email:rfc',
            'fichero'   => 'sometimes|file|mimes:gif'
        ]);
        
        $mensaje = new \stdClass();
        $mensaje->asunto = $request->asunto;
        $mensaje->email = $request->email;
        $mensaje->nombre = $request->nombre;
        $mensaje->mensaje = $request->mensaje;
        
        $mensaje->fichero = $request->hasFile('fichero')?
                            $request->file('fichero')->getRealPath() : NULL;
        
        $mensaje->nombreOriginal = $request->hasFile('fichero')?
        $request->file('fichero')->getClientOriginalName() : NULL;
        
        Mail::to('contacto@larabikes.com')->send(new Contact($mensaje));
        
        return redirect()->route('portada')
            ->with('success','Mensaje enviado correctamente.');
    }
}