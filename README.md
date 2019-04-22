# nova-contact-form

Contact form data management for laravel nova projects

## Installation

```bash
composer require nickolaich/nova-contact-form
```

## Publish configuration file

```bash
php artisan vendor:publish --tag=nova-contact-form-config
```

If package auto-discovery is turned on - it will automatically load service provider, otherwise you need to load manually Nickolaich\NovaContactForm\NovaContactFormServiceProvider

Go to frontend, install dependencies:

```
yarn install
```

Compiles and hot-reloads for development

```
yarn run serve
```
