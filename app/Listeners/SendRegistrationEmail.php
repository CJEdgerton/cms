<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\RegistrationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRegistrationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        // This creates the token and the database entry
        $token = app('auth.password.broker')->createToken($event->user); 

        // Create link for password resetting
        $registration_url = env('APP_URL') . '/password/reset/' . $token;
        // $response = $this->broker()->sendResetLink($event->user);

        // dd( $registration_url );

        // Send out email with link
        Mail::to($event->user->email)->send( new RegistrationEmail($event->user, $registration_url) );
    }
}
