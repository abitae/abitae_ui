@php
    use Illuminate\View\ComponentSlot;
    use Illuminate\Support\Str;

    $tooltipPosition = $attributes->get('tooltip:position') ?? $tooltipPosition;
    $badgeColor = $attributes->get('badge:color') ?? $badgeColor;
    $badgePosition = $attributes->get('badge:position') ?? $badgePosition;
    $badgeVariant = $attributes->get('badge:variant') ?? $badgeVariant;
    $badgeCircle = $attributes->has('badge:circle') ? true : $badgeCircle;
    $iconVariant = $attributes->get('icon:variant') ?? $iconVariant;
    $colorSeedOverride = $attributes->get('color:seed') ?? $colorSeed;

    $sizeClasses = [
        'xs' => 'h-6 w-6 text-xs',
        'sm' => 'h-8 w-8 text-sm',
        'md' => 'h-10 w-10 text-sm',
        'lg' => 'h-12 w-12 text-base',
    ];
    $radiusClass = $circle ? 'rounded-full' : 'rounded-md';
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    if ($color === 'auto') {
        $seed = $colorSeedOverride ?: $name ?: $initials ?: 'abitae';
        $palette = [
            'red', 'orange', 'amber', 'yellow', 'lime', 'green', 'emerald',
            'teal', 'cyan', 'sky', 'blue', 'indigo', 'violet', 'purple',
            'fuchsia', 'pink', 'rose',
        ];
        $color = $palette[crc32($seed) % count($palette)];
    }
    $colorClass = $color
        ? "bg-{$color}-100 text-{$color}-700 ring-{$color}-200"
        : 'bg-gray-100 text-gray-700 ring-gray-200';
    $tooltipText = $tooltipText();
    $badgePosClasses = [
        'top left' => '-top-1 -left-1',
        'top right' => '-top-1 -right-1',
        'bottom left' => '-bottom-1 -left-1',
        'bottom right' => '-bottom-1 -right-1',
    ];
    $badgePos = $badgePosClasses[$badgePosition] ?? $badgePosClasses['bottom right'];
    $badgeShape = $badgeCircle ? 'rounded-full' : 'rounded-md';
    $badgeColor = $badgeColor ?? $color;
    $badgeColorClass = $badgeColor
        ? "bg-{$badgeColor}-600 text-white ring-{$badgeColor}-200"
        : 'bg-gray-600 text-white ring-gray-200';
    $badgeVariantClass = $badgeVariant === 'outline'
        ? 'bg-white text-gray-700 ring-1 ring-inset'
        : $badgeColorClass;
    $tag = $href ? 'a' : ($as === 'button' ? 'button' : 'div');
    $altText = $alt ?? $name ?? 'Avatar';
    $badgeSlot = $badge instanceof ComponentSlot ? $badge : null;
    $badgeValue = $badgeSlot ? null : $badge;
    $heroiconPrefix = match ($iconVariant) {
        'outline' => 'heroicon-o',
        'solid' => 'heroicon-s',
        default => 'heroicon-s',
    };
    $iconComponent = $icon ? $heroiconPrefix . '-' . Str::kebab($icon) : null;
@endphp

<{{ $tag }}
    @if($href) href="{{ $href }}" @endif
    @if($tag === 'button') type="button" @endif
    class="relative inline-flex items-center justify-center overflow-hidden ring-1 ring-inset {{ $radiusClass }} {{ $sizeClass }} {{ $colorClass }}"
    @if($tooltipText) title="{{ $tooltipText }}" data-tooltip-position="{{ $tooltipPosition }}" @endif
>
    @if ($src)
        <img src="{{ $src }}" alt="{{ $altText }}" class="h-full w-full object-cover" />
    @elseif (trim($slot ?? '') !== '')
        {{ $slot }}
    @elseif ($iconComponent)
        <x-dynamic-component :component="$iconComponent" class="h-4 w-4" />
    @else
        <span>{{ $displayInitials() }}</span>
    @endif

    @if (trim($badgeSlot ?? '') !== '' || $badgeValue !== null)
        <span
            class="absolute {{ $badgePos }} inline-flex items-center justify-center ring-2 ring-white {{ $badgeShape }} {{ $badgeVariantClass }} {{ $badgeValue ? 'px-1.5 py-0.5 text-xs' : 'h-2.5 w-2.5' }}"
        >
            @if (trim($badgeSlot ?? '') !== '')
                {{ $badgeSlot }}
            @elseif ($badgeValue !== true && $badgeValue !== false)
                {{ $badgeValue }}
            @endif
        </span>
    @endif
</{{ $tag }}>
