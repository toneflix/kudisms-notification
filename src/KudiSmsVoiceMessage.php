<?php

namespace ToneflixCode\KudiSmsNotification;

use Illuminate\Support\Traits\Macroable;

class KudiSmsVoiceMessage extends KudiMessage
{
    use Macroable;

    public string $audio;

    /**
     * Set the message url.
     *
     * @return $this
     */
    public function url(string $url): self
    {
        $this->audio = $url;
        $this->callerId = '';

        return $this;
    }

    /**
     * Set the message callerId.
     *
     * @return $this
     */
    public function callerId(string $callerId): self
    {
        $this->callerId = $callerId;

        return $this;
    }
}
