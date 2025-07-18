# KUDI SMS Notifications channel for Laravel

[![Test & Lint](https://github.com/toneflix/kudisms-notification/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/toneflix/kudisms-notification/actions/workflows/run-tests.yml)
[![Latest Stable Version](http://poser.pugx.org/toneflix-code/kudisms-notification/v)](https://packagist.org/packages/toneflix-code/kudisms-notification) [![Total Downloads](http://poser.pugx.org/toneflix-code/kudisms-notification/downloads)](https://packagist.org/packages/toneflix-code/kudisms-notification) [![Latest Unstable Version](http://poser.pugx.org/toneflix-code/kudisms-notification/v/unstable)](https://packagist.org/packages/toneflix-code/kudisms-notification) [![License](http://poser.pugx.org/toneflix-code/kudisms-notification/license)](https://packagist.org/packages/toneflix-code/kudisms-notification) [![PHP Version Require](http://poser.pugx.org/toneflix-code/kudisms-notification/require/php)](https://packagist.org/packages/toneflix-code/kudisms-notification)
[![codecov](https://codecov.io/gh/toneflix/kudisms-notification/graph/badge.svg?token=2O7aFulQ9P)](https://codecov.io/gh/toneflix/kudisms-notification)

This package makes it easy to send [KudiSMS notifications](https://kudisms.net) with Laravel 8.x, 9.x, 10.x, 11.x & 12.x

## Contents

- [Installation](#installation)
- [Usage](#usage)
  - [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Installation

You can install the package via composer:

```bash
composer require toneflix-code/kudisms-notification
```

### Configuration

Add your KudiSMS Account token, SenderId, and CallerId (optional) to your `.env`:

```dotenv
KUDISMS_GATEWAY= # optional
KUDISMS_API_KEY=ZYX # always required
KUDISMS_SENDER_ID=ABCD # always required
KUDISMS_CALLER_ID=ABCD # optional when sender id is set
KUDISMS_TEST_NUMBERS=23423423423,12312312312 # Comma separated list of numbers to send messages to when running tests
```

### Advanced configuration

Run `php artisan vendor:publish --provider="ToneflixCode\KudiSmsNotification\KudiSmsProvider"`

```
/config/kudi-notification.php
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

```php
use ToneflixCode\KudiSmsNotification\KudiSmsChannel;
use ToneflixCode\KudiSmsNotification\KudiSmsMessage;
use Illuminate\Notifications\Notification;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [KudiSmsChannel::class];
    }

    public function toKudiSms($notifiable)
    {
        return (new KudiSmsMessage())
            ->message("Your {$notifiable->service} account was approved!");
    }
}
```

You can also create a Kudi voice call:

```php
use ToneflixCode\KudiSmsNotification\KudiSmsChannel;
use ToneflixCode\KudiSmsNotification\KudiSmsVoiceMessage;
use Illuminate\Notifications\Notification;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [KudiSmsChannel::class];
    }

    public function toKudiSms($notifiable)
    {
        return (new KudiSmsVoiceMessage())
            ->url("https://download.samplelib.com/mp3/sample-3s.mp3");
    }
}
```

Or create a Kudi Text To Speach call:

```php
use ToneflixCode\KudiSmsNotification\KudiSmsChannel;
use ToneflixCode\KudiSmsNotification\KudiSmsTTSMessage;
use Illuminate\Notifications\Notification;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [KudiSmsChannel::class];
    }

    public function toKudiSms($notifiable)
    {
        return (new KudiSmsTTSMessage())
            ->message("Hello {$notifiable->name}, how are you today?");
    }
}
```

In order to let your Notification know which phone are you sending/calling to, the channel will look for the `phone_number` attribute of the Notifiable model. If you want to override this behaviour, add the `routeNotificationForKudiSms` method to your Notifiable model.

```php
public function routeNotificationForKudiSms()
{
    return '+2349034567890';
}
```

### Available Message methods

#### KudiSmsMessage

- `senderId('')`: Accepts a registered SenderId to use as the notification sender.
- `message('')`: Accepts a string value for the notification body.

#### KudiSmsVoiceMessage

- `callerId('')`: Accepts a registered CallerId to use as the notification sender.
- `url('')`: Accepts a url of a publicly available audio file.

#### KudiSmsTTSMessage

- `callerId('')`: Accepts a registered CallerId to use as the notification sender.
- `message('')`: Accepts a string value for the notification body.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

```bash
$ composer test
```

## Security

If you discover any security related issues, please email gregoriohc@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Legacy](https://github.com/3m1n3nc3)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
