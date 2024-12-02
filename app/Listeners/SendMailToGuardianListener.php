<?php

namespace App\Listeners;

use App\Mail\GuardianMessageCreatedMail;
use Illuminate\Support\Facades\Mail;
use App\Events\SendMailToGuardianEvent;


class SendMailToGuardianListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMailToGuardianEvent $event): void
    {
        Mail::to($event->email)->send(new GuardianMessageCreatedMail($event->data));
    }
}
