<?php

use App\Http\Controllers\AlunoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::resource("aluno", AlunoController::class);
Route::post('/aluno', [AlunoController::class, 'store'])->name('store');


