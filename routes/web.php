<?php

use App\Http\Controllers\MensagemController;
use App\Http\Controllers\PaginasController;
use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\PerfilController;
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

Route::get('/inicial', [PaginasController::class, 'inicialPagina'])->name('inicial')->middleware('auth');
Route::get('/buscaUsuario', [PaginasController::class, 'busca']);

#Rotas de Autenticação
Route::get('/registro', [PaginasController::class, 'registroPagina'])->name('registro');
Route::post('/registro', [AutenticacaoController::class, 'registroPost'])->name('registroPost');

Route::get('/', [PaginasController::class, 'loginPagina'])->name('login');
Route::post('/', [AutenticacaoController::class, 'loginPost'])->name('loginPost'); 

Route::get('/deslogar', [AutenticacaoController::class, 'desconectar'])->name('deslogar')->middleware('auth');

#Rotas do Perfil e Configurações
Route::get('/perfil/{usuario}', [PaginasController::class, 'perfilPagina'])->name('perfil')->middleware('auth');
Route::post('/perfil/{usuario}', [PerfilController::class, 'editarPerfil'])->name('editar')->middleware('auth');
Route::get('/perfil/{usuario}/fotoperfil', [PerfilController::class, 'getImagemPerfil'])->name('imagem')->middleware('auth');
Route::get('/perfil/{usuario}/capaperfil', [PerfilController::class, 'getCapaPerfil'])->name('capa')->middleware('auth');

#Rotas de Publicacões
Route::post('/inicial', [PublicacaoController::class, 'publiPost'])->name('pp')->middleware('auth');

#Rotas de Mensagens
Route::get('/mensagem/{usuario}', [PaginasController::class, 'msgPagina'])->name('msg')->middleware('auth');