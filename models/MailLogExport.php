<?php

namespace Renatio\MailLog\Models;

use Backend\Models\ExportModel;

class MailLogExport extends ExportModel
{
    public $table = 'renatio_maillog_logs';

    public function exportData($columns, $sessionKey = null)
    {
        return static::get()->toArray();
    }
}
