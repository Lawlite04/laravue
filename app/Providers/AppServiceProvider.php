<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Siswa;
use App\Observers\SiswaObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Siswa::observe(SiswaObserver::class);
    }
}
