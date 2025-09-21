<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendMail {

    public function Send_Mail($conf, $mailCnt) {
        // Load PHPMailer classes
        require_once __DIR__ . '/../vendor/autoload.php'; // Make sure PHPMailer is installed via Composer

        $mail = new PHPMailer(true);

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host       = $conf['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $conf['smtp_user'];
            $mail->Password   = $conf['smtp_pass'];
            $mail->SMTPSecure = $conf['smtp_secure']; // 'ssl' or 'tls'
            $mail->Port       = $conf['smtp_port'];

            // Sender info
            $mail->setFrom($mailCnt['mail_from'], $mailCnt['name_from']);

            // Recipient
            $mail->addAddress($mailCnt['mail_to'], $mailCnt['name_to']);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $mailCnt['subject'];
            $mail->Body    = $mailCnt['body'];

            // Send the message
            $mail->send();

            echo "✅ Email has been sent successfully to {$mailCnt['mail_to']}";

        } catch (Exception $e) {
            echo "❌ Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
