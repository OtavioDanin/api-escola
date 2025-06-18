<?php

namespace App\Providers;

use App\Models\Aluno;
use App\Repositories\AlunoRepository;
use App\Repositories\AlunoRepositoryInterface;
use App\Services\AlunoService;
use App\Services\AlunoServiceInterface;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
