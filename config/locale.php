<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for the application's locale
    | settings, including supported languages and their properties.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Default Locale
    |--------------------------------------------------------------------------
    |
    | This value determines the default locale that will be used by the
    | application when no locale is specified.
    |
    */
    'default' => env('APP_LOCALE', 'en'),

    /*
    |--------------------------------------------------------------------------
    | Supported Locales
    |--------------------------------------------------------------------------
    |
    | This array contains all the locales that your application supports.
    | Each locale should have a 'name', 'native_name', and 'direction' property.
    |
    */
    'supported' => [
        'en' => [
            'name' => 'English',
            'native_name' => 'English',
            'direction' => 'ltr',
            'flag' => '🇺🇸',
        ],
        'ar' => [
            'name' => 'Arabic',
            'native_name' => 'العربية',
            'direction' => 'rtl',
            'flag' => '🇸🇦',
        ],
        'fr' => [
            'name' => 'French',
            'native_name' => 'Français',
            'direction' => 'ltr',
            'flag' => '🇫🇷',
        ],
        'es' => [
            'name' => 'Spanish',
            'native_name' => 'Español',
            'direction' => 'ltr',
            'flag' => '🇪🇸',
        ],
        'de' => [
            'name' => 'German',
            'native_name' => 'Deutsch',
            'direction' => 'ltr',
            'flag' => '🇩🇪',
        ],
        'zh' => [
            'name' => 'Chinese',
            'native_name' => '中文',
            'direction' => 'ltr',
            'flag' => '🇨🇳',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Locale Detection Methods
    |--------------------------------------------------------------------------
    |
    | This array defines the order in which the application will attempt
    | to detect the user's preferred locale.
    |
    */
    'detection_methods' => [
        'url',      // From URL prefix (/en/, /ar/, etc.)
        'session',  // From session
        'user',     // From authenticated user's preference
        'browser',  // From browser's Accept-Language header
        'default',  // Fallback to default locale
    ],

    /*
    |--------------------------------------------------------------------------
    | URL Prefix
    |--------------------------------------------------------------------------
    |
    | Whether to prefix routes with locale codes (e.g., /en/about, /ar/about)
    | Set to false to use query parameters instead (e.g., ?locale=en)
    |
    */
    'url_prefix' => true,

    /*
    |--------------------------------------------------------------------------
    | Fallback Locale
    |--------------------------------------------------------------------------
    |
    | This value determines the fallback locale that will be used when
    | a translation is not found in the current locale.
    |
    */
    'fallback' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Cache Duration
    |--------------------------------------------------------------------------
    |
    | How long to cache locale-related data in minutes.
    |
    */
    'cache_duration' => 60,
];
