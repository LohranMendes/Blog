<?php

use App\Http\Controllers\PaginasController;
use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\PublicacaoController;
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

Route::get('/inicial', [PaginasController::class, 'inicialPagina'])->name('inicial');

#Rotas de Autenticação
Route::get('/registro', [PaginasController::class, 'registroPagina'])->name('registro');
Route::post('/registro', [AutenticacaoController::class, 'registroPost'])->name('registroPost');

Route::get('/', [PaginasController::class, 'loginPagina'])->name('login');
Route::post('/', [AutenticacaoController::class, 'loginPost'])->name('loginPost'); 

Route::get('/deslogar', [AutenticacaoController::class, 'desconectar'])->name('deslogar');

#Rotas do Perfil e Configurações
Route::get('/perfil/{usuario}', [PaginasController::class, 'perfilPagina'])->name('perfil');

#Rotas de Publicacões
Route::post('/inicial', [PublicacaoController::class, 'publiPost'])->name('pp');