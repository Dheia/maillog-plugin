<?php

use Renatio\MailLog\Models\MailLog;

Route::get('/track/opened/{hash}', function ($hash) {
    MailLog::unguard();

    $mailLog = MailLog::where('hash', $hash)->first();

    $mailLog?->update([
        'first_opened_at' => $mailLog->first_opened_at ?? now(),
        'last_opened_at' => now(),
        'opened' => $mailLog->opened + 1,
    ]);
});
