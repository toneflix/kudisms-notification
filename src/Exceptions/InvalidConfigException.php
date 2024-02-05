<?php

declare(strict_types=1);

namespace ToneflixCode\KudiSmsNotification\Exceptions;

class InvalidConfigException extends \Exception
{
    public static function missingConfig(): self
    {
        return new self('Missing config: You must set either the caller_id or sender_id.');
    }

    public static function missingToken(): self
    {
        return new self('Missing config: The api_key is required to send a KudiSMS Notification.');
    }
}
