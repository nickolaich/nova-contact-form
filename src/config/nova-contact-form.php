<?php
return [
    'api_prefix' => 'api/site',
    'notifications' => [
        'channels' => ['mail'],
        'recipient_email'=>env('CONTACT_FORM_RECIPIENT_EMAIL', ''),
        'recipient_name'=>env('CONTACT_FORM_RECIPIENT_NAME', 'Admin'),
    ]
];