<?php

use App\Http\Controllers\AlunosController;
use App\Http\Controllers\NotasController;
use Illuminate\Support\Facades\Route;

Route::get('/alunos',[AlunosController::class, 'index'])->name('alunos');
Route::get('/',[AlunosController::class, 'index']);

Route::get('/alunos/criar',[AlunosController::class, 'create']);
Route::post('/alunos/criar', [AlunosController::class, 'store']);
Route::post('/alunos/{id}/editaNome', [AlunosController::class, 'editaNome']);

Route::get('/alunos/{id}/adicionar-notas', [NotasController::class, 'create']);
Route::post('/alunos/{id}/adicionar-notas', [NotasController::class, 'store']);

Route::get('/alunos/{id}/notas/', [NotasController::class, 'index'])->name('notas');
Route::delete('/alunos/{id}/notas/{notaId}/excluir', [NotasController::class, 'destroy']);

Route::delete('/alunos/{id}', [AlunosController::class, 'destroy']);