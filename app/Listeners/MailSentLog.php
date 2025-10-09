<?php

namespace App\Listeners;

use App\Models\EmailLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;


class MailSentLog
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
    public function handle(MessageSent $event): void
    {
        EmailLog::create([
            'gmail_address' => collect($event->message->getFrom())->map(fn($mail) => $mail->getAddress())->first(),
            'to_email' => collect($event->message->getTo())->map(fn($mail) => $mail->getAddress())->first(),
            'cc_emails' => collect($event->message->getCc())->map(fn($mail) => $mail->getAddress()),
            'subject' => $event->message->getSubject(),
            'message' => $event->message->getHtmlBody() ?? $event->message->getTextBody(),
            'status' => 'success'
        ]);
    }
}