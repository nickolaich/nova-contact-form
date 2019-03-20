<?php

namespace Nickolaich\NovaContactForm;

use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Nickolaich\NovaContactForm\Contracts\IContactFormModel;
use Nickolaich\NovaContactForm\Contracts\IContactFormNotification;
use Nickolaich\NovaContactForm\Contracts\IContactFormService;
use Nickolaich\NovaContactForm\Models\ContactFormModel;
use Nickolaich\NovaContactForm\Notifications\ContactFormSubmitted;
use Nickolaich\NovaContactForm\Nova\Resources\ContactFormResource;
use Nickolaich\NovaContactForm\Services\NovaContactFormService;


class NovaContactFormServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->mergeConfigFrom(__DIR__.'/config/nova-contact-form.php', 'nova-contact-form');
        $this->loadRoutesFrom(__DIR__.'/routes/nova-contact-form.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadTranslationsFrom(__DIR__.'/lang', 'nova-contact-form');


    }

    protected function resources()
    {

        Nova::resources([
            ContactFormResource::class,
        ]);
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IContactFormService::class, NovaContactFormService::class);
        $this->app->bind(IContactFormNotification::class, ContactFormSubmitted::class);
        $this->app->bind(IContactFormModel::class, ContactFormModel::class);
    }
}