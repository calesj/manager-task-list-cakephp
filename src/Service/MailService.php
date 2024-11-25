<?php
declare(strict_types=1);

namespace App\Service;

use Cake\Mailer\Mailer;

trait MailService
{
    /**
     * @param string $to
     * @param string $subject
     * @param string $message
     * @return void
     */
    public function send(string $to, string $subject, string $message): void
    {
        $mailer = new Mailer('default');
        $mailer->setFrom('no-reply@example.com');
        $mailer->setTo($to);
        $mailer->setSubject($subject);
        $mailer->deliver($message);
    }
}
