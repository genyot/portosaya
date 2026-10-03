<?php

namespace App\Providers;

use App\Models\Message;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Pakai tampilan pagination Bootstrap 5 (sesuai layout admin)
        Paginator::useBootstrapFive();

        // Bagikan data pesan ke layout admin (badge sidebar + notifikasi topbar)
        View::composer('layouts.app', function ($view) {
            $view->with('unreadMessages', Message::where('is_read', false)->count());

            $view->with(
                'recentMessages',
                Message::latest()->take(5)->get()
            );
        });
    }
}
