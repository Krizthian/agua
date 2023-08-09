<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecuperacionContraseña extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $id_usuarioRecuperar;

    /**
     * Create a new message instance.
     */
    public function __construct($token, $id_usuarioRecuperar)
    {
        $this->token = $token;
        $this->id_usuarioRecuperar = $id_usuarioRecuperar;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recuperacion de Contraseña | Sistema de Consultas de Valores a Pagar del Agua',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.recuperacion-password',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
