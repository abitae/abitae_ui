@php
    $stickyClass = $sticky ? 'sticky top-0 bg-white z-0' : '';
@endphp

<tr class="{{ $stickyClass }}" @if($key) wire:key="{{ $key }}" @endif>
    {{ $slot }}
</tr>
