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
            'from' => collect($event->message->getFrom())->map(fn($mail) => $mail->getAddress())->first(),
            'to' => collect($event->message->getTo())->map(fn($mail) => $mail->getAddress())->first(),
            'cc' => collect($event->message->getCc())->map(fn($mail) => $mail->getAddress()),
            'subject' => $event->message->getSubject(),
            'body' => $event->message->getHtmlBody() ?? $event->message->getTextBody(),
            'status' => 'success'
        ]);
    }
}