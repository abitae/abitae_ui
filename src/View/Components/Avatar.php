<?php

namespace Abitae\AbitaeUi\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\View;

class Avatar extends Component
{
    public ?string $name;
    public ?string $src;
    public ?string $initials;
    public ?string $alt;
    public string $size;
    public ?string $color;
    public ?string $colorSeed;
    public bool $circle;
    public ?string $icon;
    public string $iconVariant;
    public string|bool|null $tooltip;
    public string $tooltipPosition;
    public string|bool|null $badge;
    public ?string $badgeColor;
    public bool $badgeCircle;
    public string $badgePosition;
    public string $badgeVariant;
    public string $as;
    public ?string $href;

    public function __construct(
        ?string $name = null,
        ?string $src = null,
        ?string $initials = null,
        ?string $alt = null,
        string $size = 'md',
        ?string $color = null,
        ?string $colorSeed = null,
        bool $circle = false,
        ?string $icon = null,
        string $iconVariant = 'solid',
        string|bool|null $tooltip = null,
        string $tooltipPosition = 'top',
        string|bool|null $badge = null,
        ?string $badgeColor = null,
        bool $badgeCircle = false,
        string $badgePosition = 'bottom right',
        string $badgeVariant = 'solid',
        string $as = 'div',
        ?string $href = null
    ) {
        $this->name = $name;
        $this->src = $src;
        $this->initials = $initials;
        $this->alt = $alt;
        $this->size = $size;
        $this->color = $color;
        $this->colorSeed = $colorSeed;
        $this->circle = $circle;
        $this->icon = $icon;
        $this->iconVariant = $iconVariant;
        $this->tooltip = $tooltip;
        $this->tooltipPosition = $tooltipPosition;
        $this->badge = $badge;
        $this->badgeColor = $badgeColor;
        $this->badgeCircle = $badgeCircle;
        $this->badgePosition = $badgePosition;
        $this->badgeVariant = $badgeVariant;
        $this->as = $as;
        $this->href = $href;
    }

    public function render(): View
    {
        return view('abitae-ui::components.avatar');
    }

    public function displayInitials(): string
    {
        if ($this->initials) {
            return Str::upper($this->initials);
        }

        if (!$this->name) {
            return '';
        }

        $parts = preg_split('/\s+/', trim($this->name));
        $initials = collect($parts)
            ->filter()
            ->map(fn ($part) => Str::upper(Str::substr($part, 0, 1)))
            ->take(2)
            ->implode('');

        return $initials;
    }

    public function tooltipText(): ?string
    {
        if ($this->tooltip === true) {
            return $this->name;
        }

        if (is_string($this->tooltip)) {
            return $this->tooltip;
        }

        return null;
    }

    public function resolvedColor(): ?string
    {
        if ($this->color !== 'auto') {
            return $this->color;
        }

        $seed = $this->colorSeed ?: $this->name ?: $this->initials ?: 'abitae';
        $colors = [
            'red', 'orange', 'amber', 'yellow', 'lime', 'green', 'emerald',
            'teal', 'cyan', 'sky', 'blue', 'indigo', 'violet', 'purple',
            'fuchsia', 'pink', 'rose',
        ];
        $index = crc32($seed) % count($colors);

        return $colors[$index];
    }
}
