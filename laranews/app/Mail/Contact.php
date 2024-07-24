<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $mensaje; // aquí va toda la info, es un objeto
    
    // Create a new message instance.
     
    public function __construct($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->from($this->mensaje->email)
                    ->subject('Mensaje recibido:'.$this->mensaje->asunto)
                    ->with('centro','CIFO Sabadell')
                    ->view('emails.contact');
        if($this->mensaje->fichero){
            $email->attach($this->mensaje->fichero,[
                'as' => $this->mensaje->nombreOriginal,
                'mime' => 'application/pdf',
            ]);
        }
        return $email;
    }
}
