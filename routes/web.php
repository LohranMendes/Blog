<?php

use App\Http\Controllers\PaginasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PaginasController::class, 'inicialPagina'])->name('inicial');

#Rotas de Autenticação
Route::get('/registro', [PaginasController::class, 'registroPagina'])->name('registro');

Route::get('/login', [PaginasController::class, 'loginpagina'])->name('login'); 
