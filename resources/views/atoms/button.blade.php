<button class="btn-{{ $type ?? 'primary' }} {{ $class ?? '' }}" type="{{ $html_type ?? 'button' }}">
    {{ $text ?? '' }} {{-- ✅ CORRIGIDO: Usando $text em vez de $slot --}}
</button>