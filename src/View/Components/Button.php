<?php

namespace Abitae\AbitaeUi\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Button extends Component
{
    public string $as;
    public ?string $href;
    public string $type;
    public string $variant;
    public string $size;
    public ?string $icon;
    public string $iconVariant;
    public ?string $iconTrailing;
    public bool $square;
    public string $align;
    public ?string $inset;
    public bool $loading;
    public ?string $tooltip;
    public string $tooltipPosition;
    public ?string $kbd;

    public function __construct(
        string $as = 'button',
        ?string $href = null,
        string $type = 'button',
        string $variant = 'outline',
        string $size = 'base',
        ?string $icon = null,
        string $iconVariant = 'micro',
        ?string $iconTrailing = null,
        bool $square = false,
        string $align = 'center',
        ?string $inset = null,
        bool $loading = true,
        ?string $tooltip = null,
        string $tooltipPosition = 'top',
        ?string $kbd = null
    ) {
        $this->as = $as;
        $this->href = $href;
        $this->type = $type;
        $this->variant = $variant;
        $this->size = $size;
        $this->icon = $icon;
        $this->iconVariant = $iconVariant;
        $this->iconTrailing = $iconTrailing;
        $this->square = $square;
        $this->align = $align;
        $this->inset = $inset;
        $this->loading = $loading;
        $this->tooltip = $tooltip;
        $this->tooltipPosition = $tooltipPosition;
        $this->kbd = $kbd;
    }

    public function render(): View
    {
        return view('abitae-ui::components.button');
    }
}
