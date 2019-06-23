[![Build Status](https://travis-ci.org/vitanov/onesignal-sdk.svg?branch=master)](https://travis-ci.org/vitanov/onesignal-sdk)

# OneSignal API

For reference - [https://documentation.onesignal.com/reference](OneSignal Docs).

Still work-in-progress.

## Installation

Using [Composer](http://getcomposer.org):

```
composer require vitanov/onesignal-sdk
```

## Contribution

Contributions are welcome, the only thing that is important for me is the expressive syntax and at some point when I've written tests - tests.

## Usage

This package uses a fluent syntax, so it is very easy to read and understand the underlying code.

```php
<?php

require __DIR__ . '/vendor/autoload.php';

// By default, if a token is not passed in the constructor,
// the class will try to load the token from
// ONESIGNAL_API_KEY environment variable. The second param,
// the API endpoint is set as default value to
// https://onesignal.com/api/v1, which is the current endpoint:
$sdk = new Mirovit\OneSignal\OneSignal();
// or explicitly them:
$sdk = new Mirovit\OneSignal\OneSignal(
    'rest api key',
    'api endpoint'
);

// Retrieve player
$user = $sdk
            ->players()
            ->get('player-id', ['app_id' => 'app-id']);
```

## Available endpoints

### players()

```php
<?php
// https://documentation.onesignal.com/reference
$sdk
    ->players()
    ->all();

// https://documentation.onesignal.com/reference#view-device
$sdk
    ->players()
    ->get('player-id', ['app_id' => 'app-id']);

// https://documentation.onesignal.com/reference#edit-device
$sdk
    ->players()
    ->update([
        // required
        'id'      => 'player-id',
        'app_id'     => 'app-id',
        // optional
        'identifier'      => '',
        'language'  => '',
        'test_type' => 1,
        // ... and more
    ]);
```

### notifications()

```php
<?php
// https://documentation.onesignal.com/reference#create-notification
$sdk
    ->notifications()
    ->create([
        'app_id'   => 'app-id',
         'filters'  => (new \Mirovit\OneSignal\Filters())
             ->tag('key', 'value')
             ->orWhere()
             ->tag('key', 'relation', 'value')
             ->country('bg')
             ->email('test@test.com'),
         'contents' => [
             'en' => 'test',
         ],
     ]);
```

