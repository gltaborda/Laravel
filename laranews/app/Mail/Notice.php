<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bike;

class Notice extends Mailable
{
    use Queueable, SerializesModels;
    
    public $titulo, $mensaje;
    
    // Create a new message instance.
    
    public function __construct($event)
    {
        $this->titulo = $event->noticia->titulo;
        
        $this->mensaje = (class_basename($event) == 'Approved')?
            "Felicidades, tu noticia con titulo '$this->titulo' fue publicada.":
            "Tu noticia con titulo '$this->titulo' fue rechazada, por favor edítala para que pueda ser evaluada nuevamente.";
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@laranews.com')
            ->subject('Actualización de tu noticia')
            ->with($this->mensaje)
            ->view('emails.notice');
    }

}
