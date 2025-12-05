<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    // Carrega a nossa view da página Home
    return view('pages.home');
});
//Rotas de Recurso para o CRUD de Produtos
Route::resource('products', ProductController::class);