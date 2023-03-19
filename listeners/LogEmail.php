<?php

namespace Renatio\MailLog\Listeners;

use ReflectionObject;
use Renatio\MailLog\Models\MailLog;
use Renatio\MailLog\Models\Settings;
use System\Models\MailTemplate;

class LogEmail
{
    public function handle($mailer, $view, $message)
    {
        MailLog::unguard();

        $mailTemplates = MailTemplate::listAllTemplates();

        $maiLog = MailLog::create([
            'content_html' => $message->getHtmlBody(),
            'subject' => $message->getSubject(),
            'to' => $this->formatAddresses($message->getTo()),
            'cc' => $this->formatAddresses($message->getCc()),
            'bcc' => $this->formatAddresses($message->getBcc()),
            'from' => $this->formatAddresses($message->getFrom()),
            'ip_address' => request()->ip(),
            'template' => array_key_exists($view, $mailTemplates) ? $view : null,
            'attachments' => $this->getAttachments($message),
        ]);

        $message->getHeaders()->addTextHeader('X-LOG-HASH', $maiLog->hash);

        if (Settings::get('track_opens')) {
            $symfonyMessage = $message->getSymfonyMessage();

            $symfonyMessage->setBody(
                $symfonyMessage->html($symfonyMessage->getHtmlBody().$this->invisibleImage($maiLog->hash))->getBody()
            );
        }
    }

    public function formatAddresses($addresses)
    {
        return collect($addresses)
            ->map(fn($address) => $address->toString())
            ->implode(', ');
    }

    protected function getAttachments($message)
    {
        return collect($message->getSymfonyMessage()->getAttachments())
            ->map(function ($attachment) {
                if (method_exists($attachment, 'getFilename')) {
                    return $attachment->getFilename();
                }

                // todo remove when require php@8.1
                $reflection = new ReflectionObject($attachment);
                $filename = $reflection->getProperty('filename');
                $filename->setAccessible(true);

                return $filename->getValue($attachment);
            });
    }

    protected function invisibleImage($hash)
    {
        return '<img src="'.url('/track/opened/'.$hash).'" style="display:none; width:0; height:0;" />';
    }
}
