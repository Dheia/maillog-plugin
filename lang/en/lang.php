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
        'empty_success' => 'Mail Log emptied',
        'empty_loading' => 'Emptying Mail Log...',
        'empty_link' => 'Empty Mail Log',
        'preview' => 'View Mail Log',
        'manage' => 'Manage Mail Logs',
    ],
    'field' => [
        'subject' => 'Subject',
        'to' => 'To',
        'cc' => 'CC',
        'bcc' => 'BCC',
        'from' => 'From',
        'sent_at' => 'Sent at',
        'is_sent' => 'Sent',
        'template' => 'Template',
        'content_html' => 'Message',
        'attachments' => 'Attachments',
        'details' => 'Details',
        'ip_address' => 'IP Address',
        'opened' => 'Times Opened',
        'first_opened_at' => 'First Opened',
        'last_opened_at' => 'Last Opened',
        'created_at' => 'Created at',
    ],
    'settings' => [
        'label' => 'Mail Log Settings',
        'description' => 'Manage Mail Log settings.',
        'prune_logs_period' => 'Prune period in days',
        'prune_logs_period_comment' => 'Prune Mail Log records older than specified number of days.',
        'track_opens' => 'Track when user opens email',
        'track_opens_comment' => 'Add invisible image to sent email to track when user opens it.',
    ],
];
