@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Área Administrativa</h2>
        <nav>
            <a href="{{ url('/') }}">Home</a> |
            <a href="{{ route('products.index') }}">Gerenciar Produtos</a>
        </nav>
        <hr>
        
        {{-- O conteúdo específico do formulário ou listagem entra aqui --}}
        @yield('admin_content') 
    </div>
@endsection
