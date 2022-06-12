<?php

namespace Renatio\MailLog;

use Backend\Facades\Backend;
use Illuminate\Database\Console\PruneCommand;
use Illuminate\Support\Facades\Event;
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
            'homepage' => '', // todo
        ];
    }

    public function boot()
    {
        Event::listen('mailer.send', LogEmail::class);
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
                'permissions' => ['system.access_logs'],
            ],
            'settings' => [
                'label' => 'renatio.maillog::lang.settings.label',
                'description' => 'renatio.maillog::lang.settings.description',
                'category' => SettingsManager::CATEGORY_LOGS,
                'icon' => 'octo-icon-mail-settings',
                'class' => Settings::class,
                'order' => 1000,
                'keywords' => 'mail log settings',
                'permissions' => ['system.access_logs'],
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
}
