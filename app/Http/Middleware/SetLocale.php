<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->detectLocale($request);

        // Set the application locale
        App::setLocale($locale);

        // Store the current locale in the request for later use
        $request->attributes->set('current_locale', $locale);

        return $next($request);
    }

    /**
     * Detect the appropriate locale for the current request.
     */
    private function detectLocale(Request $request): string
    {
        $supportedLocales = array_keys(config('locale.supported', []));
        $defaultLocale = config('locale.default', 'en');
        $detectionMethods = config('locale.detection_methods', []);

        foreach ($detectionMethods as $method) {
            $locale = match ($method) {
                'url' => $this->detectFromUrl($request, $supportedLocales),
                'session' => $this->detectFromSession($supportedLocales),
                'user' => $this->detectFromUser($supportedLocales),
                'browser' => $this->detectFromBrowser($request, $supportedLocales),
                'default' => $defaultLocale,
                default => null,
            };

            if ($locale && in_array($locale, $supportedLocales)) {
                return $locale;
            }
        }

        return $defaultLocale;
    }

    /**
     * Detect locale from URL prefix.
     */
    private function detectFromUrl(Request $request, array $supportedLocales): ?string
    {
        if (!config('locale.url_prefix', true)) {
            return null;
        }

        $path = $request->path();
        $segments = explode('/', $path);

        if (!empty($segments[0]) && in_array($segments[0], $supportedLocales)) {
            return $segments[0];
        }

        return null;
    }

    /**
     * Detect locale from session.
     */
    private function detectFromSession(array $supportedLocales): ?string
    {
        $locale = Session::get('locale');

        return $locale && in_array($locale, $supportedLocales) ? $locale : null;
    }

    /**
     * Detect locale from authenticated user.
     */
    private function detectFromUser(array $supportedLocales): ?string
    {
        if (!Auth::check()) {
            return null;
        }

        $locale = Auth::user()->locale;

        return $locale && in_array($locale, $supportedLocales) ? $locale : null;
    }

    /**
     * Detect locale from browser's Accept-Language header.
     */
    private function detectFromBrowser(Request $request, array $supportedLocales): ?string
    {
        $acceptLanguage = $request->header('Accept-Language');

        if (!$acceptLanguage) {
            return null;
        }

        // Parse Accept-Language header
        $languages = [];
        foreach (explode(',', $acceptLanguage) as $lang) {
            $parts = explode(';', trim($lang));
            $locale = trim($parts[0]);
            $quality = isset($parts[1]) ? (float) str_replace('q=', '', $parts[1]) : 1.0;
            $languages[$locale] = $quality;
        }

        // Sort by quality (highest first)
        arsort($languages);

        // Try to match with supported locales
        foreach ($languages as $locale => $quality) {
            // Try exact match first
            if (in_array($locale, $supportedLocales)) {
                return $locale;
            }

            // Try language code match (e.g., 'en' from 'en-US')
            $languageCode = substr($locale, 0, 2);
            if (in_array($languageCode, $supportedLocales)) {
                return $languageCode;
            }
        }

        return null;
    }
}
