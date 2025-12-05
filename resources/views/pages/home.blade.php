@extends('layouts.app')

@section('title', 'Bem-vindo à Loja de Hardware!')

@section('content')
    <div class="container" style="text-align: center;">
        <h2>Destaques da Semana</h2>
        <p>Confira nossos produtos mais recentes.</p>
        <hr>

        <div class="product-grid" style="text-align: center; margin-top: 30px;">
            @forelse ($products as $product)
                {{-- ✅ CHAMANDO A MOLÉCULA CARD PARA CADA PRODUTO --}}
                @include('molecules.product_card', ['product' => $product])
            @empty
                <p>Nenhum produto em destaque no momento.</p>
            @endforelse
        </div>
        
    </div>
@endsection