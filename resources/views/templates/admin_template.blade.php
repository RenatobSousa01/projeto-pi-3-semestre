@extends('layouts.app')

{{-- Define a seção de cabeçalho (Header) que já é formatada pelo layout principal --}}
@section('header')
    <div class="flex justify-between items-center">
        {{-- Título Principal --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Área Administrativa
        </h2>
        
        {{-- Navegação da Sub-Área (Admin) --}}
        <nav class="text-sm text-gray-500 flex space-x-4">
            <a href="{{ url('/') }}" class="hover:text-gray-700 transition duration-150">Home</a>
            <span>|</span>
            <a href="{{ route('products.index') }}" class="text-gray-800 font-medium hover:text-gray-900 transition duration-150">Gerenciar Produtos</a>
        </nav>
    </div>
@endsection


{{-- Define a seção de conteúdo (Content) --}}
@section('content')
    {{-- Injeta o conteúdo da view filha (CRUD de Produtos) aqui --}}
    
    @yield('admin_content') 
    
    {{-- Nota: O container principal e as margens são definidos pelo layouts.app --}}
@endsection