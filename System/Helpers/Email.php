<?php

namespace Scooby\Helpers;

use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
use Swift_Attachment;
use \Defr\PhpMimeType\MimeType;

class Email
{

    /**
     * Efetua o envio de email auetnticado com ssl ou tls e usa um endereço de servidor smtp
     *
     * @param string $title
     * @param string $msg
     * @param array $from
     * @param array $to
     * @param string $attch
     * @return bool
     */
    public static function sendEmailWithSmtp(string $title, $msg, array $from, array $to, string $attch = null): bool
    {
        $transport = (new Swift_SmtpTransport(SMTP, (int) SMTP_PORT, SMTP_CETTIFICATE))
            ->setUsername(SMTP_USER)
            ->setPassword(SMTP_PASS);
        $mailer = new Swift_Mailer($transport);
        $message = (new Swift_Message($title))
            ->setFrom($from)
            ->setTo($to)
            ->setBody($msg, 'text/html');
        if (!empty($attch) and $attch != null) {
            $mimeType = MimeType::get($attch);
            $message->attach(Swift_Attachment::fromPath($attch, $mimeType));
        }
        $result = $mailer->send($message);
        if ($result < 1) {
            return false;
        }
        return true;
    }
}
