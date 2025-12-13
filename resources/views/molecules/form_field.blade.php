@props([
    'label',
    'name',
    'type' => 'text', // Tipos: text, number, textarea, file
    'required' => false,
    'step' => null, // Usado para type="number"
    'value' => old($name), // Valor antigo em caso de erro
])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    @if ($type === 'textarea')
        <textarea 
            id="{{ $name }}" 
            name="{{ $name }}" 
            rows="4" 
            {{ $required ? 'required' : '' }}
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm resize-y"
        >{{ $value }}</textarea>

    @elseif ($type === 'file')
    <input 
        type="file" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        {{ $required ? 'required' : '' }}
        {{-- ✅ CLASSES TAILWIND SIMPLIFICADAS PARA GARANTIR VISIBILIDADE --}}
        class="block w-full text-sm text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
    >

    @else
        <input 
            type="{{ $type }}" 
            id="{{ $name }}" 
            name="{{ $name }}" 
            value="{{ $value }}"
            {{ $required ? 'required' : '' }}
            @if ($type === 'number' && $step)
                step="{{ $step }}"
            @endif
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        >
    @endif

    {{-- Exibição de Erros de Validação --}}
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>