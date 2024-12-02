<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Events\EducationPaymentEvent;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\EducationPaymentCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEducationPaymentConfirmationListener
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
    public function handle(EducationPaymentEvent $event): void
    {
        Mail::to($event->email)->send(new EducationPaymentCreatedMail($event->data));
    }
}
