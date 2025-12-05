<div class="product-card" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; border-radius: 8px; width: 300px; display: inline-block; margin-right: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    
    {{-- Imagem do Produto --}}
    <img src="{{ asset($product->image_path ?: 'images/placeholder.jpg') }}" alt="{{ $product->name }}" style="width: 100%; height: auto; border-radius: 4px; margin-bottom: 10px;">
    
    {{-- Título --}}
    <h4 style="margin-top: 0; margin-bottom: 5px; font-size: 1.2em;">{{ $product->name }}</h4>
    
    {{-- Descrição --}}
    <p style="color: #666; font-size: 0.9em; margin-bottom: 15px;">
        {{ Str::limit($product->description, 60) }}
    </p>

    {{-- Preço --}}
    <p style="font-size: 1.4em; color: #007bff; font-weight: bold; margin-top: 0;">
        R$ {{ number_format($product->price, 2, ',', '.') }}
    </p>
    
    {{-- Botão de Ação (Átomo Button) --}}
    <a href="{{ route('products.show', $product) }}" style="text-decoration: none;">
        @include('atoms.button', ['type' => 'primary', 'text' => 'Ver Detalhes'])
    </a>

</div>