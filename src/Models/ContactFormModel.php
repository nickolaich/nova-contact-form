<?php

namespace Nickolaich\NovaContactForm\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Nickolaich\NovaContactForm\Contracts\IContactFormModel;

class ContactFormModel extends Model implements IContactFormModel
{

    const STATUS_SENT = 'sent';
    const STATUS_READ = 'read';

    use Notifiable;
    protected $table = 'contacts';
    protected $fillable = [
        'name',
        'subject',
        'description',
        'phone',
        'email',
    ];

    /**
     * @return string
     */
    public function getDefaultStatus()
    {
        return static::STATUS_SENT;
    }

    /**
     * @return mixed
     */
    public function getStatusOptions()
    {
        return [
            static::STATUS_SENT => trans('nova-contact-form::messages.statuses.'.static::STATUS_SENT),
            static::STATUS_READ => trans('nova-contact-form::messages.statuses.'.static::STATUS_READ),
        ];
    }

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return config('nova-contact-form.notifications.recipient_email');
    }

}