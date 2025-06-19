<?php

namespace App\Providers;

use App\Helpers\UniqueIdentifierInterface;
use App\Helpers\UniqueIdentifierRamsey;
use App\Repositories\AlunoRepository;
use App\Repositories\AlunoRepositoryInterface;
use App\Repositories\StatusRepository;
use App\Repositories\StatusRepositoryInterface;
use App\Repositories\TurmaRepository;
use App\Repositories\TurmaRepositoryInterface;
use App\Services\AlunoService;
use App\Services\AlunoServiceInterface;
use App\Services\StatusService;
use App\Services\StatusServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AlunoRepositoryInterface::class, AlunoRepository::class);
        $this->app->bind(AlunoServiceInterface::class, AlunoService::class);
        $this->app->bind(UniqueIdentifierInterface::class, UniqueIdentifierRamsey::class);

        $this->app->bind(TurmaRepositoryInterface::class, TurmaRepository::class);

        $this->app->bind(StatusServiceInterface::class, StatusService::class);
        $this->app->bind(StatusRepositoryInterface::class, StatusRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
