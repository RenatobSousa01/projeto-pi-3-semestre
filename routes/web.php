<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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
// O middleware 'auth' garante que apenas usuários logados podem acessar.
Route::middleware(['auth'])->group(function () {
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
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

// Rotas de Dashboard (Removida a view padrão, mas mantida a rota por segurança)
Route::get('/dashboard', function () {
    return redirect('/'); // Redireciona o dashboard para a home
})->middleware(['auth', 'verified'])->name('dashboard');

// Inclui o resto das rotas de Login/Registro/Recuperação de senha
require __DIR__.'/auth.php';