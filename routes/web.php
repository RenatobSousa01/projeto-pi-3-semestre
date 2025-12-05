<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    // 1. Buscar todos os produtos (ou os 8 mais recentes, por exemplo)
    $products = Product::orderBy('created_at', 'desc')->take(8)->get();

    // 2. Retornar a view da Home, passando os produtos
    return view('pages.home', compact('products'));
});
//Rotas de Recurso para o CRUD de Produtos
Route::resource('products', ProductController::class);