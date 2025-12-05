@extends('templates.admin_template')

@section('title', 'Criar Novo Produto')

@section('admin_content')
    <h3>Criar Novo Produto</h3>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf {{-- Token de segurança obrigatório do Laravel --}}

        {{-- 💡 Molécula para o Nome --}}
        @include('molecules.form_field', [
            'label' => 'Nome do Produto', 
            'name' => 'name', 
            'required' => true
        ])

        {{-- 💡 Molécula para o Preço --}}
        @include('molecules.form_field', [
            'label' => 'Preço', 
            'name' => 'price', 
            'type' => 'number',
            'required' => true
        ])

        {{-- 💡 Molécula para a Descrição (usando textarea, que é um átomo diferente, mas vamos usar o input por enquanto para simplificar) --}}
        @include('molecules.form_field', [
            'label' => 'Descrição', 
            'name' => 'description',
        ])
        
        {{-- 💡 Molécula para o Caminho da Imagem (simulando upload) --}}
        @include('molecules.form_field', [
            'label' => 'Caminho da Imagem (Ex: images/produto.jpg)', 
            'name' => 'image_path',
        ])

        <div class="mt-4">
            {{-- Botão de Submissão --}}
            @include('atoms.button', ['type' => 'primary', 'html_type' => 'submit', 'text' => 'Salvar Produto'])
        </div>
    </form>
@endsection