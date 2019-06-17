<?php

namespace App\Providers;

use App\Repositories\NoteRepository;
use App\Repositories\Interfaces\NoteInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->bind(
            NoteInterface::class,
            NoteRepository::class
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
