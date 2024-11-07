<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
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



    public function boot(): void
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
        \Illuminate\Pagination\Paginator::useTailwind();

        // Inject `dynamicColor` dans toutes les vues avec View::composer
        View::composer('*', function ($view) {
            $view->with('dynamicColor', function ($string) {
                $hash = crc32($string);
                $color = sprintf('#%06X', $hash & 0xFFFFFF);
                return $color;
            });
        });
    }

}
