<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // O CONSTRUTOR COM O MIDDLEWARE FOI REMOVIDO DAQUI

    /**
     * Exibe o formulário de checkout.
     */
    public function index()
    {
        return redirect()->route('cart.index');
    }

    /**
     * Processa a compra (Simulação de Pagamento).
     */
    public function process(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Seu carrinho está vazio.');
        }

        $request->validate([
            'card_number' => 'required|numeric',
            'expiry_date' => 'required|date_format:m/y',
            'cvv' => 'required|numeric|digits:3',
        ]);
        
        $paymentSuccess = true; 

        if ($paymentSuccess) {
            session()->forget('cart');
            return redirect()->route('checkout.success')->with('success', 'Sua compra foi finalizada com sucesso!');
        } else {
            return redirect()->back()->with('error', 'O pagamento falhou. Tente novamente.');
        }
    }

    /**
     * Exibe a página de sucesso após a compra.
     */
    public function success()
    {
        return view('pages.checkout.success');
    }
}