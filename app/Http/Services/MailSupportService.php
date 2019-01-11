<?php

namespace App\Http\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailSupportService
{

    public function mail(string $to, string $subject, string $message)
    {
        $mail = new PHPMailer(true); // Passing `true` enables exceptions

        try {
            // Server settings
            //$mail->SMTPDebug = 2; // Enable verbose debug output
            if (config('mail.driver') == "SMTP") {
                $mail->isSMTP();
                $mail->SMTPSecure = config('mail.encryption');
                $mail->Port = config('mail.port');
            }
            $mail->Host = config('mail.host');

            if (config('mail.username') != "") {
                $mail->SMTPAuth = true;
                $mail->Username = config('mail.username');
                $mail->Password = config('mail.password');
            }


            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            // Recipients
            $mail->setFrom(config('mail.from.address'), config('mail.from.name'));
            $mail->addAddress($to);

            //Content
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->isHTML(false);
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

        } catch (Exception $e) {
            dd($e, $mail->ErrorInfo);
        }
    }
}