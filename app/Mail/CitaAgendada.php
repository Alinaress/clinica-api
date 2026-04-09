<?php

namespace App\Mail;

use App\Models\MntCita;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CitaAgendada extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public MntCita $cita) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Tu cita ha sido agendada');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.cita-agendada');
    }
}