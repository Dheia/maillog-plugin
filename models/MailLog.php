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
        if (! $this->attachments) {
            return 0;
        }

        return count($this->attachments);
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
        $prunePeriod = (int) Settings::get('prune_logs_period');

        if (! $prunePeriod) {
            exit;
        }

        return static::where('created_at', '<=', now()->subDays($prunePeriod));
    }
}
