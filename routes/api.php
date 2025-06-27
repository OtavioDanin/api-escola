<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TurmaController;
use App\Http\Middleware\AlunoUpdateValidate;
use App\Http\Middleware\AlunoValidation;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

// Route::apiResource("aluno", AlunoController::class);
Route::post('/aluno', [AlunoController::class, 'store'])->name('store');//->middleware(AlunoValidation::class);
Route::put('/aluno/{idAluno}', [AlunoController::class, 'update'])->name('update');//->middleware(AlunoUpdateValidate::class)->middleware(JwtMiddleware::class);
Route::get('/aluno', [AlunoController::class, 'index'])->name('index');//->middleware(JwtMiddleware::class);
Route::get('/aluno/{idAluno}', [AlunoController::class, 'find'])->name('find');//->middleware(JwtMiddleware::class);

Route::put('/status/{idStatus}', [StatusController::class, 'update'])->name('update')->middleware(JwtMiddleware::class);
Route::get('/status', [StatusController::class, 'index'])->name('index');

Route::get('/turma', [TurmaController::class, 'index'])->name('index');

Route::get('/auth', [AuthorizationController::class, 'generate'])->name('generate');
