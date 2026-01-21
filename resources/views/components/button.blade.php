@php
    use Illuminate\Support\Str;

    $variant = $attributes->get('variant') ?? $variant;
    $size = $attributes->get('size') ?? $size;
    $iconVariant = $attributes->get('icon:variant') ?? $iconVariant;
    $tooltipPosition = $attributes->get('tooltip:position') ?? $tooltipPosition;
    $tooltipKbd = $attributes->get('tooltip:kbd') ?? null;
    $kbd = $attributes->get('kbd') ?? $kbd;
    $inset = $attributes->get('inset') ?? $inset;

    $tag = $href ? 'a' : ($as === 'div' ? 'div' : 'button');
    $heroiconPrefix = match ($iconVariant) {
        'outline' => 'heroicon-o',
        'solid' => 'heroicon-s',
        'mini' => 'heroicon-m',
        'micro' => 'heroicon-micro',
        default => 'heroicon-micro',
    };
    $iconName = $icon ? Str::kebab($icon) : null;
    $iconTrailingName = $iconTrailing ? Str::kebab($iconTrailing) : null;
    $iconComponent = $iconName ? $heroiconPrefix . '-' . $iconName : null;
    $iconTrailingComponent = $iconTrailingName ? $heroiconPrefix . '-' . $iconTrailingName : null;

    $sizeClasses = [
        'xs' => 'h-7 px-2 text-xs',
        'sm' => 'h-8 px-3 text-sm',
        'base' => 'h-10 px-4 text-sm',
    ];
    $variantClasses = [
        'outline' => 'border border-gray-300 text-gray-900 hover:bg-gray-50',
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700',
        'filled' => 'bg-gray-900 text-white hover:bg-gray-800',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
        'ghost' => 'bg-transparent text-gray-900 hover:bg-gray-100',
        'subtle' => 'bg-gray-100 text-gray-900 hover:bg-gray-200',
    ];
    $alignClasses = [
        'start' => 'justify-start',
        'center' => 'justify-center',
        'end' => 'justify-end',
    ];
    $insetClasses = [
        'top' => '-mt-1',
        'bottom' => '-mb-1',
        'left' => '-ml-1',
        'right' => '-mr-1',
    ];
    $insetClass = '';
    if ($inset) {
        $parts = preg_split('/\s+/', trim($inset));
        $insetClass = collect($parts)->map(fn ($part) => $insetClasses[$part] ?? '')->implode(' ');
    }
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['base'];
    $variantClass = $variantClasses[$variant] ?? $variantClasses['outline'];
    $alignClass = $alignClasses[$align] ?? $alignClasses['center'];
    $squareClass = $square ? 'px-0 w-10' : '';
    $tooltipText = $tooltip ?: null;
@endphp

<{{ $tag }}
    data-abitae-button
    @if($href) href="{{ $href }}" @endif
    @if($tag === 'button') type="{{ $type }}" @endif
    @if($tooltipText) title="{{ $tooltipText }}" data-tooltip-position="{{ $tooltipPosition }}" @endif
    class="inline-flex items-center gap-2 rounded-md font-medium transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed {{ $sizeClass }} {{ $variantClass }} {{ $alignClass }} {{ $squareClass }} {{ $insetClass }} {{ $attributes->get('class') }}"
    @if($tag === 'button' && $loading) wire:loading.attr="disabled" @endif
>
    @if($loading)
        <span wire:loading class="inline-flex h-4 w-4 animate-spin rounded-full border-2 border-current border-t-transparent"></span>
    @endif

    @if($iconComponent)
        <x-dynamic-component :component="$iconComponent" class="h-4 w-4" />
    @endif

    <span>{{ $slot }}</span>

    @if($iconTrailingComponent)
        <x-dynamic-component :component="$iconTrailingComponent" class="h-4 w-4" />
    @endif

    @if($tooltipKbd || $kbd)
        <span class="ml-1 rounded border px-1 text-[10px] text-gray-500">{{ $tooltipKbd ?? $kbd }}</span>
    @endif
</{{ $tag }}>
