<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSummary extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($Order)
    {
        $this->order = $Order;
    }

    public function build()
    {
        return $this->view('emails.order_summary');
    }
}
