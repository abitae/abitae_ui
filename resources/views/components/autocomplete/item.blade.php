@php
    $label = trim((string) $slot);
    $value = $value ?? $label;
@endphp

<div
    data-autocomplete-item
    data-value="{{ $value }}"
    data-label="{{ $label }}"
    data-disabled="{{ $disabled ? 'true' : 'false' }}"
    class="hidden"
>
    {{ $slot }}
</div>
