<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class composemail extends Mailable
{
    use Queueable, SerializesModels;
    public $request;
    public $filename;

    public function __construct($request, $filename)
    {
        $this->request = $request;
        $this->filename = $filename;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Compose mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.composemail',
        );
    }

    public function attachments(): array
    {
        $attachment = [];

        if ($this->filename) {
            $attachment = [
                Attachment::fromPath(public_path('/uploads/' . $this->filename)),
            ];
        }

        return $attachment;
    }
}
