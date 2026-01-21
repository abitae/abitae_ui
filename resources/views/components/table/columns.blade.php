@php
    $stickyClass = $sticky ? 'sticky top-0 z-10 bg-white' : '';
@endphp

<thead class="{{ $stickyClass }}">
    <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
        {{ $slot }}
    </tr>
</thead>
