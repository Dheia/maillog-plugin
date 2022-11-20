<?php

namespace Renatio\MailLog\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;
use System\Behaviors\SettingsModel;

class Settings extends Model
{
    use Validation;

    public $implement = [SettingsModel::class];

    public $settingsCode = 'renatio_maillog_settings';

    public $settingsFields = 'fields.yaml';

    public $rules = [
        'prune_logs_period' => ['integer', 'nullable'],
    ];

    public function initSettingsData()
    {
        $this->prune_logs_period = 30;

        $this->track_opens = true;
    }
}
