<?php

namespace ToneflixCode\KudiSmsNotification\Tests\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use ToneflixCode\KudiSmsNotification\KudiSmsChannel;
use ToneflixCode\KudiSmsNotification\KudiSmsVoiceMessage;

class SendCall extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message = null)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [KudiSmsChannel::class];
    }

    /**
     * Get the sms representation of the notification.
     *
     * @param  mixed  $notifiable notifiable
     * @return \NotificationChannels\Twilio\TwilioSmsMessage
     */
    public function toKudiSms($notifiable)
    {
        return (new KudiSmsVoiceMessage())->url($this->message);
    }
}
