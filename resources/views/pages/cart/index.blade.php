@extends('layouts.app')

@section('title', 'Seu Carrinho de Compras')

@section('content')
    <div class="container" style="padding: 40px 0;">
        <h1 style="border-bottom: 2px solid #007bff; padding-bottom: 10px;">Seu Carrinho</h1>

        {{-- Mensagens de Sucesso --}}
        @if (session('success'))
            <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                {{ session('success') }}
            </div>
        @endif

        @php $total = 0; @endphp

        @if (count($cart) > 0)
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr style="background-color: #f8f9fa;">
                        <th style="border: 1px solid #ccc; padding: 10px; text-align: left; width: 10%;"></th>
                        <th style="border: 1px solid #ccc; padding: 10px; text-align: left; width: 40%;">Produto</th>
                        <th style="border: 1px solid #ccc; padding: 10px; text-align: center; width: 15%;">Preço</th>
                        <th style="border: 1px solid #ccc; padding: 10px; text-align: center; width: 15%;">Quantidade</th>
                        <th style="border: 1px solid #ccc; padding: 10px; text-align: right; width: 15%;">Subtotal</th>
                        <th style="border: 1px solid #ccc; padding: 10px; text-align: center; width: 5%;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $id => $details)
                        @php $subtotal = $details['price'] * $details['quantity']; @endphp
                        @php $total += $subtotal; @endphp
                        
                        <tr>
                            {{-- Imagem --}}
                            <td style="border: 1px solid #ccc; padding: 10px; text-align: center;">
                                <img src="{{ asset($details['image_path'] ?: 'images/placeholder.jpg') }}" alt="{{ $details['name'] }}" style="width: 70px; height: 70px; object-fit: cover; border-radius: 4px;">
                            </td>
                            
                            {{-- Nome --}}
                            <td style="border: 1px solid #ccc; padding: 10px;">
                                <a href="{{ route('products.show', $details['id']) }}" style="color: #007bff; text-decoration: none;">
                                    {{ $details['name'] }}
                                </a>
                            </td>
                            
                            {{-- Preço Unitário --}}
                            <td style="border: 1px solid #ccc; padding: 10px; text-align: center;">R$ {{ number_format($details['price'], 2, ',', '.') }}</td>
                            
                            {{-- Quantidade --}}
                            <td style="border: 1px solid #ccc; padding: 10px; text-align: center;">
                                {{ $details['quantity'] }}
                                {{-- (Aqui seria o formulário para ajustar a quantidade) --}}
                            </td>
                            
                            {{-- Subtotal --}}
                            <td style="border: 1px solid #ccc; padding: 10px; text-align: right; font-weight: bold;">R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                            
                            {{-- Remover --}}
                            <td style="border: 1px solid #ccc; padding: 10px; text-align: center;">
                                <form action="{{ route('cart.remove', $details['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer; font-size: 1.2em;">&times;</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Resumo e Total --}}
            <div style="text-align: right; margin-top: 30px;">
                <h3 style="margin: 0 0 10px 0;">Total do Pedido: <span style="color: #dc3545;">R$ {{ number_format($total, 2, ',', '.') }}</span></h3>
                <a href="{{ url('/') }}" style="margin-right: 15px; color: #007bff; text-decoration: none;">&larr; Continuar Comprando</a>
                
                {{-- Botão de Checkout --}}
                @include('atoms.button', ['type' => 'success', 'text' => 'Finalizar Compra'])
            </div>
        @else
            <p>Seu carrinho está vazio. Adicione alguns produtos!</p>
            <a href="{{ url('/') }}" style="color: #007bff; text-decoration: none;">&larr; Voltar para a Loja</a>
        @endif
    </div>
@endsection