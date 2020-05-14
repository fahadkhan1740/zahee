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
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'paytm-wallet' => [
    'env' => 'local', // values : (local | production)
    'merchant_id' => env('YOUR_MERCHANT_ID'),
    'merchant_key' => env('YOUR_MERCHANT_KEY'),
    'merchant_website' => env('YOUR_WEBSITE'),
    'channel' => env('YOUR_CHANNEL'),
    'industry_type' => env('YOUR_INDUSTRY_TYPE'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
      'client_id' => '150819416358499',
      'client_secret' => '3491ca578a7c25198d72cd2c57bb9171',
      'redirect' => 'https://zaahee.shop/public/login/facebook/callback',
    ],


    'google' => [
      'client_id' => '241507832628-rs55u237ciras7qlcq8davu1p2g2tbrl.apps.googleusercontent.com',
      'client_secret' => 'GDS5KsgJLFJLTo3GtgUXcHxZ',
      'redirect' => 'https://zaahee.shop/public/login/google/callback',
    ],

];
