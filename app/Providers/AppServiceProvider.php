<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use App\Models\ForumDiskusi;
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
    public function boot()
    {
    App::setLocale('id');
    Carbon::setLocale('id');
    View::composer('*', function ($view) {
        $view->with('chats', ForumDiskusi::with('user')->orderBy('created_at')->get());
    });
    }

}
