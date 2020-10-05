<?php

namespace App\Mail\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct()
    {

    }


    public function build()
    {

        return $this->view('email.template.email');
        //from('vvkalanka@gmail.com')->subject('test subject this is')
    }
}
