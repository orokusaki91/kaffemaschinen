<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('sandbox8b523dc1cc934fb29fa4da319b9f0652.mailgun.org'),
        'secret' => env('key-b6d0198e23cc618cdb92f74336cf53e6'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('pk_test_OwlA6Ol8iRgfpTRb8JZxdOR4'),
        'secret' => env('sk_test_AeK9s7EcbwqwKDKF0XapDIXe'),
    ],

];
