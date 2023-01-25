<?php

namespace App\Providers;

use App\Interfaces\Services\AuthServiceInterface;
use App\Interfaces\Services\BaseServiceInterface;
use App\Interfaces\Services\MediaServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Services\AuthService;
use App\Services\EquipmentService;
use App\Services\MediaService;
use App\Services\OrganisationService;
use App\Services\UserService;
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
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(BaseServiceInterface::class, OrganisationService::class);
        $this->app->bind(BaseServiceInterface::class, EquipmentService::class);
        $this->app->bind(MediaServiceInterface::class, MediaService::class);
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
