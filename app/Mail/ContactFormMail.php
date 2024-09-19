<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     */
    public function __construct()//$details)
    {
        //$this->details = $details;
    }
    /**
     * Build the message.
     */
    public function build()
    {
        // return $this->subject('New Contact Form Submission')
        //             ->view('emails.contact-form');

        return $this->subject('Test Email from Laravel')
            ->view('emails.test');  // Create this view or use a plain text email
    }
}