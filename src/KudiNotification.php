<?php

namespace ToneflixCode\KudiSmsNotification;

use ToneflixCode\KudiSmsNotification\Exceptions\CouldNotSendNotification;
use ToneflixCode\KudiSmsNotification\Exceptions\InvalidConfigException;
use ToneflixCode\KudiSmsPhp\SmsSender;
use ToneflixCode\KudiSmsPhp\VoiceSender;

class KudiNotification
{
    public ?string $senderId;

    public ?string $callerId;

    public string $apiKey;

    public function __construct(?string $senderId = null, ?string $apiKey = null, ?string $callerId = null)
    {
        $this->senderId = $senderId ?: config('kudi-notification.sender_id');
        $this->callerId = $callerId ?: config('kudi-notification.caller_id');
        $this->apiKey = $apiKey ?: config('kudi-notification.api_key');

        if (! $this->apiKey) {
            throw InvalidConfigException::missingToken();
        }

        if (! $this->senderId && ! $this->callerId) {
            throw InvalidConfigException::missingConfig();
        }
    }

    public function sms(?string $senderId = null, ?string $apiKey = null): SmsSender
    {
        if (empty($callerId) && empty($this->senderId)) {
            throw CouldNotSendNotification::missingFrom();
        }

        return new SmsSender(
            $senderId ?: $this->senderId,
            $apiKey ?: $this->apiKey
        );
    }

    public function voice(?string $callerId = null, ?string $apiKey = null): VoiceSender
    {
        if (empty($callerId) && empty($this->callerId) && empty($this->senderId)) {
            throw CouldNotSendNotification::missingFrom();
        }

        return new VoiceSender(
            $callerId ?: $this->callerId ?: $this->senderId,
            $apiKey ?: $this->apiKey
        );
    }

    /**
     * Send a KudiMessage to the a phone number.
     *
     *
     * @return mixed
     *
     * @throws CouldNotSendNotification
     */
    public function sendMessage(KudiMessage $message, ?string $to)
    {
        if ($message instanceof KudiSmsMessage) {
            return $this->sms($message->senderId ?: $this->senderId)->send($to, $message->message);
        }

        if ($message instanceof KudiSmsVoiceMessage) {
            return $this->voice($message->callerId ?: $this->callerId)->send($to, $message->audio);
        }

        if ($message instanceof KudiSmsTTSMessage) {
            return $this->voice($message->callerId ?: $this->callerId)->tts($to, $message->message);
        }

        throw CouldNotSendNotification::invalidMessage($message);
    }
}
