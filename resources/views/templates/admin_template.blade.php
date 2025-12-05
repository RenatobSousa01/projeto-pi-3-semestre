@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- ✅ ESTA DEVE SER A PRIMEIRA COISA DENTRO DO CONTAINER --}}
        <h2>Área Administrativa</h2>
        <nav>
            <a href="{{ url('/') }}">Home</a> |
            <a href="{{ route('products.index') }}">Gerenciar Produtos</a>
        </nav>
        <hr>
        
        {{-- ✅ ESTE É O CONTEÚDO DA PÁGINA (A TABELA) --}}
        @yield('admin_content') 
    </div>
@endsection