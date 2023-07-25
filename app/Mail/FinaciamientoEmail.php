<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FinaciamientoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $address = 'infodev@codegraph.pe';
        $subject = 'Moto Populas';
        $name = "Moto Popular";
       
        return $this->view('emails.financiamiento')
                    ->from($address, $name)
                    ->subject($subject)
                    ->with([ 'data' => $this->data ]);
    }
}
