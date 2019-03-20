<?php

namespace Nickolaich\NovaContactForm\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SimpleMessage;
use Illuminate\Notifications\Notification;
use Nickolaich\NovaContactForm\Contracts\IContactFormNotification;

class ContactFormSubmitted extends Notification implements IContactFormNotification
{
    protected $opts = [];

    public function __construct($opts = [])
    {
        $this->opts = $opts;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return config('nova-contact-form.notifications.channels');
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        /*logger(config('nova-contact-form.recipient_email'));
        if (!config('nova-contact-form.recipient_email')){
            return;
        }*/
        $recipientName = $this->opts['recipient_name'] ?? config('nova-contact-form.recipient_name');
        $body = $this->opts['body'] ?? trans('nova-contact-form::messages.notifications.default_body');
        $subject = $this->opts['subject'] ?? trans('nova-contact-form::messages.notifications.default_subject');
        return (new MailMessage())
            ->greeting('Hi '.$recipientName.',')
            ->line(trans('nova-contact-form::messages.notifications.text'))
            ->line($body)
            ->subject($subject);
    }
}
