<?php

namespace Renatio\MailLog\Controllers;

use Backend\Behaviors\FormController;
use Backend\Behaviors\ListController;
use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;
use October\Rain\Support\Facades\Flash;
use Renatio\MailLog\Models\MailLog;
use Renatio\MailLog\Models\Settings;
use System\Classes\SettingsManager;

class MailLogs extends Controller
{
    public $requiredPermissions = ['utilities.mail_logs'];

    public $implement = [
        ListController::class,
        FormController::class,
    ];

    public $listConfig = 'config_list.yaml';

    public $formConfig = 'config_form.yaml';

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');

        SettingsManager::setContext('Renatio.MailLog', 'maillogs');
    }

    public function listExtendColumns($list)
    {
        if (! Settings::get('track_opens')) {
            $list->removeColumn('first_opened_at');
            $list->removeColumn('last_opened_at');
            $list->removeColumn('opened');
        }
    }

    public function formExtendFields($form)
    {
        collect(['cc', 'bcc', 'attachments'])
            ->filter(fn($field) => ! $form->model->$field)
            ->each(fn($field) => $form->removeField($field));
    }

    public function index_onRefresh()
    {
        return $this->listRefresh();
    }

    public function index_onEmptyLog()
    {
        MailLog::truncate();

        Flash::success(e(trans('renatio.maillogs::lang.mail_log.empty_success')));

        return $this->listRefresh();
    }

    public function previewEmail($id)
    {
        $log = $this->formFindModelObject($id);

        return response($log->content_html);
    }
}
