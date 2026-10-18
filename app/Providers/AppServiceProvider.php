<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\Blade; 
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;

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
    public function boot(Request $request): void
    {
        //
        // if (class_exists(\TallStackUi\View\Components\Table::class)) {
        //     Blade::component('ts-table', \TallStackUi\View\Components\Table::class);
        // }
        // if (request()->header('x-forwarded-proto') === 'https') {
        //     URL::forceScheme('https');
        // }
        // if ($request->hasHeader('x-forwarded-host')) {
        //     // Ambil host pinggy (contoh: xyz.pinggy.link)
        //     $host = $request->header('x-forwarded-host');
        //     $protocol = $request->header('x-forwarded-proto', 'https');
            
        //     $dynamicUrl = $protocol . '://' . $host;

        //     // 1. Paksa skema menjadi HTTPS
        //     URL::forceScheme($protocol);
            
        //     // 2. Paksa Root URL
        //     URL::forceRootUrl($dynamicUrl);
            
        //     // 3. Timpa config APP_URL secara dinamis agar Livewire bisa mencocokkan Route
        //     Config::set('app.url', $dynamicUrl);
        // }
        if ($request->hasHeader('x-forwarded-host')) {
            $host = $request->header('x-forwarded-host');
            $protocol = $request->header('x-forwarded-proto', 'https');
            
            $dynamicUrl = $protocol . '://' . $host;

            URL::forceScheme($protocol);
            URL::forceRootUrl($dynamicUrl);
            Config::set('app.url', $dynamicUrl);
        }

        // 2. Setup Update Route Khusus Livewire 4
        Livewire::setUpdateRoute(function ($handle, $path) {
            // Jangan hapus $path, karena $path berisi "/livewire-xxxxxx/update"
            return Route::post($path, $handle);
        });
    }
}
