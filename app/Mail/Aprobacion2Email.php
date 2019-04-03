<?php

namespace App\Mail;

use App\Entidad\Solicitud;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Aprobacion2Email extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $solicitud;

    public function __construct(Solicitud $solicitud)
    {


        $this->solicitud = $solicitud;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('caja.email.aprobacion2');
    }
}
