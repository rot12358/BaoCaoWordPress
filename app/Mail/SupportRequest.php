<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $phone;
    public $address;
    public $message;

    public function __construct($name, $email, $phone, $address,$message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->message = $message;
    }

    public function build()
    {
        return $this->view('emails.support-request')
                    ->subject('Support Request');
    }
}
