<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use Queueable, SerializesModels;
    public $data=[];

    public function __construct( $data)
    {
        $this->data= $data;

    }

    public function build()
{
    return $this->from('recursoshumanos@awlmaquitec.com', 'RRHH AWL Maquitec.')
    ->subject($this->data["subject"])
        ->view('rrhh.preboleta.plantilla_email')
        ->with("data",$this->data);
}
}