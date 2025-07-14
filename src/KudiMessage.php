<?php

namespace ToneflixCode\KudiSmsNotification;

use Illuminate\Support\Traits\Macroable;

class KudiMessage
{
    use Macroable;

    public string $message;

    public string $callerId;

    public string $senderId;

    public bool $corporate;
}
