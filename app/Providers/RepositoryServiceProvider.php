<?php

namespace App\Providers;

use App\Interfaces\Repositories\BaseRepositoryInterface;
use App\Interfaces\Repositories\EquipmentRepositoryInterface;
use App\Interfaces\Repositories\OrganisationRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Repositories\VideoRepositoryInterface;
use App\Interfaces\Repositories\WorkHourRepositoryInterface;
use App\Interfaces\Repositories\WorkoutRepositoryInterface;
use App\Repositories\EloquentEquipmentRepository;
use App\Repositories\EloquentOrganisationRepository;
use App\Repositories\EloquentUserRepository;
use App\Repositories\EloquentVideoRepository;
use App\Repositories\EloquentWorkHourRepository;
use App\Repositories\EloquentWorkoutRepository;
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
        $this->app->bind(EquipmentRepositoryInterface::class, EloquentEquipmentRepository::class);
        $this->app->bind(VideoRepositoryInterface::class, EloquentVideoRepository::class);
        $this->app->bind(WorkoutRepositoryInterface::class, EloquentWorkoutRepository::class);
        $this->app->bind(WorkHourRepositoryInterface::class, EloquentWorkHourRepository::class);
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
