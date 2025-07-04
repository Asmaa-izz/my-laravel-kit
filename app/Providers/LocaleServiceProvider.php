<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class LocaleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share locale data with Inertia
        Inertia::share([
            'locale' => function () {
                $currentLocale = App::getLocale();
                $supportedLocales = config('locale.supported', []);

                return [
                    'current' => $currentLocale,
                    'supported' => $supportedLocales,
                    'direction' => $supportedLocales[$currentLocale]['direction'] ?? 'ltr',
                    'default' => config('locale.default', 'en'),
                    'url_prefix' => config('locale.url_prefix', true),
                ];
            },
            'user_locale' => function () {
                if (Auth::check()) {
                    return Auth::user()->locale;
                }

                return Session::get('locale', config('locale.default', 'en'));
            },
        ]);
    }
}
