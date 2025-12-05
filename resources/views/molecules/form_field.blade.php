<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>

    {{-- Incluindo o Átomo Input --}}
    @include('atoms.input', [
        'type' => $type ?? 'text',
        'name' => $name,
        'value' => $value ?? '',
        'required' => $required ?? false,
        'step' => $step ?? null 
    ])

    {{-- Espaço para feedback de erro do Laravel --}}
    @error($name)
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>