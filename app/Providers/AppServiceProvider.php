<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
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

            if(auth()->check()){

                $notifications = Notification::where(
                    'user_id',
                    auth()->id()
                )
                ->latest()
                ->get();

                $view->with(
                    'notifications',
                    $notifications
                );
            }

        });
    }
}
