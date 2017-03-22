<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnquirySend extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $name;
    public $subject;
    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->email = $request->email;
        $this->name = $request->name;
        $this->subject = $request->subject;
        $this->body = $request->body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email)
            ->view('emails.contact-form');
    }
}
