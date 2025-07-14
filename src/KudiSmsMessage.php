<?php

namespace ToneflixCode\KudiSmsNotification;

use Illuminate\Support\Traits\Macroable;

class KudiSmsMessage extends KudiMessage
{
    use Macroable;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public string $message = '',
        public string $senderId = '',
        public bool $corporate = false,
    ) {}

    /**
     * Set the message.
     *
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
     * @return $this
     */
    public function senderId(string $senderId): self
    {
        $this->senderId = $senderId;

        return $this;
    }

    /**
     * Indicate that the message is a corporate messaeg.
     *
     * @return $this
     */
    public function corporate(): self
    {
        $this->corporate = true;

        return $this;
    }
}
