<?php

namespace Renatio\MailLog\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\MassPrunable;
use October\Rain\Database\Model;
use System\Models\MailTemplate;

class MailLog extends Model
{
    use MassPrunable;

    public $table = 'renatio_maillog_logs';

    protected $jsonable = ['attachments'];

    protected $dates = ['first_opened_at', 'last_opened_at', 'sent_at'];

    public function beforeCreate()
    {
        $this->hash = (string) str()->uuid();
    }

    public function getAttachmentsCountAttribute()
    {
        return $this->attachments ? count($this->attachments) : 0;
    }

    public function getIsSentAttribute()
    {
        return ! ! $this->sent_at;
    }

    public function prunable()
    {
        if (! ($prunePeriod = (int) Settings::get('prune_logs_period'))) {
            exit;
        }

        return static::where('created_at', '<=', now()->subDays($prunePeriod));
    }

    public function getTemplateOptions()
    {
        return MailTemplate::orderBy('code')->lists('code', 'code');
    }

    public function scopeCreatedAtFilter($query, $scope)
    {
        $this->scopeDateFilter($query, $scope, 'created_at');
    }

    public function scopeDateFilter($query, $scope, $column)
    {
        match ($scope->condition) {
            'equals' => $query->whereDate($column, Carbon::parse($scope->value)),
            'after' => $query->whereDate($column, '>=', Carbon::parse($scope->value)),
            'before' => $query->whereDate($column, '<=', Carbon::parse($scope->value)),
            default => $query
                ->whereDate($column, '>=', Carbon::parse($scope->after))
                ->whereDate($column, '<=', Carbon::parse($scope->before)),
        };
    }
}
