<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

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
            if (Auth::check()) {
                $latestOrder = Order::with(['orderProduct.product'])
                    ->where('user_id', Auth::id())
                    ->where('status', 'pending')
                    ->latest()
                    ->first();

                $view->with('latestOrder', $latestOrder);
            }
        });
    }
}
