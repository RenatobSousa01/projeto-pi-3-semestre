<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
// Removido: use App\Http\Controllers\CheckoutController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// ------------------------------------------------------------------
// A. ROTAS DE E-COMMERCE (HOME, PRODUTOS, CARRINHO, CHECKOUT)
// ------------------------------------------------------------------

// 1. ROTA PRINCIPAL (HOME)
Route::get('/', function () {
    // Buscar os produtos mais recentes
    $products = Product::orderBy('created_at', 'desc')->take(8)->get();
    return view('pages.home', compact('products'));
})->name('home');


// 2. ROTAS DO CRUD DE PRODUTOS (ADMIN)
Route::resource('products', ProductController::class);


// 3. ROTAS DO CARRINHO (ACESSÍVEIS SEM LOGIN)
Route::get('cart', [CartController::class, 'showCart'])->name('cart.index');
Route::post('cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('cart/remove/{product}', [CartController::class, 'removeFromCart'])->name('cart.remove');


// 4. ROTAS DE CHECKOUT (Protegidas por Login)
// ✅ Usando o CartController, onde implementamos a lógica.
Route::middleware(['auth'])->group(function () {
    // 4.1 Mostrar o formulário de Checkout
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    
    // 4.2 Processar a finalização da compra
    Route::post('/order/place', [CartController::class, 'placeOrder'])->name('order.place');
});


// ------------------------------------------------------------------
// B. ROTAS DE AUTENTICAÇÃO (PADRÃO BREEZE)
// ------------------------------------------------------------------

// Rotas de Perfil (ProfileController)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas de Dashboard (Redireciona para a Home)
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

// Inclui o resto das rotas de Login/Registro/Recuperação de senha
require __DIR__.'/auth.php';