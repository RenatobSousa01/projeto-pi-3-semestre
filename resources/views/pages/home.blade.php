@extends('layouts.app')

@section('title', 'Página Inicial - E-commerce Hardware')

@section('content')
    <div class="container">
        <h1>Bem-vindo à Loja de Hardware!</h1>
        <p>Se o CSS estiver funcionando, os botões abaixo serão coloridos.</p>

        {{-- Passamos o texto do botão na chave 'text' --}}
@include('atoms.button', ['type' => 'primary', 'text' => 'Ver Produtos (Primário)'])
@include('atoms.button', ['type' => 'secondary', 'text' => 'Ver Carrinho (Secundário)'])
    </div>
@endsection