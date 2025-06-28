<?php

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class InertiaServiceProvider extends ServiceProvider {
    public function boot()
    {
        // مشاركة البيانات تتم الآن في HandleInertiaRequests
    }
}
