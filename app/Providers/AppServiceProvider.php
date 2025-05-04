<?php

namespace App\Providers;

use App\Models\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // You can change this logic to get the "current" or "latest" event, or based on session, etc.
            $event = Event::latest()->first(); // or session('current_event'), etc.
            $view->with('event', $event);
        });
    }
}
