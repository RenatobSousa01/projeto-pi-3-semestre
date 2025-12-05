<input 
    type="{{ $type ?? 'text' }}" 
    name="{{ $name }}" 
    id="{{ $name }}" 
    value="{{ old($name, $value ?? '') }}" 
    class="form-input {{ $class ?? '' }}"
    {{ $required ?? false ? 'required' : '' }}
>