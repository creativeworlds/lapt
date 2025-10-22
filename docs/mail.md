# Mail Notification with Logging

This module enables automatic mail notifications for students, centres, and admins, and logs every sent email into the database for reference and tracking.

## Features

✅ Mail notifications for students, centres, and admins<br />
✅ Automatic logging of all sent mails<br />
✅ Email summary and audit trail<br />
✅ HTML mail templates<br />
✅ Event-driven architecture<br />
✅ Mail tracking and reporting<br />

## System Architecture

The system follows Laravel's event-driven architecture:

`Mail Sent` → `Event Fired` → `Event Listener` → `Database Log Created`

## Steps to Implement

### 1. Send Mail via Laravel Mail

Use Laravel’s `Mail` facade to send mail:

```php
Mail::to($toMail)->send(new Mailable($subject, $cc));
```

### 2. Create a Mailable Class

Generate a mailable for custom HTML content:

```bash
php artisan make:mail Mailable --markdown=mail.html-mail
```

Ensure you have the `Mailable` class in `app/Mail/Mailable.php`:

```php
<?php

public function __construct(public $subject, public $cc) {}

/**
 * Get the message envelope.
 */
public function envelope(): Envelope
{
    return new Envelope(
        subject: $subject,
        cc: $cc,
    );
}

/**
 * Get the message content definition.
 */
public function content(): Content
{
    return new Content(
        view: 'mail.html-mail',
        with: [
            'subject' => $this->subject,
        ],
    );
}

/**
 * Get the attachments for the message.
 */
public function attachments(): array
{
    return [];
}
```

### 3. Create Mail View

Create an HTML view for your email body at:

```html
<h2>{{ $subject }}</h2>
<p>Namaste,</p>
<p>This is a notification mail.</p>
```

### 4. Create Event Provider

If you don’t have one already:

```bash 
php artisan make:provider EventServiceProvider
```

Register your mail events and listeners in ```app/Providers/EventServiceProvider.php```:

```php
<?php

use Illuminate\Mail\Events\MessageSent;
use App\Listeners\LogSentEmail;

protected $listen = [
    MessageSent::class => [LogSentEmail::class],
];
```

### 5. Create Event Listener

Create a listener for mail sent events:

```bash
php artisan make:listener LogSentEmail --event="Illuminate\Mail\Events\MessageSent"
```

Handle the event:

```php
<?php

use App\Models\EmailLog;

public function handle(MessageSent $event)
{
    EmailLog::create([
        'to' => collect($event->message->getTo())->map(fn($mail) => $mail->getAddress())->first(),
        'subject' => $event->message->getSubject(),
        'message' => $event->message->getHtmlBody() ?? $event->message->getTextBody(),
        'status' => 'sent',
    ]);
}
```

### 6. Create Database Table for Mail Logs.

### 7. Automatic Mail Logging

Now, each time an email is successfully sent, a record will be stored in the ```email_logs``` table.

### License

MIT License. © 2025 [FullStackOnDemand](https://github.com/fullstackondemand)