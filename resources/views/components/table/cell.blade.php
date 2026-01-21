@php
    $alignClasses = [
        'start' => 'text-left',
        'center' => 'text-center',
        'end' => 'text-right',
    ];
    $variantClasses = [
        'default' => 'text-gray-700',
        'strong' => 'font-semibold text-gray-900',
    ];
    $alignClass = $alignClasses[$align] ?? $alignClasses['start'];
    $variantClass = $variantClasses[$variant] ?? $variantClasses['default'];
    $stickyClass = $sticky ? 'sticky left-0 bg-white' : '';
@endphp

<td class="px-4 py-3 {{ $alignClass }} {{ $variantClass }} {{ $stickyClass }}">
    {{ $slot }}
</td>
