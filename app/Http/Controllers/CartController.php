<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Para garantir que o produto existe

class CartController extends Controller
{
    /**
     * Adiciona um produto ao carrinho.
     */
    public function addToCart(Product $product)
    {
        $cart = session()->get('cart', []);

        // Verifica se o produto já está no carrinho
        if (isset($cart[$product->id])) {
            // Se existir, apenas incrementa a quantidade
            $cart[$product->id]['quantity']++;
        } else {
            // Se não existir, adiciona o produto
            $cart[$product->id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                // Aqui você pode adicionar outros dados como a imagem, se necessário
                "image_path" => $product->image_path
            ];
        }

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
        
        return view('pages.cart.index', compact('cart'));
    }

    /**
     * Remove um produto do carrinho.
     * (Simplesmente remove o item, sem diminuir quantidade)
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
}