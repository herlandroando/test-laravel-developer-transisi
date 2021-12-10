<?php

namespace App\Providers;

use App\Repository\Eloquent\CompanyRepository;
use App\Repository\Eloquent\EloquentRepository;
use App\Repository\Eloquent\EmployeeRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\CompanyRepositoryInterface;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\EmployeeRepositoryInterface;
use App\Repository\UserRepositoryInterface;
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
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(EloquentRepositoryInterface::class, EloquentRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
