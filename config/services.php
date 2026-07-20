<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'bank_alfalah' => [
        'handshake_url' => env(
            'BANK_ALFALAH_HANDSHAKE_URL',
            'https://sandbox.bankalfalah.com/HS/HS/HS'
        ),
        'sso_url' => env(
            'BANK_ALFALAH_SSO_URL',
            'https://sandbox.bankalfalah.com/SSO/SSO/SSO'
        ),
        'order_status_url' => env(
            'BANK_ALFALAH_ORDER_STATUS_URL',
            'https://sandbox.bankalfalah.com/HS/api/IPN/OrderStatus'
        ),
        'channel_id' => env('BANK_ALFALAH_CHANNEL_ID', '1001'),
        'is_redirection_request' => env(
            'BANK_ALFALAH_IS_REDIRECTION_REQUEST',
            '0'
        ),
        'return_url' => env('BANK_ALFALAH_RETURN_URL'),
        'merchant_id' => env('BANK_ALFALAH_MERCHANT_ID'),
        'store_id' => env('BANK_ALFALAH_STORE_ID'),
        'merchant_hash' => env('BANK_ALFALAH_MERCHANT_HASH'),
        'merchant_username' => env(
            'BANK_ALFALAH_MERCHANT_USERNAME'
        ),
        'merchant_password' => env(
            'BANK_ALFALAH_MERCHANT_PASSWORD'
        ),
        'key_1' => env('BANK_ALFALAH_KEY_1'),
        'key_2' => env('BANK_ALFALAH_KEY_2'),
    ],

];
