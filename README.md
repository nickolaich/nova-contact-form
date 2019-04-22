# Nova Contact Form

Contact form data management for laravel nova projects

## Installation

```bash
composer require nickolaich/nova-contact-form
```

## Publish configuration file

```bash
php artisan vendor:publish --tag=nova-contact-form-config
```

This is what configuration file looks like:

```php
return [
    'api_prefix' => 'api/site',
    'notifications' => [
        'channels' => ['mail'],
        'recipient_email'=>env('CONTACT_FORM_RECIPIENT_EMAIL', ''),
        'recipient_name'=>env('CONTACT_FORM_RECIPIENT_NAME', 'Admin'),
    ]
];
```

## Frontend

For frontend, should install dependencies:

```
yarn install
```

Compiles and hot-reloads for development

```
yarn run serve
```
