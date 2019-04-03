<?php

namespace App\Mail\rq;

use App\Entidad\Rq;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AprobacionEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $requerimiento;
    private $codigo;

    public function __construct(Rq $requerimiento,$codigo)
    {
        //
        $this->requerimiento = $requerimiento;
        $this->codigo = $codigo;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $requerimiento=$this->requerimiento;
        $codigo=$this->codigo;
        $this->subject("CETEMIN RQ [".$codigo."]");

        return $this->view('logistica.email.aprobacion',compact("requerimiento","codigo"));

    }
}
