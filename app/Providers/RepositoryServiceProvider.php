<?php

namespace App\Providers;

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
        //tai khoan
        $this->app->singleton(
            'App\Repositories\AccountRepositoryInterface',
            'App\RepositoryEloquent\AccountRepository',
        );
        //the loai cau hoi
        $this->app->singleton(
            'App\Repositories\TypeQuestionRepositoryInterface',
            'App\RepositoryEloquent\TypeQuestionRepository',
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
