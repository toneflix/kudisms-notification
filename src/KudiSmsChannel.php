<?php

namespace ToneflixCode\KudiSmsNotification;

use Exception;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Notifications\Notification;
use ToneflixCode\KudiSmsNotification\Exceptions\CouldNotSendNotification;

class KudiSmsChannel
{
    /**
     * KudiSmsChannel constructor.
     */
    public function __construct(
        protected KudiNotification $kudi,
        protected Dispatcher $events
    ) {
        //
    }

    /**
     * Get the address to send a notification to.
     *
     * @param  mixed  $notifiable
     * @param  Notification|null  $notification
     * @return mixed
     *
     * @throws CouldNotSendNotification
     */
    protected function getTo($notifiable, $notification = null)
    {
        if ($notifiable->routeNotificationFor(self::class, $notification)) {
            return $notifiable->routeNotificationFor(self::class, $notification);
        }
        if ($notifiable->routeNotificationFor('kudiSms', $notification)) {
            return $notifiable->routeNotificationFor('kudiSms', $notification);
        }
        if (isset($notifiable->phone_number)) {
            return $notifiable->phone_number;
        }

        throw CouldNotSendNotification::invalidReceiver();
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @return mixed
     *
     * @throws Exception
     */
    public function send($notifiable, Notification $notification)
    {
        try {
            $to = $this->getTo($notifiable, $notification);
            $message = $notification->toKudiSms($notifiable);

            if (is_string($message)) {
                $message = new KudiSmsMessage($message);
            }

            if (! $message instanceof KudiMessage) {
                throw CouldNotSendNotification::invalidMessage();
            }

            return $this->kudi->sendMessage($message, $to);
        } catch (Exception $exception) {
            $event = new NotificationFailed(
                $notifiable,
                $notification,
                'kudiSms',
                ['message' => $exception->getMessage(), 'exception' => $exception]
            );

            $this->events->dispatch($event);

            throw $exception;
        }
    }
}
