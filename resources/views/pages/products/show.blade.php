@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container" style="padding: 40px 0;">
        
        <div class="product-detail-layout" style="display: flex; gap: 30px; border: 1px solid #ddd; padding: 20px; border-radius: 8px;">
            
            {{-- Coluna da Imagem (50%) --}}
            <div class="image-section" style="flex: 1;">
                <img src="{{ asset($product->image_path ?: 'images/placeholder.jpg') }}" alt="{{ $product->name }}" style="width: 100%; max-height: 450px; object-fit: contain; border-radius: 4px;">
            </div>

            {{-- Coluna dos Detalhes (50%) --}}
            <div class="details-section" style="flex: 1;">
                <h1 style="border-bottom: 2px solid #007bff; padding-bottom: 10px;">{{ $product->name }}</h1>
                
                <p style="font-size: 1.8em; color: #dc3545; font-weight: bold; margin: 20px 0;">
                    R$ {{ number_format($product->price, 2, ',', '.') }}
                </p>
                
                <h3 style="margin-top: 30px;">Descrição Detalhada</h3>
                <p style="line-height: 1.6; color: #555;">
                    {{ $product->description }}
                </p>

                <div style="margin-top: 40px;">
                    @include('atoms.button', ['type' => 'success', 'text' => 'Adicionar ao Carrinho', 'html_type' => 'button'])
                </div>
            </div>

        </div>
        
        <div style="margin-top: 40px;">
    {{-- ✅ FORMULÁRIO QUE ENVIA O PRODUTO PARA O MÉTODO ADD NO CONTROLLER --}}
    <form action="{{ route('cart.add', $product) }}" method="POST">
        @csrf
        @include('atoms.button', ['type' => 'success', 'html_type' => 'submit', 'text' => 'Adicionar ao Carrinho'])
    </form>
</div>
@endsection