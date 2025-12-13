@extends('templates.admin_template')

@section('title', 'Editar Produto: ' . $product->name)

@section('admin_content')
    <h3 class="text-2xl font-bold mb-6">Editar Produto: {{ $product->name }}</h3>

    {{-- BLOCO MELHORADO PARA ERROS DE VALIDAÇÃO --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <strong class="font-bold">Ops! Há problemas com os dados:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- FIM DO BLOCO DE ERROS --}}

    {{-- ✅ CRUCIAL: Adicionar enctype="multipart/form-data" para upload de arquivos --}}
    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- ESSENCIAL: Usar o método PUT para Update --}}

        {{-- 1. Nome --}}
        @include('molecules.form_field', [
            'label' => 'Nome do Produto', 
            'name' => 'name', 
            'required' => true,
            'value' => $product->name // Preenche o campo
        ])

        {{-- 2. Preço --}}
        @include('molecules.form_field', [
            'label' => 'Preço', 
            'name' => 'price', 
            'type' => 'number',
            'required' => true,
            'value' => $product->price,
            'step' => '0.01'
        ])

        {{-- 3. Descrição --}}
        @include('molecules.form_field', [
            'label' => 'Descrição', 
            'name' => 'description',
            'type' => 'textarea', // Usar o type textarea
            'value' => $product->description // Preenche o campo
        ])
        
        <hr class="my-6">
        
        {{-- ✅ 4. Imagem Atual (Visualização) --}}
        <h4 class="text-lg font-semibold mb-2">Imagem Atual</h4>
        @if ($product->image_path)
            <div class="mb-4">
                <img src="{{ asset($product->image_path) }}" alt="Imagem atual de {{ $product->name }}" class="w-32 h-32 object-cover rounded-md border p-1 shadow-sm">
                <p class="text-sm text-gray-500 mt-1">Selecione uma nova imagem abaixo para substituí-la.</p>
            </div>
        @else
            <p class="mb-4 text-sm text-gray-500">Nenhuma imagem cadastrada atualmente.</p>
        @endif

        {{-- ✅ 5. Campo para NOVA IMAGEM (com type="file" e name="image") --}}
        @include('molecules.form_field', [
            'label' => 'Upload de Nova Imagem (Opcional)', 
            'name' => 'image', // O nome deve ser 'image'
            'type' => 'file',
            'required' => false,
        ])


        <div class="mt-6">
            @include('atoms.button', ['type' => 'primary', 'html_type' => 'submit', 'text' => 'Atualizar Produto'])
            <a href="{{ route('products.index') }}" class="ml-4 text-gray-600 hover:text-gray-800">Cancelar</a>
        </div>
    </form>
@endsection