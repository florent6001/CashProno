<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Retrieve email variables
     *
     * @param string $email
     * @param string $message
     */
    public function __construct(string $email, string $content)
    {
        $this->email = $email;
        $this->content = $content;
    }

    /**
     * Build and send the contact mail
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Demande de contact')
                    ->from($this->email)
                    ->view('email.contact')
                    ->with([
                        'email' => $this->email,
                        'content' => $this->content
                    ]);
    }
}
