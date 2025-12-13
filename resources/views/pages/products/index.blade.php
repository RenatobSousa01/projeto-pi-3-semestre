@extends('templates.admin_template')

@section('title', 'Lista de Produtos')

@section('admin_content')
    <h3 class="text-2xl font-bold mb-4">Gerenciamento de Produtos</h3>

    <div class="mb-6">
        <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150">
            + Adicionar Novo Produto
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Imagem</th>
                    <th class="py-3 px-6 text-left">Nome</th>
                    <th class="py-3 px-6 text-center">Preço</th>
                    <th class="py-3 px-6 text-center">Ações</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($products as $product)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $product->id }}</td>
                        
                        <td class="py-3 px-6 text-left">
                            @if ($product->image_path)
                                <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded-full">
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        
                        <td class="py-3 px-6 text-left">{{ $product->name }}</td>
                        <td class="py-3 px-6 text-center">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                        
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-2">
                                <a href="{{ route('products.edit', $product->id) }}" class="text-green-500 hover:text-green-700">Editar</a>
                                
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este produto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Deletar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection