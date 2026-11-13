<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Inquiry $inquiry) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New website inquiry from '.$this->inquiry->name
                .($this->inquiry->service ? ' ('.$this->inquiry->service.')' : ''),
            replyTo: $this->inquiry->email
                ? [new Address($this->inquiry->email, $this->inquiry->name)]
                : [],
        );
    }

    public function content(): Content
    {
        return new Content(markdown: 'mail.new-inquiry');
    }
}
