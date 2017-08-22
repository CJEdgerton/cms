<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, String $registration_url)
    {
        $this->user = $user;
        $this->registration_url = $registration_url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@cms.com')
                ->view('emails.users.registration')
                ->with([
                    'user'             => $this->user,
                    'registration_url' => $this->registration_url,
                ]);
    }
}
