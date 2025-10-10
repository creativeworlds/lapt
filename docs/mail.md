# Mail Sent with Log

I create a email notification system for student, centre and admin and each email send create log in database for email summary.

1. Sent email by Laravel Mail.
```php
Mail::to($certificate->student->centre->email)->send(new DocumentsIssued($certificate, $admitCard, $registrationLetter));
```
2. Create mailable for html email body text.
3. Create mail view for mailbale html body text.
4. Create event provider for event listener connector.
5. Create event listner for mail sent event.
6. Create database table for email logs.
7. Each mail sent create email log inside email logs table.