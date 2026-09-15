<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array<string, mixed>  $data
     * @param  array{disk: string, path: string, name: string, mime: string}|null  $cv
     */
    public function __construct(
        public array $data,
        public ?array $cv = null,
    ) {}

    public function envelope(): Envelope
    {
        $isCandidature = ($this->data['motif'] ?? '') === 'candidature';

        return new Envelope(
            subject: $isCandidature
                ? 'Nouvelle candidature – BSM-Services'
                : 'Nouveau message – BSM-Services',
            replyTo: [$this->data['email']],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
            with: [
                'data' => $this->data,
                'cv' => $this->cv,
            ],
        );
    }

    /**
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        if ($this->cv === null) {
            return [];
        }

        return [
            Attachment::fromStorageDisk($this->cv['disk'], $this->cv['path'])
                ->as($this->cv['name'])
                ->withMime($this->cv['mime']),
        ];
    }
}
