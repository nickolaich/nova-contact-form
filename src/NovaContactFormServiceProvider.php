<?php

namespace Nickolaich\NovaContactForm;

use Illuminate\Support\Facades\Route;
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

        $this->defineRoutes();

        $this->mergeConfigFrom(__DIR__ . '/config/nova-contact-form.php', 'nova-contact-form');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/lang', 'nova-contact-form');

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

    /**
     * Define the Package routes.
     *
     * @return void
     */
    protected function defineRoutes()
    {
        // If the routes have not been cached, we will include them in a route group
        // so that all of the routes will be conveniently registered to the given
        // controller namespace. After that we will load the route file.
        if (!$this->app->routesAreCached()) {
            Route::group([
                'prefix' => config('nova-contact-form.api_prefix'),
                'namespace' => '\Nickolaich\NovaContactForm\Http\Controllers'],
                function ($router) {
                    require __DIR__ . '/Http/routes.php';
                }
            );
        }
    }
}
