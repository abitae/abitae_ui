@php
    $variantClasses = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700',
        'secondary' => 'bg-gray-200 text-gray-900 hover:bg-gray-300',
        'ghost' => 'bg-transparent text-gray-900 hover:bg-gray-100',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
    ];

    $sizeClasses = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-base',
    ];

    $variantClass = $variantClasses[$variant] ?? $variantClasses['primary'];
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<button
    type="{{ $type }}"
    @if($disabled) disabled @endif
    class="inline-flex items-center justify-center rounded-md font-medium transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed {{ $variantClass }} {{ $sizeClass }}"
>
    {{ $label }}
</button>
