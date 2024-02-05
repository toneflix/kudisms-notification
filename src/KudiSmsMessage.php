<?php

namespace ToneflixCode\KudiSmsNotification;

use Illuminate\Support\Traits\Macroable;

class KudiSmsMessage extends KudiMessage
{
    use Macroable;

    /**
     * Create a new message instance.
     *
     * @param  string $message
     */
    public function __construct(string $message = '')
    {
        $this->message = $message;
        $this->senderId = '';
    }

    /**
     * Set the message.
     *
     * @param  string $message
     * @return $this
     */
    public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set the message senderId.
     *
     * @param  string $senderId
     * @return $this
     */
    public function senderId(string $senderId): self
    {
        $this->senderId = $senderId;

        return $this;
    }
}
