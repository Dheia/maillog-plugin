<?php

namespace Renatio\MailLog\Listeners;

use Renatio\MailLog\Models\MailLog;

class LogEmail
{
    public function handle($mailer, $view, $message)
    {
        MailLog::unguard();

        MailLog::create([
            'content_html' => $message->getHtmlBody(),
            'subject' => $message->getSubject(),
            'to' => $this->formatAddresses($message->getTo()),
            'cc' => $this->formatAddresses($message->getCc()),
            'bcc' => $this->formatAddresses($message->getBcc()),
            'from' => $this->formatAddresses($message->getFrom()),
            'ip_address' => request()->ip(),
            'template' => is_string($view) ? $view : null,
            'attachments' => $this->getAttachments($message),
        ]);
    }

    public function formatAddresses($addresses)
    {
        return collect($addresses)
            ->map(function ($address) {
                return $address->toString();
            })
            ->implode(', ');
    }

    protected function getAttachments($message)
    {
        return collect($message->getSymfonyMessage()->getAttachments())
            ->map(function ($attachment) {
                return $attachment->getFilename();
            });
    }
}
