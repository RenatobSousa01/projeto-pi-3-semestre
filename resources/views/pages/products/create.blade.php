@extends('templates.admin_template')

@section('title', 'Criar Novo Produto')

@section('admin_content')
    <h3>Criar Novo Produto</h3>

    {{-- ✅ ADICIONE O enctype para permitir o upload de arquivos --}}
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nome --}}
        @include('molecules.form_field', [
            'label' => 'Nome do Produto', 
            'name' => 'name', 
            'required' => true
        ])

        {{-- Preço --}}
        @include('molecules.form_field', [
            'label' => 'Preço', 
            'name' => 'price', 
            'type' => 'number',
            'required' => true,
            'step' => '0.01' // Para centavos
        ])

        {{-- Descrição --}}
        @include('molecules.form_field', [
            'label' => 'Descrição', 
            'name' => 'description', 
            'type' => 'textarea',
        ])
        
        {{-- ✅ IMAGEM (COM SINTAXE CORRETA) --}}
        @include('molecules.form_field', [
            'label' => 'Imagem do Produto', // ✅ CORRIGIDO: Aspa simples de fechamento
            'name' => 'image',
            'type' => 'file',
        ])

        {{-- Botão de Submissão --}}
        <div class="mt-4">
            @include('atoms.button', ['type' => 'primary', 'html_type' => 'submit', 'text' => 'Salvar Produto'])
        </div>

    </form>
@endsection