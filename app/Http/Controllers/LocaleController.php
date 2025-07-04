<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;

class LocaleController extends Controller
{
    /**
     * Switch the application locale.
     */
    public function switch(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'locale' => 'required|string|in:' . implode(',', array_keys(config('locale.supported', []))),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid locale provided.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $locale = $request->input('locale');
        $supportedLocales = config('locale.supported', []);

        if (!isset($supportedLocales[$locale])) {
            return response()->json([
                'success' => false,
                'message' => 'Unsupported locale.',
            ], 400);
        }

        // Store locale in session
        Session::put('locale', $locale);

        // Update user's locale preference if authenticated
        if (Auth::check()) {
            Auth::user()->update(['locale' => $locale]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Locale switched successfully.',
            'locale' => $locale,
            'direction' => $supportedLocales[$locale]['direction'],
        ]);
    }

    /**
     * Get current locale information.
     */
    public function current(Request $request): JsonResponse
    {
        $currentLocale = app()->getLocale();
        $supportedLocales = config('locale.supported', []);

        return response()->json([
            'current' => $currentLocale,
            'supported' => $supportedLocales,
            'direction' => $supportedLocales[$currentLocale]['direction'] ?? 'ltr',
        ]);
    }

    /**
     * Get all supported locales.
     */
    public function supported(): JsonResponse
    {
        return response()->json([
            'locales' => config('locale.supported', []),
            'default' => config('locale.default', 'en'),
        ]);
    }

    /**
     * Redirect to localized route.
     */
    public function redirect(Request $request): \Illuminate\Http\RedirectResponse
    {
        $locale = $request->input('locale', config('locale.default', 'en'));
        $path = $request->input('path', '/');

        // Remove leading slash if present
        $path = ltrim($path, '/');

        // Build the localized URL
        $localizedUrl = '/' . $locale . '/' . $path;

        return redirect($localizedUrl);
    }
}
