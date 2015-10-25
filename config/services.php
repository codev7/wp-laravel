<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'pipeline_deals' => [

        'key' => env('PIPELINE_DEALS_API_KEY')

    ],

    'stripe' => [
        'model'  => CMV\User::class,
        'key'    => env('STRIPE_KEY','pk_test_H4Yz9y4R0Ij6HvDdpe7cs79e'),
        'secret' => env('STRIPE_SECRET','sk_test_hx5fBx0gDeRnu4JcVvh3j6df'),
    ],

];
