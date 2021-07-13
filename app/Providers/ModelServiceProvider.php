<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Models\Interfaces\IUser::class,
            \App\Models\User::class
        );

        $this->app->bind(
            \App\Models\Interfaces\IRoom::class,
            \App\Models\Room::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
