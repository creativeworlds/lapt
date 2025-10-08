<?php

namespace App\Helpers;

use App\Models\EmailLog;
use Illuminate\Support\Facades\Mail;
use Throwable;

class EmailHelper
{
    /**
     * Send email and log result.
     *
     * @param array|string $to
     * @param \Illuminate\Mail\Mailable $mailable
     * @param array $cc
     * @param array $bcc
     * @return bool
     */
    public static function send($to, $cc = [], $subject, $mailable, $student_id, $centre_id): void
    {
        try {
            // Send Email for Document Issued
            Mail::to($to)->cc($cc)->send($mailable);

            static::logEmail($to, $student_id, $centre_id, $cc, $subject, $mailable, 'sent');
        } catch (Throwable $e) {
            static::logEmail($to, $student_id, $centre_id, $cc, $subject, null, 'failed', $e->getMessage());
        }
    }

    /**
     * Store email details into email_logs table.
     */
    protected static function logEmail($to, $student_id, $centre_id, $cc, $subject, $mailable, string $status = 'sent', ?string $error = null)
    {
        try {
            $message = $mailable->build();
            $subject = $message->subject ?? ($mailable->subject ?? 'No Subject');

            $bodyPreview = method_exists($message, 'render') ? strip_tags($message->render()) : '';

            EmailLog::create([
                'to_email' => $to,
                'user_id' => auth()->id(),
                'student_id' => $student_id,
                'centre_id' => $centre_id,
                'cc_emails' => $cc,
                'subject' => $subject,
                'message' => $bodyPreview,
                'status' => $status,
                'error_message' => $error,
            ]);
        } catch (Throwable $e) {
            \Log::error('Email logging failed: ' . $e->getMessage());
        }
    }
}