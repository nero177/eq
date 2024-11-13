<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserRegistered extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */ 

    private $tempPassword;
    private $newPasswordUrl;

    public function __construct(
        protected User $user,
        $tempPassword,
        $newPasswordUrl
    ) {
        $this->tempPassword = $tempPassword;
        $this->newPasswordUrl = $newPasswordUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope() : Envelope
    {
        return new Envelope(
            subject: 'User Registered',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content() : Content
    {

        return new Content(
            markdown: 'mail.registered',
            with: [
                'tempPassword' => $this->tempPassword,
                'newPasswordUrl' => $this->newPasswordUrl
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments() : array
    {
        return [];
    }
}
