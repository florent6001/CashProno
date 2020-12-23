<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Prend les variables de l'email
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
     * Construit et envoie l'email.
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
