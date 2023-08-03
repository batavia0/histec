<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailtoTicketSender extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket_no;
    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$ticket_no)
    {
        $this->email = $email;
        $this->ticket_no = $ticket_no;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Pemberitahuan: Permintaan Tiket',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'sivitas_akademika.emails.ticket_request',
            with: [
                'ticket_no' => $this->ticket_no,
                'email' => $this->email
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
