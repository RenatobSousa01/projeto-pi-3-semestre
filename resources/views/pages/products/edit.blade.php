@extends('templates.admin_template')

@section('title', 'Editar Produto: ' . $product->name)

@section('admin_content')
    <h3>Editar Produto: {{ $product->name }}</h3>

    {{-- ✅ ADICIONE ESTE BLOCO PARA VISUALIZAR ERROS GERAIS --}}
    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- FIM DO BLOCO DE ERROS --}}

    <form action="{{ route('products.update', $product) }}" method="POST">
    {{-- ... restante do formulário ... --}}

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT') {{-- 💡 ESSENCIAL: Usar o método PUT para Update --}}

        {{-- 💡 Molécula para o Nome (Passando o valor atual para preenchimento) --}}
        @include('molecules.form_field', [
            'label' => 'Nome do Produto', 
            'name' => 'name', 
            'required' => true,
            'value' => $product->name // Preenche o campo
        ])

        {{-- 💡 Molécula para o Preço --}}
        @include('molecules.form_field', [
            'label' => 'Preço', 
            'name' => 'price', 
            'type' => 'number',
            'required' => true,
            'value' => $product->price,
            'step' => '0.01'
        ])

        {{-- 💡 Molécula para a Descrição --}}
        @include('molecules.form_field', [
            'label' => 'Descrição', 
            'name' => 'description',
            'value' => $product->description // Preenche o campo
        ])
        
        {{-- 💡 Molécula para o Caminho da Imagem --}}
        @include('molecules.form_field', [
            'label' => 'Caminho da Imagem', 
            'name' => 'image_path',
            'value' => $product->image_path // Preenche o campo
        ])

        <div class="mt-4">
            @include('atoms.button', ['type' => 'secondary', 'html_type' => 'submit', 'text' => 'Atualizar Produto'])
        </div>
    </form>
@endsection