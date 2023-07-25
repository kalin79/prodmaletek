<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuieroLaMotoEmail extends Mailable
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
        $subject = 'Quiero la moto';
        $name = "Moto Popular";

        return $this->view('emails.quiero-la-moto')
                    //->from($address, $name)
                    ->subject($subject)
                    ->with([ 'data' => $this->data ]);
    }
}
