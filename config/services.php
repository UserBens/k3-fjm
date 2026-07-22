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
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'pegawai' => [
        'url' => env('PEGAWAI_API_URL'),
        'key' => env('PEGAWAI_API_KEY'),
    ],

    'unit_kerja' => [
        'url' => env('UNIT_KERJA_API_URL', 'https://mobile.fokusjasamitra.com/api/erp/api/unit-kerja'),
        'key' => env('PEGAWAI_API_KEY'), // reuse key yang sama kalau memang satu API key untuk semua endpoint ERP
    ],

    'pengawas' => [
        'url' => env('PENGAWAS_API_URL', 'https://mobile.fokusjasamitra.com/api/erp/api/pengawas'),
        'key' => env('PEGAWAI_API_KEY'),
    ],

    'pengawas_pekerjaan' => [
        'url' => env('PENGAWAS_PEKERJAAN_API_URL', 'https://mobile.fokusjasamitra.com/api/erp/api/pengawas-pekerjaan'),
        'key' => env('PEGAWAI_API_KEY'),
    ],

    'user_login' => [
        'url' => env('USER_LOGIN_API_URL', 'https://mobile.fokusjasamitra.com/api/erp/api/user'),
        'key' => env('PEGAWAI_API_KEY'), // reuse key yang sama
    ],

    'kualifikasi' => [
        'url' => env('KUALIFIKASI_API_URL', 'https://mobile.fokusjasamitra.com/api/erp/api/kualifikasi'),
        'key' => env('KUALIFIKASI_API_KEY', env('PEGAWAI_API_KEY')),
    ],

    'kode_ok' => [
        'url' => env('KODE_OK_API_URL', 'https://mobile.fokusjasamitra.com/api/erp/api/kode-ok'),
        'key' => env('KODE_OK_API_KEY', env('PEGAWAI_API_KEY')),
    ],
];
