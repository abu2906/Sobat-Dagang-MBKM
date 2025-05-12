<?php

return [
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'user' => [
            'driver' => 'session',
            'provider' => 'users', // Menyesuaikan dengan provider yang sudah didefinisikan di bawah
        ],

        'disdag' => [
            'driver' => 'session',
            'provider' => 'disdags',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class, // Model untuk user
        ],

        'disdags' => [
            'driver' => 'eloquent',
            'model' => App\Models\Disdag::class, // Model untuk Disdag
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
];
