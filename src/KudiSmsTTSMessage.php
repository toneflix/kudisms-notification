<?php

namespace ToneflixCode\KudiSmsNotification;

use Illuminate\Support\Traits\Macroable;

class KudiSmsTTSMessage extends KudiMessage
{
    use Macroable;

    /**
     * Set the message.
     *
     * @param  string $message
     * @return $this
     */
    public function message(string $message): self
    {
        $this->message = $message;
        $this->callerId = '';

        return $this;
    }

    /**
     * Set the message callerId.
     *
     * @param  string $callerId
     * @return $this
     */
    public function callerId(string $callerId): self
    {
        $this->callerId = $callerId;

        return $this;
    }
}
