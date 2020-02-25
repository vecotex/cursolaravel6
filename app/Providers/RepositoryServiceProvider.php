<?php

namespace CodeProject\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\CodeProject\Repositories\ProjectNoteRepository::class,
        \CodeProject\Repositories\ProjectNoteRepositoryEloquent::class);
        //:end-bindings:
    }
}
