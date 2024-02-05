<?php

namespace ToneflixCode\KudiSmsNotification\Exceptions;

use Exception;
use ToneflixCode\KudiSmsNotification\KudiSmsMessage;
use ToneflixCode\KudiSmsNotification\KudiSmsVoiceMessage;

class CouldNotSendNotification extends Exception
{
    public static function respondedWithAnError(Exception $exception)
    {
        return new static(
            $exception->getMessage(),
            $exception->getCode(),
            $exception
        );
    }

    public static function invalidMessage()
    {
        return new static(
            'The toKudiSms() method only accepts instances of ' .
                KudiSmsMessage::class . ' or ' .
                KudiSmsVoiceMessage::class
        );
    }

    public static function missingFrom(): self
    {
        return new static('Notification was not sent. Missing `from` number.');
    }

    public static function invalidReceiver(): self
    {
        return new static(
            'The notifiable did not have a receiving phone number. Add a routeNotificationForKudiSms
            method or a phone_number attribute to your notifiable.'
        );
    }
}
