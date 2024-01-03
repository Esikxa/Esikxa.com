<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use Throwable;
use Illuminate\Support\Facades\Log;

class EmailHelper
{
    public static function sendEmail($receiverEmail, $subject, $content, $replyTo = "", $ccBCC = [])
    {
        $logo = asset('image/health360.png');
        $senderEmail = env('MAIL_FROM_ADDRESS', 'nareshkumar.khasu@peacenepal.com.np');
        $senderName = env('MAIL_FROM_NAME', 'Health Yaad Aayo');
        $sitePath = route('frontend.index');
        $siteName = config('app.name');

        $data = array(
            'logopath' => $logo,
            'content' => $content,
            'footer' => ' Copyright ' . date('Y') . ' ',
            'sitepath' => $sitePath,
            'sitename' => $siteName,
        );

        try {
            $mail = Mail::send('emails.email', $data, function ($message)
            use ($senderEmail, $senderName, $receiverEmail, $subject, $data) {
                $message->from($senderEmail, $senderName);
                $message->to($receiverEmail)->subject($subject);
            });
            if ($mail instanceof \Illuminate\Mail\SentMessage) {
                return true;
            } else {
                return false;
            }
        } catch (Throwable $e) {
            dd($e);
            return false;
        }
    }
}
