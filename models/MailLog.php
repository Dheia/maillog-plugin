<?php

namespace Renatio\MailLog\Models;

use Illuminate\Database\Eloquent\MassPrunable;
use October\Rain\Database\Model;

class MailLog extends Model
{
    use MassPrunable;

    public $table = 'renatio_maillog_logs';

    protected $jsonable = ['attachments'];

    public function getAttachmentsCountAttribute()
    {
        return $this->attachments ? count($this->attachments) : 0;
    }

    public function filterFields($fields)
    {
        foreach (['cc', 'bcc', 'attachments'] as $field) {
            if (empty($fields->{$field}->value)) {
                $fields->{$field}->hidden = true;
            }
        }
    }

    public function prunable()
    {
        if (! ($prunePeriod = (int) Settings::get('prune_logs_period'))) {
            exit;
        }

        return static::where('created_at', '<=', now()->subDays($prunePeriod));
    }
}
