<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $client;

    public function __construct($token,$client)
    {
        $this->token = $token;
        $this->client = $client;
    }

    public function build()
    {
        return $this->view('emails.reset_password');
    }
}




