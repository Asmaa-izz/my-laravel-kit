<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class LocalizedRouteServiceProvider extends ServiceProvider
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
        if (!config('locale.url_prefix', true)) {
            return;
        }

        $supportedLocales = array_keys(config('locale.supported', []));
        $defaultLocale = config('locale.default', 'en');

        // Register localized routes for each supported locale
        foreach ($supportedLocales as $locale) {
            Route::prefix($locale)
                ->middleware(['web'])
                ->group(function () use ($locale) {
                    $this->registerLocalizedRoutes($locale);
                });
        }

        // Redirect root to default locale
        Route::get('/', function () use ($defaultLocale) {
            return redirect('/' . $defaultLocale);
        })->middleware('web');

        // Handle locale switching
        Route::post('/locale/switch', [\App\Http\Controllers\LocaleController::class, 'switch'])
            ->name('locale.switch')
            ->middleware('web');

        Route::get('/locale/current', [\App\Http\Controllers\LocaleController::class, 'current'])
            ->name('locale.current')
            ->middleware('web');

        Route::get('/locale/supported', [\App\Http\Controllers\LocaleController::class, 'supported'])
            ->name('locale.supported')
            ->middleware('web');

        Route::get('/locale/redirect', [\App\Http\Controllers\LocaleController::class, 'redirect'])
            ->name('locale.redirect')
            ->middleware('web');
    }

    /**
     * Register routes for a specific locale.
     */
    private function registerLocalizedRoutes(string $locale): void
    {
        // Welcome page
        Route::get('/', function () {
            return \Inertia\Inertia::render('Welcome');
        })->name('welcome.' . $locale);

        // Dashboard (requires authentication)
        Route::middleware([
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified',
        ])->group(function () use ($locale) {
            Route::get('/dashboard', function () {
                return \Inertia\Inertia::render('Dashboard');
            })->name('dashboard.' . $locale);
        });

        // Profile routes
        Route::middleware([
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified',
        ])->group(function () use ($locale) {
            Route::get('/profile', function () {
                return \Inertia\Inertia::render('Profile/Show');
            })->name('profile.show.' . $locale);
        });

        // API routes
        Route::prefix('api')->group(function () use ($locale) {
            Route::get('/tokens', function () {
                return \Inertia\Inertia::render('API/Index');
            })->name('api.tokens.' . $locale);
        });

        // Auth routes
        Route::middleware('guest')->group(function () use ($locale) {
            Route::get('/login', function () {
                return \Inertia\Inertia::render('Auth/Login');
            })->name('login.' . $locale);

            Route::get('/register', function () {
                return \Inertia\Inertia::render('Auth/Register');
            })->name('register.' . $locale);

            Route::get('/forgot-password', function () {
                return \Inertia\Inertia::render('Auth/ForgotPassword');
            })->name('password.request.' . $locale);

            Route::get('/reset-password/{token}', function () {
                return \Inertia\Inertia::render('Auth/ResetPassword');
            })->name('password.reset.' . $locale);
        });

        // Terms and Privacy
        Route::get('/terms', function () {
            return \Inertia\Inertia::render('TermsOfService');
        })->name('terms.' . $locale);

        Route::get('/privacy', function () {
            return \Inertia\Inertia::render('PrivacyPolicy');
        })->name('privacy.' . $locale);
    }
}
