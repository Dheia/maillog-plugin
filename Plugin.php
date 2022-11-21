<?php

namespace Renatio\MailLog;

use Backend\Facades\Backend;
use Illuminate\Database\Console\PruneCommand;
use Illuminate\Support\Facades\Event;
use Renatio\MailLog\Listeners\EmailSent;
use Renatio\MailLog\Listeners\LogEmail;
use Renatio\MailLog\Models\MailLog;
use Renatio\MailLog\Models\Settings;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'renatio.maillog::lang.plugin.name',
            'description' => 'renatio.maillog::lang.plugin.description',
            'author' => 'Renatio',
            'icon' => 'octo-icon-mail-messages',
            'homepage' => 'https://octobercms.com/plugin/renatio-maillog',
        ];
    }

    public function boot()
    {
        Event::listen('mailer.prepareSend', LogEmail::class);

        Event::listen('mailer.send', EmailSent::class);
    }

    public function registerSettings()
    {
        return [
            'maillogs' => [
                'label' => 'renatio.maillog::lang.navigation.mail_logs',
                'category' => SettingsManager::CATEGORY_LOGS,
                'icon' => 'octo-icon-mail-messages',
                'url' => Backend::url('renatio/maillog/maillogs'),
                'order' => 950,
                'keywords' => 'mail log',
                'description' => 'renatio.maillog::lang.navigation.description',
                'permissions' => ['utilities.mail_logs'],
            ],
            'settings' => [
                'label' => 'renatio.maillog::lang.settings.label',
                'description' => 'renatio.maillog::lang.settings.description',
                'category' => SettingsManager::CATEGORY_LOGS,
                'icon' => 'octo-icon-mail-settings',
                'class' => Settings::class,
                'order' => 1000,
                'keywords' => 'mail log settings',
                'permissions' => ['utilities.mail_logs_settings'],
                'size' => 'small',
            ],
        ];
    }

    public function register()
    {
        $this->registerConsoleCommand('model:prune', PruneCommand::class);
    }

    public function registerSchedule($schedule)
    {
        $schedule->command('model:prune', [
            '--model' => [MailLog::class],
        ])->daily();
    }

    public function registerPermissions()
    {
        return [
            'utilities.mail_logs' => [
                'tab' => 'Utilities',
                'label' => 'renatio.maillog::lang.permissions.mail_logs',
            ],
            'utilities.mail_logs.preview' => [
                'tab' => 'Utilities',
                'label' => 'renatio.maillog::lang.permissions.mail_logs_preview',
            ],
            'utilities.mail_logs.delete' => [
                'tab' => 'Utilities',
                'label' => 'renatio.maillog::lang.permissions.mail_logs_delete',
            ],
            'utilities.mail_logs.truncate' => [
                'tab' => 'Utilities',
                'label' => 'renatio.maillog::lang.permissions.mail_logs_truncate',
            ],
            'utilities.mail_logs.export' => [
                'tab' => 'Utilities',
                'label' => 'renatio.maillog::lang.permissions.mail_logs_export',
            ],
            'utilities.mail_logs_settings' => [
                'tab' => 'Utilities',
                'label' => 'renatio.maillog::lang.permissions.mail_logs_settings',
            ],
        ];
    }
}
