<?php

namespace Nickolaich\NovaContactForm\Nova\Resources;


use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Resource as NovaResource;
use Nickolaich\NovaContactForm\Contracts\IContactFormModel;
use Nickolaich\NovaContactForm\Models\ContactFormModel;

class ContactFormResource extends NovaResource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ContactFormModel::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'description', 'subject', 'email', 'phone'
    ];

    public static $displayInNavigation = true;

    public function __construct($resource)
    {
        parent::__construct($resource);

    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make(trans('nova-contact-form::messages.forms.name'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),
            Text::make(trans('nova-contact-form::messages.forms.subject'), 'subject')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(trans('nova-contact-form::messages.forms.email'), 'email')
                ->sortable()
                ->rules('max:255', 'email'),

            Text::make(trans('nova-contact-form::messages.forms.phone'), 'phone')
                ->sortable()
                ->rules('max:255'),

            Select::make(trans('nova-contact-form::messages.forms.status'), 'status')
                ->options((new static::$model)->getStatusOptions())->hideFromIndex(),

            Boolean::make('Is Read', function () {
                return $this->status === ContactFormModel::STATUS_READ;
            })->onlyOnIndex(),


            Textarea::make(trans('nova-contact-form::messages.forms.description'), 'description')
                ->sortable()
                ->hideFromIndex(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
        ];
    }

    public static function label() {
        return trans('nova-contact-form::messages.resources_label');
    }
}
