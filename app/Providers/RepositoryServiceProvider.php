<?php

namespace App\Providers;

use App\Interfaces\Repositories\OrganisationRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Repositories\EloquentOrganisationRepository;
use App\Repositories\EloquentUserRepository;
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
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(OrganisationRepositoryInterface::class, EloquentOrganisationRepository::class);
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
