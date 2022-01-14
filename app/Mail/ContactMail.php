<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class contactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public function __construct($contatto)
    {
        $this->contact= $contatto;
    }

    public function build()
    {
        return $this->from('lopassoandrea1@gmail.com')
                    ->view('mails.contactMail');
    }
}
