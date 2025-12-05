@extends('templates.admin_template')

@section('title', 'Gerenciar Produtos')

@section('admin_content')
    <h3>Lista de Produtos</h3>

    {{-- Botão para criar novo produto --}}
    <div style="margin-bottom: 15px;">
        <a href="{{ route('products.create') }}">
            @include('atoms.button', ['type' => 'primary', 'text' => 'Adicionar Novo Produto'])
        </a>
    </div>

    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($products->isEmpty())
        <p>Nenhum produto cadastrado ainda.</p>
    @else
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #e9e9e9;">
                    <th style="border: 1px solid #ccc; padding: 8px;">ID</th>
                    <th style="border: 1px solid #ccc; padding: 8px; text-align: left;">Nome</th>
                    <th style="border: 1px solid #ccc; padding: 8px; text-align: left;">Descrição</th> {{-- ✅ ADICIONADO: COLUNA DESCRIÇÃO --}}
                    <th style="border: 1px solid #ccc; padding: 8px;">Preço</th>
                    <th style="border: 1px solid #ccc; padding: 8px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td style="border: 1px solid #ccc; padding: 8px; text-align: center;">{{ $product->id }}</td>
                        <td style="border: 1px solid #ccc; padding: 8px;">{{ $product->name }}</td>
                        <td style="border: 1px solid #ccc; padding: 8px;">{{ Str::limit($product->description, 50) }}</td> {{-- ✅ ADICIONADO: DADOS DA DESCRIÇÃO (limitado a 50 caracteres) --}}
                        <td style="border: 1px solid #ccc; padding: 8px; text-align: right;">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                        
                        <td style="border: 1px solid #ccc; padding: 8px; text-align: center;">
                            {{-- Ações: Editar --}}
                            <a href="{{ route('products.edit', $product) }}" style="margin-right: 5px;">Editar</a> | 
                            
                            {{-- Ações: Deletar --}}
                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $product->id }}').submit();">Deletar</a>
                            
                            <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection