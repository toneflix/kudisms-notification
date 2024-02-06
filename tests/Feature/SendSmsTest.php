<?php

use ToneflixCode\KudiSmsNotification\Tests\Models\User;
use ToneflixCode\KudiSmsNotification\Tests\Notifications\SendCall;
use ToneflixCode\KudiSmsNotification\Tests\Notifications\SendSms;
use ToneflixCode\KudiSmsNotification\Tests\Notifications\SendTtsCall;

test('user can recieve sms', function () {
    $user = User::factory()->create();

    expect(fn () => $user->notify(new SendSms("Hello {$user->name}! This is test SMS.")))
        ->not()
        ->toThrow(\Exception::class);
});//->skip('Skipped for cost saving.');

test('user can recieve voice call.', function () {
    $user = User::factory()->create();
    expect(fn () => $user->notify(new SendCall('https://download.samplelib.com/mp3/sample-3s.mp3')))
        ->not()
        ->toThrow(\Exception::class);
})->skip('Skipped for lack of feature access.');

test('user can recieve text to speach voice call.', function () {
    $user = User::factory()->create();
    expect(fn () => $user->notify(new SendTtsCall("Hello {$user->name}! This is a Text To Speech Call.")))
        ->not()
        ->toThrow(\Exception::class);
})->skip('Skipped for lack of feature access.');
