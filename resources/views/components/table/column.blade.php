@php
    $alignClasses = [
        'start' => 'text-left',
        'center' => 'text-center',
        'end' => 'text-right',
    ];
    $alignClass = $alignClasses[$align] ?? $alignClasses['start'];
    $stickyClass = $sticky ? 'sticky left-0 bg-white z-10' : '';
@endphp

<th
    scope="col"
    class="px-4 py-3 font-semibold {{ $alignClass }} {{ $stickyClass }}"
>
    @if ($sortable)
        <div class="inline-flex items-center gap-1 text-xs uppercase tracking-wide text-gray-500">
            <span>{{ $slot }}</span>
            @if ($sorted)
                <span class="text-gray-400">
                    {{ $direction === 'desc' ? '↓' : '↑' }}
                </span>
            @else
                <span class="text-gray-300">↕</span>
            @endif
        </div>
    @else
        <span class="text-xs uppercase tracking-wide text-gray-500">{{ $slot }}</span>
    @endif
</th>
