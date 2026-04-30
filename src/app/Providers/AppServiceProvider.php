<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Common\Interface\TransactionManagerInterface;
use App\Infrastructure\Postgres\Transaction\TransactionManager;

use App\Domain\User\Interface\UserQueryInterface;
use App\Infrastructure\Postgres\User\UserPostgresQuery;
use App\Domain\User\Interface\UserRepositoryInterface;
use App\Infrastructure\Postgres\User\UserPostgresRepository;

use App\Domain\Inquiry\Interface\InquiryQueryInterface;
use App\Infrastructure\Postgres\Inquiry\InquiryPostgresQuery;
use App\Domain\Inquiry\Interface\InquiryRepositoryInterface;
use App\Infrastructure\Postgres\Inquiry\InquiryPostgresRepository;

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

        //問い合わせ
        $this->app->bind(InquiryQueryInterface::class, InquiryPostgresQuery::class);
        $this->app->bind(InquiryRepositoryInterface::class, InquiryPostgresRepository::class);

        //トランザクション
        $this->app->bind(TransactionManagerInterface::class, TransactionManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
