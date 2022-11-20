<?php

namespace Renatio\MailLog\Listeners;

use Renatio\MailLog\Models\MailLog;

class EmailSent
{
    public function handle($mailer, $view, $message)
    {
        $hash = $message->getHeaders()->get('X-LOG-HASH')?->getValue();

        if (! $hash) {
            return;
        }

        MailLog::where('hash', $hash)->update(['sent_at' => now()]);
    }
}
