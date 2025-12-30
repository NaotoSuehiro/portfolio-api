<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\User\Interface\UserQueryInterface;
use App\Infrastructure\Postgres\User\UserPostgresQuery;
use App\Domain\User\Interface\UserRepositoryInterface;
use App\Infrastructure\Postgres\User\UserPostgresRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //ユーザー
        $this->app->bind(UserQueryInterface::class, UserPostgresQuery::class);
        $this->app->bind(UserRepositoryInterface::class, UserPostgresRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
