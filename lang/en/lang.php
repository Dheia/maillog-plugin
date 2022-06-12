<?php

return [
    'plugin' => [
        'name' => 'Mail Logs',
        'description' => 'View mail messages with their recorded time and details.',
    ],
    'navigation' => [
        'mail_logs' => 'Mail Logs',
        'description' => 'View mail messages with their recorded time and details.',
    ],
    'mail_log' => [
        'empty_success' => 'Mail log emptied',
        'empty_loading' => 'Emptying mail log...',
        'empty_link' => 'Empty mail log',
        'preview' => 'View mail log',
        'manage' => 'Manage mail logs',
    ],
    'field' => [
        'subject' => 'Subject',
        'to' => 'To',
        'cc' => 'CC',
        'bcc' => 'BCC',
        'from' => 'From',
        'send_at' => 'Send at',
        'template' => 'Template',
        'content_html' => 'Message',
        'attachments' => 'Attachments',
        'details' => 'Details',
        'ip_address' => 'IP Address',
    ],
    'settings' => [
        'label' => 'Mail Log Settings',
        'description' => 'Manage mail log settings.',
        'prune_logs_period' => 'Prune period in days',
        'prune_logs_period_comment' => 'Prune mail log records older than specified number of days.',
    ],
];
