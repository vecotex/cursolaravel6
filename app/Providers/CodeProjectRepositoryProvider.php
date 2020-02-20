<?php

namespace CodeProject\Providers;

use Illuminate\Support\ServiceProvider;
use \CodeProject\Repositories\ClientRepository;
use \CodeProject\Repositories\ClientRepositoryEloquent;
use \CodeProject\Repositories\ProjectRepository;
use \CodeProject\Repositories\ProjectRepositoryEloquent;

class CodeProjectRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ClientRepository::class,
            ClientRepositoryEloquent::class
        );

        $this->app->bind(
            ProjectRepository::class,
            ProjectRepositoryEloquent::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}