<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Para garantir que o produto existe
use Illuminate\Support\Facades\Log; // Boa prática para simulação de ordem

class CartController extends Controller
{
    /**
     * Adiciona um produto ao carrinho.
     */
    public function addToCart(Product $product)
    {
        $cart = session()->get('cart', []);

        // Define o preço e o subtotal inicial
        $price = $product->price;
        $quantity = 1;

        if (isset($cart[$product->id])) {
            // Se existir, apenas incrementa a quantidade
            $quantity = $cart[$product->id]['quantity'] + 1;
        }

        // Adiciona/Atualiza o produto no carrinho
        $cart[$product->id] = [
            "id" => $product->id,
            "name" => $product->name,
            "quantity" => $quantity,
            "price" => $price,
            "image_path" => $product->image_path,
            "subtotal" => $price * $quantity, // ✅ Subtotal calculado
        ];

        // Salva o carrinho na sessão
        session()->put('cart', $cart);

        // Retorna com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Produto adicionado ao carrinho!');
    }

    /**
     * Exibe o conteúdo do carrinho.
     */
    public function showCart()
    {
        $cart = session()->get('cart', []);
        
        // Passa o carrinho para a view
        return view('pages.cart.index', compact('cart'));
    }

    /**
     * Remove um produto do carrinho.
     */
    public function removeFromCart(Product $product)
    {
        $cart = session()->get('cart');

        if(isset($cart[$product->id])) {
            unset($cart[$product->id]); // Remove o item
            session()->put('cart', $cart); // Salva o carrinho atualizado
        }

        return redirect()->back()->with('success', 'Produto removido do carrinho!');
    }

    /**
     * Exibe o formulário de Checkout.
     */
    public function checkout(Request $request)
    {
        // Garante que o usuário esteja logado (apesar de estar na rota middleware)
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        // Opcional: Garante que o carrinho não esteja vazio
        if (session()->get('cart', []) === []) {
            return redirect()->route('cart.index')->with('error', 'Seu carrinho está vazio.');
        }

        // Passa o carrinho para a view
        $cart = session()->get('cart', []);
        return view('pages.cart.checkout', compact('cart'));
    }

    /**
     * Processa a finalização da compra (simulação).
     */
    public function placeOrder(Request $request)
    {
        // 1. Validação dos dados de pagamento/entrega
        $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);

        $user = $request->user();
        $cart = session()->get('cart', []);
        
        // Garante que o carrinho não esteja vazio antes de calcular
        if (empty($cart)) {
             return redirect()->route('cart.index')->with('error', 'O carrinho está vazio.');
        }
        
        // Cálculo total
        $total = array_sum(array_column($cart, 'subtotal'));
        
        // 2. Simulação do Registro da Ordem/Transação
        // Log::info("Pedido Finalizado", [
        //     'user_id' => $user->id,
        //     'total' => $total,
        //     'address' => $request->input('address'),
        //     'payment_method' => $request->input('payment_method'),
        // ]);

        // 3. Limpeza do Carrinho (Crucial para finalizar a compra)
        session()->forget('cart');

        // 4. Feedback de Sucesso
        return redirect()->route('home')->with('success', '✅ Compra finalizada com sucesso! Total: R$ ' . number_format($total, 2, ',', '.'));
    }
}